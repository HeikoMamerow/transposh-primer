#!/usr/bin/env node

var bs = require('browser-sync').create();

bs.init({
    proxy: {
        target: 'https://www.hielscher.test'
    },
    files: [
		'./css/*',
		'./js/*',
		'./*.html',
		'./*.php'
	],
    notify: false,
    open: false,
    reloadOnRestart: true,
	https: true
});
