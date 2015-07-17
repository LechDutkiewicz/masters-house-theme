module.exports = function(grunt) {

	var jsFileList = [
	'assets/js/framework.js',
	'node_modules/waypoints/lib/jquery.waypoints.js',
	'assets/js/libs/jquery.ba-dotimeout.js',
	'assets/js/custom.js',
	'assets/js/elements/*.js'
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