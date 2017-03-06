/*
 The modules in this gruntfile are organized alphabetically from top to bottom.  Each module has corresponding notes.
 */


/*jslint node: true */
'use strict';

module.exports = function(grunt){
    // load all grunt tasks matching the ['grunt-*', '@*/grunt-*'] patterns
    require('load-grunt-tasks')(grunt);

    //these define the folders and files that are watched by the "grunt dev" command
    var watchFiles = {
        javascript: [
            'webapp/javascript/app.js',
            'webapp/javascript/**/*.js'
        ],
        css: [
            'webapp/css/app.css',
            'webapp/css/**/*.css'
        ],
        images: [
            'webapp/images/**/*'
        ]
    };
    grunt.initConfig({
        /*
         Minifies and concatenates CSS
         https://github.com/gruntjs/grunt-contrib-cssmin
         */
        cssmin: {
            options: {
                shorthandCompacting: false,
                roundingPrecision: -1,
                sourceMap: true
            },
            target: {
                files: {
                    'webapp/public/app.main.min.css': [
                        'webapp/vendor/font-awesome-4.7.0/css/font-awesome.css',
                        'webapp/bower_components/normalize-css/normalize.css',
                        'webapp/bower_components/slick-carousel/slick/slick.css'
                    ].concat(watchFiles.css)
                }
            }
        },
        /*
         Copies assets into the build folder
         https://github.com/gruntjs/grunt-contrib-copy
         */
        copy :{
            fonts: {
                expand: true,
                src: [
                    'webapp/vendor/font-awesome-4.7.0/fonts/**'
                ],
                dest: 'webapp/public/fonts/',
                flatten: true,
                filter: 'isFile'
            }
        },
        /*
         Minifies image files and moves them to the public folder
         https://github.com/gruntjs/grunt-contrib-imagemin
         */
        imagemin: {
            default: {
                files: [{
                    expand: true,
                    cwd: 'webapp/images/',// Src matches are relative to this path
                    src: ['**/*.{png,jpg,gif}'],// Actual patterns to match
                    dest: 'webapp/public/images/'// Destination path prefix
                }]
            }
        },
        /*
         Validates JavaScript syntax before compiling.
         Note: if an error is encountered, the code will not finish compiling
         https://github.com/gruntjs/grunt-contrib-jshint
         */
        jshint: {
            main: {
                src: [
                    watchFiles.javascript
                ],
                options: {
                    jshintrc: true
                }
            }
        },
        /*
         Adds vendor-specific prefixes (where needed) to our compiled CSS
         https://github.com/nDmitry/grunt-postcss
         */
        postcss: {
            options: {
                map: true, // inline sourcemaps,
                processors: [
                    require('autoprefixer')({browsers: 'last 2 versions'}) // add vendor prefixes
                ]
            },
            dist: {
                src: 'webapp/public/app.main.min.css'
            }
        },
        /*
         Concatenates and compresses our JavaScript into a single file
         https://github.com/gruntjs/grunt-contrib-uglify
         */
        uglify: {
            base: {
                files: {
                    'webapp/public/app.base.min.js': [
                        'webapp/bower_components/jquery/dist/jquery.min.js',
                        'webapp/bower_components/bluebird/js/browser/bluebird.min.js',
                        'webapp/bower_components/velocity/velocity.min.js',
                        'webapp/bower_components/velocity/velocity.ui.min.js',
                        'webapp/bower_components/slick-carousel/slick/slick.min.js'
                    ]
                },
                options: {
                    banner: '/*! <%= grunt.template.today("yyyy-mm-dd") %> */\n',
                    sourceMap: true,
                    preserveComments: false,
                    compress: true,
                    mangle: false
                }
            },
            main: {
                files: {
                    'webapp/public/app.main.min.js': watchFiles.javascript
                },
                options: {
                    banner: '/*! <%= grunt.template.today("yyyy-mm-dd") %> */\n',
                    sourceMap: true,
                    preserveComments: 'some',
                    mangle: false
                }
            }
        },
        /*
         Watches for file changes and then runs commands upon change
         https://github.com/gruntjs/grunt-contrib-watch
         */
        watch: {
            css: {
                files: watchFiles.css,
                tasks: ['cssmin','postcss'],
                options: {
                    livereload: true
                }
            },
            javascript: {
                files: watchFiles.javascript,
                tasks: ['jshint:main','uglify:main'],
                options: {
                    livereload: true
                }
            },
            images: {
                files: watchFiles.images,
                tasks: ['newer:imagemin'],
                options: {
                    livereload: true
                }
            }
        }
    });

    // Development task.  After started, will monitor files for changes and then recompile as needed
    grunt.registerTask('dev', [
        'newer:copy',
        'newer:imagemin',
        'newer:uglify',
        'newer:cssmin',
        'postcss',
        'watch'
    ]);

    // Build task. For initializing environment after clone or for deploy in a remote environment
    grunt.registerTask('build', [
        'newer:copy',
        'newer:imagemin',
        'uglify',
        'cssmin',
        'postcss'
    ]);

};