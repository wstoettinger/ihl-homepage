'use strict';

var gulp = require('gulp'),
changed = require('gulp-changed'),
rename = require('gulp-rename'),
shell = require('gulp-shell'),
minify = require('gulp-minify-css'),
uglify = require('gulp-uglify'),
imageResize = require('gulp-image-resize'),
sass = require('gulp-sass'),
sftp = require('gulp-sftp'),
del = require('del');

// process css ans sass files
gulp.task('css', ['clean-div'], function () {
  return gulp.src([
    './src/**/*.css',
    './src/**/*.scss'
    ], { dot: true })
  .pipe(changed('./web/', {
    extension: '.css'
  }))
  .pipe(sass().on('error', sass.logError))
  .pipe(minify())
  .pipe(gulp.dest('./web/'))
  .pipe(gulp.dest('./web-div/'));
});

// process js files copy original js files, then minify them and put them as well in the './web/' directory
gulp.task('js', ['clean-div'], function () {
  return gulp.src([
    './src/**/*.js'
    ], { 
      dot: true 
    })
  .pipe(changed('./web/'))
  .pipe(gulp.dest('./web/'))
  .pipe(gulp.dest('./web-div/'))
  .pipe(uglify())
  .pipe(rename({
    extname: ".min.js"
  }))
  .pipe(gulp.dest('./web/'))
  .pipe(gulp.dest('./web-div/'));
});

// copy other source files which don't need processing
gulp.task('src', ['clean-div'], function () {
  return gulp.src([
    './src/**/*',
    '!' + './src/**/*.css',
    '!' + './src/**/*.scss',
    '!' + './src/**/*.js',
    '!' + './src/img/**/*',
    ], { 
      dot: true 
    })
  .pipe(changed('./web/'))
  .pipe(gulp.dest('./web/'))
  .pipe(gulp.dest('./web-div/'));
});

// copy lib files
gulp.task('lib', ['clean-div'], function () {
  return gulp.src([
    './lib/**/*',
    ], { 
      dot: true 
    })
  .pipe(changed('./web/lib/'))
  .pipe(gulp.dest('./web/lib/'))
  .pipe(gulp.dest('./web-div/lib/'));
});


// clean image temp
gulp.task('img-temp-clean', function (callback) {
  del('./img-temp/**/*');
  callback();
});

function imgCopy() {
  return gulp.src([
    './src/img/**/*'
    ], { 
      dot: true 
    })
  .pipe(changed('./web/img/'))
  .pipe(gulp.dest('./img-temp/'));
}

// copy new images to img-temp
gulp.task('img-copy', ['img-temp-clean'], function (callback) {
  return imgCopy();
});

function imgStrip() {
  return gulp.src([
    './img-strip.bat',
    ], {
      read: false
    })
  .pipe(shell(['"<%= file.path %>"']));
}

// strip images of metadata and thumbnails
gulp.task('img-strip', ['img-copy'], function (callback) {
  return imgStrip();
});


function imgResize() {
  
  gulp.src(['./img-temp/**/*.{jpg,png}'], { dot: true })
  .pipe(imageResize({ imageMagick: true, width : 200 }))
  .pipe(rename(function (path) { path.basename += "-200w"; }))
  .pipe(gulp.dest('./web/img/'))
  .pipe(gulp.dest('./web-div/img/'));
  
  gulp.src(['./img-temp/**/*.{jpg,png}'], { dot: true })
  .pipe(imageResize({ imageMagick: true, width : 400 }))
  .pipe(rename(function (path) { path.basename += "-400w"; }))
  .pipe(gulp.dest('./web/img/'))
  .pipe(gulp.dest('./web-div/img/'));

  gulp.src(['./img-temp/**/*.{jpg,png}'], { dot: true })
  .pipe(imageResize({ imageMagick: true, width : 800 }))
  .pipe(rename(function (path) { path.basename += "-800w"; }))
  .pipe(gulp.dest('./web/img/'))
  .pipe(gulp.dest('./web-div/img/'));

  // this is the standard image size for fallback images
  gulp.src(['./img-temp/**/*.{jpg,png}'], { dot: true })
  .pipe(imageResize({ imageMagick: true, width : 1200 }))
  .pipe(gulp.dest('./web/img/'))
  .pipe(gulp.dest('./web-div/img/'))
  .pipe(rename(function (path) { path.basename += "-1200w"; }))
  .pipe(gulp.dest('./web/img/'))
  .pipe(gulp.dest('./web-div/img/'));

  gulp.src(['./img-temp/**/*.{jpg,png}'], { dot: true })
  .pipe(imageResize({ imageMagick: true, width : 1600 }))
  .pipe(rename(function (path) { path.basename += "-1600w"; }))
  .pipe(gulp.dest('./web/img/'))
  .pipe(gulp.dest('./web-div/img/'));

  gulp.src(['./img-temp/**/*.jpg'], { dot: true })
  .pipe(imageResize({ imageMagick: true, width : 2000 }))
  .pipe(rename(function (path) { path.basename += "-2000w"; }))
  .pipe(gulp.dest('./web/img/'))
  .pipe(gulp.dest('./web-div/img/'));

  gulp.src(['./img-temp/**/*.jpg'], { dot: true })
  .pipe(imageResize({ imageMagick: true, width : 2400 }))
  .pipe(rename(function (path) { path.basename += "-2400w"; }))
  .pipe(gulp.dest('./web/img/'))
  .pipe(gulp.dest('./web-div/img/'));

  return gulp.src(['./img-temp/**/*.jpg'], { dot: true })
  .pipe(imageResize({ imageMagick: true, width : 2800 }))
  .pipe(rename(function (path) { path.basename += "-2800w"; }))
  .pipe(gulp.dest('./web/img/'))
  .pipe(gulp.dest('./web-div/img/'));
}


// resize images currently in the img-temp
gulp.task('img-resize', ['img-strip'], function () {
  return imgResize();
});

// copy, strip, and resize images
gulp.task('img', ['img-resize'], function (callback) {
  callback();
});

gulp.task('clean-img', function (callback) {
  del('./web/img/**/*');
  callback();
});

gulp.task('clean-div', function (callback) {
  del('./web-div/**/*');
  callback();
});

function sftpUpload() {
  return gulp.src('./web-div/**/*', { dot: true })
  .pipe(sftp({
    host: 'ssh.wolfography.at',
    user: 'wolfography.at',
    pass: 'ocFqFIxU',
    remotePath: '/customers/d/e/3/wolfography.at/httpd.www/',
  }));
}

gulp.task('upload', function () {
  return false;
});

gulp.task('up', ['clean-div', 'default'], function (callback) {
  sftpUpload();
  callback();
});

gulp.task('default', ['clean-div', 'css', 'js', 'img', 'src']);