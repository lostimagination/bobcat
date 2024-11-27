<?php
/**
 * The header for the theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package bobcat
 */

// Enable strict typing mode.
declare( strict_types=1 );

$logo_id      = get_field( 'logo', 'options' );
$logo         = is_int( $logo_id ) ? wp_get_attachment_image( $logo_id, 'medium' ) : '';
$has_hero     = false;
$contact_link = get_field( 'contact_link', 'options' );
if ($contact_link) {
	$target = $contact_link['target'] ? $contact_link['target'] : '_self';
	$contact_button = sprintf(
		'<li class="menu-item menu-item-contact"><a class="btn btn-small" target="%s" href="%s">%s</a></li>',
		esc_attr($target),
		esc_url($contact_link['url']),
		esc_html($contact_link['title'])
	);
}

while ( have_rows( 'builder' ) ) {
	the_row();
	if ( 'hero' === get_row_layout() ) {
		$has_hero = true;
	}
}

$extra_classes = $has_hero ? 'has-hero' : ''; // Page with Hero requires extra header's styling.
?>
<?php
$locations       = get_field( 'locations_list', 'options' );
$locations_count = count( $locations );
ob_start();
?>
<div class="locations-dropdown">
    <a href="#" class="locations-dropdown__toggle">
        <span class="location-icon">
           <svg>
               <use xlink:href="#location-pin"></use>
           </svg>
        </span>
		<?php echo $locations_count; ?> <?php esc_html_e( 'Niederlassungen', 'bobcat' ); ?>
        <span class="dropdown-arrow">
           <svg>
               <use xlink:href="#arrow-down-loc"></use>
           </svg>
        </span>
    </a>

	<?php if ( $locations ) : ?>
        <div class="locations-dropdown__menu">
			<?php foreach ( $locations as $location ) :
				$location_title = get_the_title( $location );
				$location_url = get_permalink( $location );
				?>
                <a href="<?php echo esc_url( $location_url ); ?>" class="locations-dropdown__item">
                    <span class="location-marker"></span>
                    <span class="location-name"><?php esc_html_e( 'Niederlassungen', 'bobcat' ); ?> <?php echo esc_html( $location_title ); ?></span>
                </a>
			<?php endforeach; ?>
        </div>
	<?php endif; ?>
</div>
<?php
$locations_el = ob_get_clean();
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class( $extra_classes ); ?> id="top">
<?php wp_body_open(); ?>
<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'bobcat' ); ?></a>

<header class="site-header">
    <div class="container container-large">
        <div class="header-top visible-md-up">
			<?php $header_top_text = get_field( 'header_top_text', 'options' ); ?>
			<?php if ( $header_top_text ) : ?>
                <div class="header-top__info"><?php echo esc_html( $header_top_text ); ?></div>
			<?php endif; ?>
			<?php echo $locations_el; ?>
        </div>
        <div class="header-bottom">
			<?php if ( ! empty( $logo ) ) : ?>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo" rel="home"
                   aria-label="<?php bloginfo( 'name' ); ?>">
					<?php echo wp_kses_post( $logo ); ?>
                </a>
			<?php endif; ?>

            <nav class="main-nav">
                <?php echo $locations_el; ?>
				<?php
				wp_nav_menu(array(
					'theme_location'  => 'main',
					'container_class' => 'main-menu__container',
					'menu_class'      => 'main-menu',
					'depth'           => 2,
					'fallback_cb'     => false,
					'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s' . $contact_button . '</ul>'
				));
				?>
				<?php if ( is_active_sidebar( 'language-switcher' ) ) : ?>
                    <div class="hidden-sm-up">
						<?php dynamic_sidebar( 'language-switcher' ); ?>
                    </div>
				<?php endif; ?>
            </nav>

			<?php if ( is_active_sidebar( 'language-switcher' ) ) : ?>
                <div class="visible-md-up">
					<?php dynamic_sidebar( 'language-switcher' ); ?>
                </div>
			<?php endif; ?>

            <span class="icon-burger hidden-lg-up" role="button"
                  aria-label="<?php esc_html_e( 'Toggle navigation', 'bobcat' ); ?>"><span><?php esc_html_e('menu' , 'bobcat'); ?></span><i></i></span>
        </div>
    </div>
</header>

<main class="site-content" id="content">
