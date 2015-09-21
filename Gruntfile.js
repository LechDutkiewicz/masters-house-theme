module.exports = function(grunt) {

	var jsFileList = [
	// 'bower_components/jquery/dist/jquery.js',
	// 'bower_components/jquery-ui/jquery-ui.js',
	'bower_components/modernizr/modernizr.js',
	'bower_components/jqueryui-touch-punch/jquery.ui.touch-punch.js',
	'bower_components/jquery-easing/jquery.easing.js',
	'bower_components/bootstrap/js/transition.js',
	'bower_components/bootstrap/js/collapse.js',
	'bower_components/bootstrap/js/modal.js',
	'bower_components/bxslider-4/dist/jquery.bxslider.js',
	'bower_components/flexslider/jquery.flexslider.js',
	'bower_components/waypoints/lib/jquery.waypoints.js',
	'bower_components/jquery-dotimeout/jquery.ba-dotimeout.js',
	'assets/js/framework.js',
	'assets/js/foundation/foundation.js',
	'assets/js/foundation/foundation.carousel.js',
	'assets/js/foundation/foundation.forms.js',
	'assets/js/foundation/foundation.magellan.js',
	'framework/assets/js/frontend/gallery-carousel.js',
	// 'assets/js/foundation/foundation.joyride.js',
	// 'node_modules/waypoints/lib/jquery.waypoints.js',
	// 'node_modules/flexslider/jquery.flexslider.js',
	// 'assets/js/libs/jquery.ba-dotimeout.js',
	'assets/js/custom.js',
	'assets/js/elements/*.js',
	];

	// Project configuration.
	grunt.initConfig({
		jshint: {
			options: {
				jshintrc: '.jshintrc'
			},
			all: [
			'Gruntfile.js',
			'assets/js/custom.js'
			]
		},
		concat: {
			js: {
				src: [jsFileList],
				dest: 'assets/js/scripts.js',
			},
		},
		uglify: {
			dist: {
				files: {
					'assets/js/scripts.min.js': [jsFileList]
				}
			}
		},
		watch: {
			js: {
				files: [jsFileList],
				tasks: ['jshint', 'concat', 'uglify'],
			},
		},
	});

	grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-contrib-jshint');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.registerTask('default', ['uglify', 'watch']);

};