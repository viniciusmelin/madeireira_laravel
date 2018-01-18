var gulp = require('gulp');
var removeFiles = require('gulp-remove-files');
 
// gulp.task('del', function () {
//   gulp.src('public/adminlte/css/*.css').pipe(removeFiles());
// });


var clean = require('gulp-clean');

gulp.task('limpar', function () {
   return gulp.src('public/adminlte', {read: false}).pipe(clean());
});