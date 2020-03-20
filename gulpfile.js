const gulp = require('gulp');
const sass = require('gulp-sass');
const browserSync = require('browser-sync').create();
var concat = require('gulp-concat');

//compile scss into css
function style() {
    return gulp.src('src/scss/all.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(gulp.dest('src/css'))
        .pipe(browserSync.stream());
}

function scripts() {
    return gulp.src([
        'node_modules/jquery/dist/jquery.min.js',
        'node_modules/bootstrap/dist/js/bootstrap.bundle.min.js',
    ])
        .pipe(concat('bundle.min.js'))
        .pipe(gulp.dest('src/js/'))
        .pipe(browserSync.stream());
}

function icons() {
    return gulp.src('node_modules/@fortawesome/fontawesome-free/webfonts/*')
        .pipe(gulp.dest('src/assets/webfonts/'));
}

function watch() {
    browserSync.init({
        server: {
            baseDir: "./src",
            index: "/index.html"
        }
    });
    gulp.watch('src/scss/**/*.scss', style)
    gulp.watch('./*.php').on('change', browserSync.reload);
    gulp.watch('./js/**/*.js').on('change', browserSync.reload);
}

exports.style = style;
exports.scripts = scripts;
exports.icons = icons;
exports.watch = watch;