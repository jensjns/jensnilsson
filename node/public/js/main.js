require(['hljs', 'swiper', 'mapbox'], function(hljs, Swiper, L) {

    hljs.initHighlighting();

    var swiper = new Swiper('.swiper-container', {
        pagination: '.swiper-pagination',
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev',
        slidesPerView: 1,
        paginationClickable: true,
        loop: true,
        preloadImages: false,
        lazyLoading: true,
    });

    var maps = document.querySelectorAll('.mapbox-map');

    for(var i = 0, ii = maps.length; i < ii; i++) {
        var mapDOM = maps[i];

        var mapSettings = {
            accessToken: mapDOM.getAttribute('data-access-token'),
            mapId: mapDOM.getAttribute('data-map-id'),
        };

        var geoJSON = mapDOM.getAttribute('data-geojson');

        var parsedJSONData = null;
        var invalidMapData = false;

        try {
            parsedJSONData = JSON.parse(geoJSON);
        } catch (err) {
            invalidMapData = true;
        }

        invalidMapData = invalidMapData || mapSettings.accessToken == null || !mapSettings.accessToken.length || mapSettings.mapId == null || !mapSettings.mapId.length;

        if (!invalidMapData) {
            var map = L.mapbox.map(mapDOM, mapSettings.mapId, mapSettings);
            var featureLayer = L.mapbox.featureLayer(parsedJSONData, mapSettings).addTo(map);
            if( parsedJSONData.features.length ) {
                map.fitBounds(featureLayer.getBounds());
            }
        }
    }

});
