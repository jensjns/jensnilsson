define(function() {
    return {
        loadCss: function(url) {
            var urls = [];

            if( typeof url == 'string' ) {
                urls.push(url);
            }
            else {
                urls = url;
            }

            for(var i = 0, ii = urls.length; i < ii; i++) {
                var link = document.createElement("link");
                link.type = "text/css";
                link.rel = "stylesheet";
                link.href = urls[i];
                document.getElementsByTagName("head")[0].appendChild(link);
            }
        }
    }
});