<?php defined('SYSPATH') OR die('No direct access allowed.');

require_once (Kohana::find_file('vendors', 'Facebook/facebook'));

Route::set('facebook', '(<action>(/<id>))',array('id'=>'[0-9]+'))
	->defaults(array(
		'controller' => Kohana::config('facebook')->get('controller'),
		'action'     => Kohana::config('facebook')->get('action'),
		'page'       => 1,
		'sort'       => 'latest',
	));
	
