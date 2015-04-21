requirejs.config({
    shim: {
        hljs: {
            exports: 'hljs',
        },
        mapbox: {
            exports: 'L',
        },
    },
    paths: {
        hljs: "./lib/highlight.js/highlight.pack",
        swiper: "./lib/Swiper-3.0.6/dist/js/swiper.min",
        mapbox: "https://api.tiles.mapbox.com/mapbox.js/v2.1.8/mapbox",
    },
});