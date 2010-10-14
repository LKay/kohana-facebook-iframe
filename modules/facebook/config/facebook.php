<?php defined('SYSPATH') OR die('No direct access allowed.');

return array (
	// Application SDK settings
	'appId'      => 'YOUR APP ID',     // Application ID
	'key'        => 'YOUR API KEY',    // Application API key
	'secret'     => 'YOUR API SECRET', // Application API secret
	'cookie'     => TRUE,              // Cookies support for session handle
	'domain'     => '',                // Base domain config
	'fileUpload' => FALSE,             // File upload support via API
	'status'     => TRUE,              // Login status support in JavaScript SDK
	'xfbml'      => TRUE,              // Rendering XFBML tags in Javascript SDK
	'lang'       => 'en_US',           // Default language for Javascript SDK
	// Application basic settings
	'basic_permissions' => 'user_likes', // Basic permissions granted by user
	'canvas_url'        => '',           // Canvas name in Facebook, ie. 'application/' if your 
	                                     // appplication url is http://apps.facebook.com/application/
	'server_url'        => '',           // The url of the server your files are hosted
	'canvas'            => TRUE,         // Parameter for login url method
	'fbconnect'         => FALSE,        // Parameter for login url method if application is Facebook Connect website
	// Application Kohana route settings
	'controller' => 'app',
	'action'     => 'index',
);