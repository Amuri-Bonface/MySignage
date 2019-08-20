<?php

/*
*  Default LibreSignage quota config. Don't edit this file directly.
*  Create a custom quota override file in conf/quota/ instead.
*/

return [
	'slides' => [
		'limit' => 10,
		'description' => 'Slides'
	],
	'api_rate' => [
		'limit' => 200,
		'description' => 'API quota (calls/'.gtlim('API_RATE_T').'s)'
	]
];
