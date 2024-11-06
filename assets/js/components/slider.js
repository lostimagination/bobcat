document.addEventListener('DOMContentLoaded' , function (){
	var swiper = new Swiper(".slide-reviews", {
		slidesPerView: 3,
		spaceBetween: 30,
		pagination: {
			el: ".swiper-pagination",
			clickable: true,
		},
		navigation: {
			nextEl: ".swiper-button-next",
			prevEl: ".swiper-button-prev",
		},
	});

})
