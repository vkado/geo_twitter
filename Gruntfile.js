'use strict';

module.exports = function(grunt) {

    // Dynamically load npm tasks
    require('matchdep').filterDev('grunt-*').forEach(grunt.loadNpmTasks);


    // Grunt config
    var config = {
        src: 'src',
        assets_js: 'assets/js',
        assets_css: 'assets/css',
        assets_img: 'assets/image'
    };

    grunt.initConfig({

        // Get package info
        pkg: grunt.file.readJSON('package.json'),

        // Project settings
        config: config,

        // Project banner
        tag: {
            banner: '/*!\n' +
                ' * <%= pkg.title %>\n' +
                ' * <%= pkg.url %>\n' +
                ' * @author <%= pkg.author %>\n' +
                ' */\n'
        },

        // Connect port/livereload
        connect: {
            options: {
                port: 9000,
                open: true,
                livereload: 35729,
                hostname: 'localhost'
            },
            livereload: {
                options: {
                    middleware: function (connect) {
                        return [
                            // connect.static('.tmp'),
                            // connect().use('/bower_components', connect.static('./bower_components')),
                            // connect.static(config.dist)
                        ];
                    }
                }
            }
        },

        // Concatenate JavaScript files
        concat: {
            options: {
                separator: ';'
            },
            all: {
                src: [
                    '<%= config.src %>/js/base/jquery-2.1.1.js',
                    '<%= config.src %>/js/base/bootstrap.js',
                    '<%= config.src %>/js/base/jquery.timeago.js',
                    '<%= config.src %>/js/script.js'
                ],
                dest: '<%= config.assets_js %>/script.min.js'
            }
        },

        // Uglify (minify) JavaScript files
        uglify: {
            options: {
                banner: '<%= tag.banner %>'
            },
            dist: {
                files: {
                    '<%= config.assets_js %>/script.min.js': '<%= config.assets_js %>/script.min.js'
                }
            }
        },

        /**
         * Compile LESS files
         * https://github.com/gruntjs/grunt-contrib-less
         * Compiles all LESS files and appends project banner
         */
        less: {
            dev: {
                options: {
                    compress: false,
                    banner: '<%= tag.banner %>'
                },
                files: {
                    '<%= config.assets_css %>/styles.css': '<%= config.src %>/less/styles.less'
                }
            },
            dist: {
                options: {
                    compress: true,
                    banner: '<%= tag.banner %>'
                },
                files: {
                    '<%= config.assets_css %>/styles.css': '<%= config.src %>/less/styles.less'
                }
            }
        },

        // Watches for changes and runs tasks
        watch: {
            options: {
                livereload: true
            },
            grunt: {
                files: ['Gruntfile.js'],
                tasks: []
            },
            js: {
                files: ['<%= config.src %>/js/**/*.js'],
                tasks: ['concat']
            }
        }

    });

    /**
     * Default task
     * Run `grunt` on the command line
     */
    grunt.registerTask('default', [
        'less:dev',
        'concat',
        'watch'
    ]);

    /**
     * Build task
     * Run `grunt build` on the command line
     * Then compress all JS/CSS files
     */
    grunt.registerTask('build', [
        'less:dist',
        'concat',
        'uglify'
    ]);

};
