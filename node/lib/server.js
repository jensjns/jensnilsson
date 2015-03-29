var express = require('express');
var jade = require('jade');
var marked = require('marked');
var moment = require('moment');
var path = require('path');
var proxy = require('express-http-proxy');

var app = express();
var config = require('../config.js');

// Static content. Example: '/static/css/style.css'
app.use('/static', express.static(path.join(__dirname, '../public')));

// expose utilities for jade
app.use(function(req, res, next) {
    res.locals.marked = marked;
    res.locals.moment = moment;
    next();
});

// setup proxy-middleware and rendering
app.use(proxy(config.proxyUrl.protocol + '://' + config.proxyUrl.url, {
    forwardPath: function(req, res) {
        return require('url').parse(req.url).path;
    },
    intercept: function(data, req, res, callback) {
        var origData = data;
        data = data.toString('utf8');

        // replace all occurences of wp's url with the public url
        var re = new RegExp(config.proxyUrl.url, 'g');
        data = data.replace(re, config.publicUrl.url);

        try {
            data = JSON.parse(data);
        }
        catch(e) {
            data = {};
        }

        // only try to render data that has a template
        if( data.template ) {
            res.render(data.template, {data: data}, function(err, html) {
                if (err) {
                    console.log(err);
                    res.status(500).send(JSON.stringify(err));
                }
                else {
                    res.set('Content-Type', 'text/html');
                    res.send(html);
                }

                // tell express-http-proxy that we already sent the response
                callback(null, origData, true);
            });
        }
        else {
            res.status(404);
            callback(null, origData);
        }
    },
    decorateRequest: function(req) {
        return req;
    }
}));

app.engine('jade', jade.__express);
app.set('view engine', 'jade');

app.listen(8081);
