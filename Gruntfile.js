//
// this file demonstrate use of a per project Gruntfile.js
// within a c project
//
module.exports = function (grunt) {

  // load the base config, and tasks alias,
  // use require() instead of grunt.load*(),
  // in order to load the Gruntfile containing
  // base configuration and aliases
  // npm i maboiteaspam/c2-bin --save-dev
  require('c2-bin/Gruntfile.js')(grunt)

  // you can check version c2-bin
  // runtime by using pkg key
  console.log(grunt.config('pkg').version)

  // merge your config like this
  // instead of initConfig
  grunt.config.merge({
    hello:'the world'
  })
  console.log(grunt.config('hello'))

  // right now, let s demonstrate
  // how to take screen shot
  // npm i grunt-pageres --save-dev
  grunt.loadNpmTasks('grunt-pageres')
  grunt.config.merge({
    pageres: {
      multipleUrls: {
        options: {
          urls: ['http://127.0.0.1:8000/'],
          sizes: ['800x1000', '400x1000'],
          dest: 'screenshots',
          crop: true
        }
      }
    }
  })

  // then lets make use of async tasks
  // to spawn the web server
  // take the screen shot
  // then exit with a proper state
  grunt.registerTask('screen', ['run-async', 'pageres', 'kill-async']);

};
