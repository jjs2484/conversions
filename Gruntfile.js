module.exports = function(grunt) {

	// Configuration
	grunt.initConfig({
		concat: {
			js: {
				src: ['src/js/bootstrap4/bootstrap.bundle.js','src/js/skip-link-focus-fix.js','js/theme.js'],
				dest: 'build/theme.js'
			}
		},
		uglify: {
  			options: {
      			mangle: false,
   			},
   			my_target: {
    			files: {
        			'build/theme.min.js': ['build/theme.js']
    			}
    		}
  		},
		sass: {
    		dist: {
     			options: {
        			style: 'nested',
        			precision: 5,
    			},
      			files: {
        			'build/main.css': 'sass/theme.scss',
        			'build/gutenberg-editor-style.css': 'sass/gutenberg-editor-style.scss',
        			'build/classic-editor-style.css': 'sass/classic-editor-style.scss',
      			}
    		}
		},
		autoprefixer:{
			options: {
  				browsers: ['last 10 versions']
			},
    		dist:{
        		files:{
          			'build/main.css':'build/main.css'
        		}
      		}
    	},
  		cssmin: {
  			target: {
   				files: {
    				'build/main.min.css': ['build/main.css']
    			}
  			}
		},
		watch: {
  			scripts: {
				files: ['sass/*.scss'],
				tasks: ['sass', 'autoprefixer', 'cssmin'],
  			},
		},
	});

	// Load plugins
	grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-contrib-sass');
	grunt.loadNpmTasks('grunt-autoprefixer');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-cssmin');
	grunt.loadNpmTasks('grunt-contrib-watch');

	// Register Tasks
	grunt.registerTask('concat-js', ['concat:js']);
	grunt.registerTask('uglify-js', ['uglify']);
	grunt.registerTask('compile-sass', ['sass']);
	grunt.registerTask('prefix-css', ['autoprefixer']);
	grunt.registerTask('min-css', ['cssmin']);
	
	// Run All Tasks
	grunt.registerTask('all', ['concat-js', 'uglify-js', 'compile-sass', 'prefix-css', 'min-css']);

};