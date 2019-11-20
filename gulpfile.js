const gulp = require("gulp");
const sass = require("gulp-sass");
const sourcemaps = require("gulp-sourcemaps");
const autoprefixer  = require("gulp-autoprefixer");
const colors        = require("ansi-colors");
const notifier      = require("node-notifier");
const rename        = require("gulp-rename");
const csso          = require("gulp-csso");

const showError = function(err) {
	//console.log(err.toString()); //wypisze cały obiekt błędu w terminalu
	notifier.notify({
        title: "Error in sass",
        message: err.messageFormatted
    });

    console.log(colors.red("==============================="));
    console.log(colors.red(err.messageFormatted));
    console.log(colors.red("==============================="));
}


const sassCompile = function(){
	return gulp.src("./sass/main.sass")
	.pipe(sourcemaps.init())
	.pipe(
		sass({
			outputStyle : 'compressed'
		}).on("error", showError)
	)
	.pipe(autoprefixer()) //lista przeglądarek w pliku package.json
	.pipe(rename({ //zamieniam wynikowy plik na style.min.css
		suffix: ".min",
		basename: "style"
	}))
	.pipe(csso())
	.pipe(sourcemaps.write("."))
	.pipe(gulp.dest("./css"))
}

const watch = function(){
	gulp.watch("./sass/**/*.sass", gulp.series(sassCompile));
}

exports.default = gulp.series(sassCompile, watch);
exports.sassCompile = sassCompile;
exports.watch = watch;