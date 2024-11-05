'use strict';

let isProd = false;

const gulp = require('gulp'),
	gulpIf = require('gulp-if'),
	sass = require('gulp-sass')(require('sass')),
	autoprefixer = require('autoprefixer'),
	sassGlob = require('gulp-sass-glob'),
	uglify = require('gulp-uglify'),
	notify = require('gulp-notify'),
	plumber = require('gulp-plumber'),
	postcss = require('gulp-postcss'),
	rename = require('gulp-rename'),
	sourcemaps = require('gulp-sourcemaps'),
	rimraf = require('gulp-rimraf'),
	webpack = require('webpack-stream'),
	replace = require('gulp-replace'),
	browserSync = require('browser-sync').create();

/* Rename Tasks */
const themeTextDomain = 'bobcat';

gulp.task('textdomain', function() {
	return gulp.src('./**/*', {ignore: ['gulpfile.js', 'node_modules/']})
	.pipe(replace('_it_start', themeTextDomain))
	.pipe(gulp.dest('./'));
});

/* JS Tasks */
gulp.task('admin-js', function () {
	return gulp
		.src('assets/js/admin.js')
		.pipe(
			plumber(
				notify.onError({
					title: 'JS',
					message: 'Error: <%= error.message %>',
				})
			)
		)
		.pipe(
			webpack({
				mode: isProd ? 'production' : 'development',
				output: {
					filename: 'admin.js',
					path: __dirname + '/dist/js/',
				},
			})
		)
		.pipe(
			rename(function (path) {
				path.basename += '.min';
			})
		)
		.pipe(uglify())
		.pipe(gulp.dest('./dist/js/'));
});

gulp.task('public-js', function () {
	return gulp
		.src('assets/js/public.js')
		.pipe(
			plumber(
				notify.onError({
					title: 'JS',
					message: 'Error: <%= error.message %>',
				})
			)
		)
		.pipe(
			webpack({
				mode: isProd ? 'production' : 'development',
				output: {
					filename: 'public.js',
					path: __dirname + '/dist/js/',
				},
			})
		)
		.pipe(
			rename(function (path) {
				path.basename += '.min';
			})
		)
		.pipe(uglify())
		.pipe(gulp.dest('./dist/js/'));
});

gulp.task('woocommerce-js', function () {
	return gulp
		.src('assets/js/woocommerce.js')
		.pipe(
			plumber(
				notify.onError({
					title: 'JS',
					message: 'Error: <%= error.message %>',
				})
			)
		)
		.pipe(
			webpack({
				mode: isProd ? 'production' : 'development',
				output: {
					filename: 'woocommerce.js',
					path: __dirname + '/dist/js/',
				},
			})
		)
		.pipe(
			rename(function (path) {
				path.basename += '.min';
			})
		)
		.pipe(uglify())
		.pipe(gulp.dest('./dist/js/'));
});

/* SCSS Tasks */
gulp.task('scss', function () {
	return gulp
		.src('assets/scss/*.scss', 'assets/scss/**/.scss')
		.pipe(gulpIf(!isProd, sourcemaps.init()))
		.pipe(sassGlob())
		.pipe(
			sass
				.sync({
					sourceMap: false,
					outputStyle: 'compressed',
					precision: 5,
					includePaths: ['node_modules/'],
				})
				.on('error', sass.logError)
		)
		.pipe(postcss([autoprefixer]))
		.pipe(gulpIf(!isProd, sourcemaps.write()))
		.pipe(gulpIf(isProd, sourcemaps.write('.')))
		.pipe(gulp.dest('dist/css/'))
		.pipe(browserSync.stream());
});

/* Transfer CSS from node_nodules */
gulp.task('copy-css-from-modules', function () {
	return gulp
		.src('node_modules/@fancyapps/ui/dist/fancybox/fancybox.css')
		.pipe(gulp.dest('dist/css/'));
});

/* Transfer images task */
gulp.task('copy-images', function () {
	return gulp.src('assets/img/*.{gif,jpg,png,svg}', {encoding: false}).pipe(gulp.dest('dist/img/'));
});

/* Transfer fonts task */
gulp.task('copy-fonts', function () {
	return gulp.src('assets/fonts/*', {encoding: false}).pipe(gulp.dest('dist/fonts/'));
});

/* Clear everything in dist */
gulp.task('cleanDist', function () {
	return gulp
		.src('dist', {
			allowEmpty: true,
		})
		.pipe(rimraf());
});

/* Change toProd variable */
gulp.task('toProd', function (done) {
	isProd = true;
	done();
});

/*
 * Watch task with browser-sync
 *
 * @link https://browsersync.io/docs/options#option-proxy
 */
gulp.task('actual-watch', function () {
	browserSync.init({
		proxy: 'https://bobcat-multisite.in:8890/', // Change it to your localhost url.
		port: 3000,
		notify: false,
		files: ['./*.php', './**/*.php'],
	});

	// Watch SCSS files
	gulp.watch('assets/**/*.scss', gulp.series('scss')).on(
		'change',
		browserSync.reload
	);

	// Watch Images
	gulp.watch('assets/img/*', gulp.series('copy-images')).on(
		'change',
		browserSync.reload
	);

	// Watch Fonts
	gulp.watch('assets/fonts/*', gulp.series('copy-fonts')).on(
		'change',
		browserSync.reload
	);

	// Watch Admin JS files
	gulp.watch(
		['assets/js/admin/**/*.js', 'assets/js/admin.js'],
		gulp.series('admin-js')
	).on('change', browserSync.reload);

	// Watch Public JS files
	gulp.watch(
		[
			'assets/js/**/*.js',
			'!assets/js/admin.js',
			'!assets/js/woocommerce.js',
			'!assets/js/admin/**/*.js',
			'!assets/js/woocommerce/**/*.js',
		],
		gulp.series('public-js')
	).on('change', browserSync.reload);

	// Watch WooCommerce JS files
	gulp.watch(
		['assets/js/woocommerce/**/*.js', 'assets/js/woocommerce.js'],
		gulp.series('woocommerce-js')
	).on('change', browserSync.reload);
});

/* Build dev */
gulp.task(
	'build-dev',
	gulp.series(
		'scss',
		'copy-css-from-modules',
		'copy-images',
		'copy-fonts',
		'admin-js',
		'public-js',
		'woocommerce-js'
	)
);

/* Build to prod task */
gulp.task(
	'build',
	gulp.series(
		'toProd',
		'cleanDist',
		'scss',
		'copy-css-from-modules',
		'copy-images',
		'copy-fonts',
		'admin-js',
		'public-js',
		'woocommerce-js'
	)
);

/* Watch task */
gulp.task(
	'watch',
	gulp.series('build-dev', 'actual-watch')
);

gulp.task('default', gulp.parallel('watch'));
