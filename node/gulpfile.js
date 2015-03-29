var gulp = require('gulp');
var stylus = require('gulp-stylus');
var autoprefixer = require('gulp-autoprefixer');
var fs = require('fs');
var path = require('path');
var jade = require('gulp-jade');
var wrap = require('gulp-wrap-amd');
var minifyCSS = require('gulp-minify-css');
var concat = require('gulp-concat');
var rename = require('gulp-rename');

gulp.task('css', function() {
    gulp.src(['./public/css/*.styl'])
        .pipe(stylus())
        .pipe(gulp.dest('./public/css'))
        .pipe(concat('style.css'))
        .pipe(autoprefixer())
        .pipe(minifyCSS())
        .pipe(rename('style.min.css'))
        .pipe(gulp.dest('./public/css'));
});

gulp.task('watch', function() {
    gulp.watch('public/css/**/*.styl', ['css']);
    gulp.watch('public/css/lib/*.css', ['css']);
    gulp.start('css');
});