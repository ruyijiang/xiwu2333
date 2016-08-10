
// 引入组件
    gulp = require('gulp'),
    sass = require('gulp-ruby-sass'),
    autoprefixer = require('gulp-autoprefixer'),
    minifycss = require('gulp-minify-css'),
    jshint = require('gulp-jshint'),
    uglify = require('gulp-uglify'),
    imagemin = require('gulp-imagemin'),
    rename = require('gulp-rename'),
    clean = require('gulp-clean'),
    concat = require('gulp-concat'),
    notify = require('gulp-notify'),
    cache = require('gulp-cache'),
    livereload = require('gulp-livereload'),
    ngAnnotate = require('gulp-ng-annotate');

// 检查脚本
gulp.task('lint', function() {
    gulp.src('./js/*.js')
        .pipe(jshint())
        .pipe(jshint.reporter('default'));
});

// 编译Sass
gulp.task('sass', function() {
    gulp.src('./scss/*.scss')
        .pipe(sass())
        .pipe(gulp.dest('./css'));
});

// 合并，压缩自己写的js文件
gulp.task('minify_myjs', function() {
    gulp.src(['./js/utill/*','./js/controller/*','./js/service/*','./js/directive/*'])
        .pipe(ngAnnotate({single_quotes: true}))
        .pipe(concat('main.js'))
        .pipe(rename('main.min.js'))
        .pipe(uglify({outSourceMap: false}))
        .pipe(gulp.dest('./dist'));
});

//合并，压缩第三方js库
gulp.task('minify_vendors', function() {
    gulp.src(['./js/vendor/*','./js/*.js','./library/ueditor-1.4.3.2/ueditor.config.js','./library/ueditor-1.4.3.2/ueditor.all.min.js'])
        .pipe(ngAnnotate({single_quotes: true}))
        .pipe(concat('vendors.js'))
        .pipe(rename('vendors.min.js'))
        .pipe(uglify())
        .pipe(gulp.dest('./dist'));
});

gulp.task('default', function(){
    console.log("hello world");

    /*gulp.run('lint', 'sass', 'scripts');

    // 监听文件变化
    gulp.watch('./js/*.js', function(){
        gulp.run('lint', 'sass', 'scripts');
    });*/
});