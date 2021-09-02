var gulp = require('gulp');
var browserify = require('browserify');
var source = require('vinyl-source-stream');


gulp.task('browserify', function() {
    // Grabs the app.js file
    return browserify('app/app.js')
        // bundles it and creates a file called main.js
        .bundle()
        .pipe(source('main.js'))
        // saves it the public/js/ directory
        .pipe(gulp.dest('./public/js/'));
})
gulp.task('watch', function() {
  gulp.watch('app/**/*.js', ['browserify']);
});
