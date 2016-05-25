var config   = require('./gulpconfig.json'),
    tasks    = { js:[], less:[] };

var inquirer = require('inquirer');

var gulp     = require('gulp'),
    plumber  = require('gulp-plumber'),
    gutil    = require('gulp-util'),
    notify   = require("gulp-notify"),
    rename   = require('gulp-rename'),
    replace  = require('gulp-replace'),
    less     = require('gulp-less'),
    include  = require('gulp-include'),
    uglify   = require('gulp-uglify');

var LessPluginAutoPrefix   = require('less-plugin-autoprefix'),
    groupmediaqueries      = require('less-plugin-group-css-media-queries'),
    autoprefix             = new LessPluginAutoPrefix({ browsers: ['> 1%', 'last 2 versions', 'IE >= 8', 'Firefox ESR', 'Opera 12.1'] });

for (var group in config.build.less)
    tasks.less.push('build:less:' + group);

for (var group in config.build.js)
    tasks.js.push('build:js:' + group);

tasks.less.forEach(function(task){
    gulp.task(task, function(done){
        var group = task.split(':').pop();
        for (var src in config.build.less[group]) {
            var pipeline = gulp.src(src)
                .pipe(plumber({
                    errorHandler: notify.onError({
                        title: 'Error running ' + task,
                        message: "<%= error.message %>"
                    })}
                ))
                .pipe(less({
                    plugins: [groupmediaqueries, autoprefix]
                }))
                .pipe(rename(src.split('/').pop().replace('.less', '.css')))
            ;
            config.build.less[group][src].forEach(function(path){
                pipeline.pipe(gulp.dest(path))
            })
            return pipeline;
        }
        done();
    });
});
gulp.task('build:less', gulp.parallel(tasks.less));

tasks.js.forEach(function(task){
    gulp.task(task, function(done){
        var group = task.split(':').pop();
        for (var src in config.build.js[group]) {
            var pipeline = gulp.src(src)
                .pipe(plumber({
                    errorHandler: notify.onError({
                        title: 'Error running ' + task,
                        message: "<%= error.message %> in line no. <%= error.lineNumber %>"
                    })}
                ))
                .pipe(include())
                .pipe(rename(src.split('/').pop().replace('.js', '.js')))
            ;
            config.build.js[group][src].forEach(function(path){
                pipeline.pipe(gulp.dest(path))
            })
            return pipeline;
        }
        done();
    });
});
gulp.task('build:js', gulp.parallel(tasks.js));

function watch(){
    config.watch.forEach(function(obj){
        for (var group in obj.build) {
            gutil.log(gutil.colors.cyan('Watching ' + obj.files));
            gulp.watch(obj.files, gulp.series(
                'build:' + group + ':' + obj.build[group]
            ));
        }
    });
}

gulp.task('build', gulp.parallel(['build:less', 'build:js']));
gulp.task('build:all', gulp.parallel(['build:less', 'build:js']));
gulp.task('watch', watch);
gulp.task('init', gulp.series(['build:less', 'build:js']));
