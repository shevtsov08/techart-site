import gulp from 'gulp';
import sass from 'gulp-sass';
import concat from 'gulp-concat';
import browserSync from 'browser-sync';
import uglify from 'gulp-uglify-es';
import autoprefixer from 'gulp-autoprefixer';
import imagemin from 'gulp-imagemin';
import del from 'del';

const { src, dest, watch, parallel, series } = gulp;

import nodeSass from 'sass';
const sassCompiler = sass.compiler;

const sassPlugin = sass(nodeSass);

async function browsersync() {
  browserSync.init({
    proxy: "http://test/" // изменено на proxy
  });
}

async function cleanDist() {
  return del('dist');
}

async function images() {
  return src('public/assets/images/**/*')
    .pipe(imagemin([
      imagemin.gifsicle({ interlaced: true }),
      imagemin.mozjpeg({ quality: 75, progressive: true }),
      imagemin.optipng({ optimizationLevel: 5 }),
      imagemin.svgo({
        plugins: [
          { removeViewBox: true },
          { cleanupIDs: false }
        ]
      })
    ]))
    .pipe(dest('dist/images'));
}

async function scripts() {
  return src([
    'node_modules/jquery/dist/jquery.js',
    'public/assets/js/main.js'
  ])
    .pipe(concat('main.min.js'))
    .pipe(uglify.default())
    .pipe(dest('public/assets/js/js'))
    .pipe(browserSync.stream());
}

async function styles() {
  return src('public/assets/scss/style.scss')
      .pipe(sassPlugin({ outputStyle: 'compressed' }).on('error', sassPlugin.logError))
      .pipe(concat('style.min.css'))
      .pipe(autoprefixer({
          overrideBrowserslist: ['last 10 version'],
          grid: true
      }))
      .pipe(dest('public/assets/css'))
      .pipe(browserSync.stream());
}

async function build() {
  return src([
    'public/assets/css/style.min.css',
    'public/assets/fonts/**/*',
    'public/assets/js/main.min.js',
    'public/assets/*.html'
  ], { base: 'public' })
    .pipe(dest('dist'));
}

async function watching() {
  watch(['public/assets/scss/**/*.scss'], styles);
  watch(['public/assets/js/**/*.js', '!app/js/main.min.js'], scripts);
  watch(['public/assets/*.html']).on('change', browserSync.reload);
}

export { styles, watching, browsersync, scripts, images, cleanDist, build };
export default parallel(styles, scripts, browsersync, watching);
