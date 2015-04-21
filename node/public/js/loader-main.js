require(['helper', 'require-config'], function(helper) {

    helper.loadCss([
        '/static/css/style.min.css?v=20150412-1',
        'http://fonts.googleapis.com/css?family=Playfair+Display:400,700|Open+Sans:400italic,400,700',
        '/static/js/lib/Swiper-3.0.6/dist/css/swiper.min.css',
        'https://api.tiles.mapbox.com/mapbox.js/v2.1.8/mapbox.css',
    ]);

    require(['main'], function() {

    });
});