'use strict';

var gulp = require('gulp'),
changed = require('gulp-changed'),
concat = require('gulp-concat'),
rename = require('gulp-rename'),
shell = require('gulp-shell'),
minify = require('gulp-minify-css'),
uglify = require('gulp-uglify'),
imageResize = require('gulp-image-resize'),
sass = require('gulp-sass'),
sftp = require('gulp-sftp'),
del = require('del');

var sourcemaps = require('gulp-sourcemaps');

// process css and sass files
gulp.task('css', ['clean-div'], function () {
  return gulp.src([
    './src/css/embed.scss',
    './src/css/styles_pointer.scss',
    './src/css/styles_touch.scss'
    ], { dot: true })
  //.pipe(changed('./web/css/', { // always build css
  //  extension: '.css'
  //}))
.pipe(sass().on('error', sass.logError))
.pipe(minify())
.pipe(gulp.dest('./web/css/'))
.pipe(gulp.dest('./web-div/css/'));
});

gulp.task('js:vendor', function(callback) {
  return gulp.src([
    './src/js/vendor/jquery.js',
    './src/js/vendor/jquery.validate.js',
    './src/js/vendor/jquery.detect_swipe.js',
    './src/js/vendor/jquery.easing.js',
    './src/js/vendor/bootstrap.js',
    './src/js/vendor/owl.carousel.js',
    './src/js/vendor/parallax.js',
    './src/js/vendor/featherlight.js',
    './src/js/vendor/featherlight.gallery.js',
    ])
    // getBundleName creates a cache busting name
    .pipe(concat('vendor.js'))
    .pipe(gulp.dest('./web/js/'))
    .pipe(gulp.dest('./web-div/js/'))
    .pipe(uglify())
    .pipe(rename({
      extname: ".min.js"
    }))
    .pipe(gulp.dest('./web/js/'))
    .pipe(gulp.dest('./web-div/js/'));
});

// process js files copy original js files, then minify them and put them as well in the './web/' directory
gulp.task('js', ['clean-div'], function () {
  return gulp.src([
    './src/js/lazysizes.js',
    './src/js/main.js'
    ], { 
      dot: true 
    })
  .pipe(changed('./web/js/'))
  .pipe(gulp.dest('./web/js/'))
  .pipe(gulp.dest('./web-div/js/'))
  .pipe(uglify())
  .pipe(rename({
    extname: ".min.js"
  }))
  .pipe(gulp.dest('./web/js/'))
  .pipe(gulp.dest('./web-div/js/'));
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
    './src/img/**/*.{jpg,png}'
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

function resize(glob, base, fallbackSize, sizes) {

  var i;
  for (i = 0; i < sizes.length; ++i) {    
    (function (size) {
      gulp.src(glob, { dot: true })
      .pipe(imageResize({ imageMagick: true, width : size }))
      .pipe(rename(function (path) { path.basename += "-" + size.toString() + "w"; }))
      .pipe(gulp.dest('./web/img/' + base))
      .pipe(gulp.dest('./web-div/img/' + base));
    }(sizes[i]));
  }

  return  gulp.src(glob, { dot: true })
  .pipe(imageResize({ imageMagick: true, width : fallbackSize }))
  .pipe(gulp.dest('./web/img/' + base))
  .pipe(gulp.dest('./web-div/img/' + base));
}

function imgResize() {

  var szFull = [640, 960, 1080, 1280, 1366, 1600, 1920, 2880];
  var szStd  = [640, 960, 1088, 1165, 1440, 1600, 1920, 2330];
  var szFeed = [400, 482, 600, 640, 960, 1088, 1600];
  var szNewsGallery = [384, 700, 860, 1292, 1938];
  var szLogo = [135, 200, 320, 440, 640, 660];

  resize('./img-temp/full/**/*.jpg', 'full/', 1280, szFull);
  resize('./img-temp/std/**/*.jpg', 'std/',  1440, szStd);
  resize('./img-temp/feed/*/*/*.jpg', 'feed/', 2048, szNewsGallery);
  resize('./img-temp/feed/*/*.jpg', 'feed/',  640,  szFeed);
  resize('./img-temp/logo/**.png', 'logo/',  320,  szLogo);
  resize('./img-temp/misc/**.png', 'misc/',  320,  szLogo);

  // take svg files as they are
  return gulp.src([
    './src/**/*.svg'
    ], { 
      dot: true 
    })
  .pipe(changed('./web/'))
  .pipe(gulp.dest('./web/'))
  .pipe(gulp.dest('./web-div/'));
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