module.exports = function(grunt) {
	
	// Force use of Unix newlines
	grunt.util.linefeed = '\n';
	
	// Configuration
	grunt.initConfig({
		sass: {
			dist: {
				options: {
					style: 'nested',
					precision: 5,
				},
				files: {
					'build/main.css': 'sass/theme.scss',
					'build/font-awesome.css': 'sass/font-awesome.scss',
					'build/gutenberg-editor-style.css': 'sass/gutenberg-editor-style.scss',
					'build/classic-editor-style.css': 'sass/classic-editor-style.scss',
					'build/conversions-repeater.css': 'sass/conversions-repeater.scss',
				}
			}
		},
		concat: {
			basic_and_extras: {
				files: {
					'build/theme.js': ['node_modules/bootstrap/dist/js/bootstrap.bundle.js', 'js/skip-link-focus-fix.js', 'node_modules/slick-carousel/slick/slick.js', 'node_modules/@fancyapps/fancybox/dist/jquery.fancybox.js', 'js/theme.js'],
					'build/conversions-customizer.js': ['js/conversions-repeater.js', 'js/fontawesome-iconpicker.js', 'js/customizer-conditionals.js'],
					'build/main.css': ['build/main.css', 'node_modules/@fancyapps/fancybox/dist/jquery.fancybox.css'],
				},
			},
		},
		postcss: {
			options: {
				processors: [
					require('autoprefixer')({overrideBrowserslist: ['last 10 version']})
				]
			},
			dist: {
				src: 'build/main.css'
			}
		},
		cssmin: {
			target: {
				files: {
					'build/main.min.css': ['build/main.css'],
					'build/font-awesome.min.css': ['build/font-awesome.css'],
					'build/gutenberg-editor-style.min.css': ['build/gutenberg-editor-style.css'],
					'build/classic-editor-style.min.css': ['build/classic-editor-style.css'],
					'build/conversions-repeater.min.css': ['build/conversions-repeater.css'],
				}
			}
		},
		uglify: {
			options: {
				mangle: false,
			},
			my_target: {
				files: {
					'build/theme.min.js': ['build/theme.js'],
					'build/conversions-customizer.min.js': ['build/conversions-customizer.js'],
				}
			}
		},
		watch: {
			sass: {
				files: ['sass/*.scss'],
				tasks: ['all'],
			},
			scripts: {
				files: ['js/*.js'],
				tasks: ['all'],
			},
		},
		copy: {
			main: {
				files: [
					// includes files within path
					{ 
						expand: true,
						flatten: true,
						src: ['node_modules/@fortawesome/fontawesome-free/webfonts/*'], 
						dest: 'fonts/',
						filter: 'isFile'
					},
					{ 
						expand: true,
						flatten: true,
						src: ['node_modules/slick-carousel/slick/fonts/*'], 
						dest: 'fonts/',
						filter: 'isFile'
					},
				],
			},
		},
	});

	// Load plugins
	grunt.loadNpmTasks('grunt-contrib-sass');
	grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('@lodder/grunt-postcss');
	grunt.loadNpmTasks('grunt-contrib-cssmin');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-contrib-copy');
	
	// Run All Tasks
	grunt.registerTask('all', ['sass', 'concat','postcss', 'cssmin', 'uglify', 'copy']);

};