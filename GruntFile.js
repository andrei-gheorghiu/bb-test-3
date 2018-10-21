module.exports = function (grunt) {
	require('load-grunt-tasks')(grunt);

	grunt.initConfig({
		php: {
			dist: {
				options: {
					port: 7337,
					keepalive: true,
					open: true,
					base: './public'
				},
				directives: {
					'error_log': require('path').resolve('logs/error.log')
				}
			}
		}
	});

	grunt.registerTask('default', ['php']);
};
