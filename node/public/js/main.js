require(['hljs', 'swiper'], function(hljs, Swiper) {

    hljs.initHighlighting();

    var swiper = new Swiper('.swiper-container', {
        pagination: '.swiper-pagination',
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev',
        slidesPerView: 1,
        paginationClickable: true,
        loop: true,
        preloadImages: false,
        lazyLoading: true
    });

});
