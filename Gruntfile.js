module.exports = function(grunt) {

	// Configuration
	grunt.initConfig({
    concat: {
      basic_and_extras: {
        files: {
          'build/theme.js': ['src/js/bootstrap4/bootstrap.bundle.js', 'src/js/skip-link-focus-fix.js', 'src/js/slick/slick.js', 'src/js/fancybox/jquery.fancybox.js', 'js/theme.js'],
          'build/conversions-repeater.js': ['js/conversions-repeater.js', 'js/fontawesome-iconpicker.js', 'js/customizer-conditionals.js'],
        },
      },
    },
		uglify: {
  		options: {
      	mangle: false,
   		},
   		my_target: {
    		files: {
        	'build/theme.min.js': ['build/theme.js'],
          'build/conversions-repeater.min.js': ['build/conversions-repeater.js'],
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
          'build/font-awesome.css': 'sass/font-awesome.scss',
        	'build/gutenberg-editor-style.css': 'sass/gutenberg-editor-style.scss',
        	'build/classic-editor-style.css': 'sass/classic-editor-style.scss',
          'build/conversions-repeater.css': 'sass/conversions-repeater.scss',
      	}
    	}
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
		watch: {
  		scripts: {
			 files: ['sass/*.scss'],
			 tasks: ['sass', 'postcss', 'cssmin'],
  		},
		},
	});

	// Load plugins
	grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-contrib-sass');
	grunt.loadNpmTasks('@lodder/grunt-postcss');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-cssmin');
	grunt.loadNpmTasks('grunt-contrib-watch');

	// Register Tasks
	grunt.registerTask('concat-js', ['concat']);
  grunt.registerTask('compile-sass', ['sass']);
  grunt.registerTask('prefix-css', ['postcss']);
	grunt.registerTask('uglify-js', ['uglify']);
	grunt.registerTask('min-css', ['cssmin']);
	
	// Run All Tasks
	grunt.registerTask('all', ['concat-js', 'uglify-js', 'compile-sass', 'prefix-css', 'min-css']);

};