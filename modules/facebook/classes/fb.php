<?php defined('SYSPATH') OR die('No direct access allowed.');

class FB {
	
	/* Facebook driver instance */
	protected static $instances = array();
	
	/* Facebook SDK object */
	public static $graph;
	
	/* Config data */
	public static $config = array();
	
	/* Create instance of the driver */
	public static function instance($type = 'default', $config = array()) {
		if (!isset(self::$instances[$type]) OR !(self::$instances[$type] instanceof self)) {
			self::$config = array_merge(Kohana::config('facebook')->as_array(), $config);
			self::$instances[$type] = new self();
		}
		return self::$instances[$type];
	}
 
	/* Prevent from direct object construction */
	final private function __construct() {
		self::$graph = new Facebook(array(
			'appId'      => self::$config['appId'],
			'secret'     => self::$config['secret'],
			'cookie'     => self::$config['cookie'],
			'domain'     => self::$config['domain'],
			'fileUpload' => self::$config['fileUpload'],
		));
	}
	
	/* Prevent from cloning  */
	final private function __clone() { }

	/* Requires Facebook login and valid session */
	public static function require_login($extended_permissions = NULL, $next = NULL, $cancel_url = NULL) {
		if (!empty(self::$config['basic_permissions']) AND !empty($extended_permissions)) {
			$extended_permissions = self::$config['basic_permissions'].','.$extended_permissions;
		} else if (empty($extended_permissions)) {
			$extended_permissions = self::$config['basic_permissions'];
		}
		
		$session = self::$graph->getSession();
		
		$auth = NULL;  
		$access = TRUE;
		if ($session) {  
		    try {  
		        $auth = self::$graph->api('/me');  
		    } catch (FacebookApiException $e) { }  
		}
		if ($auth AND !empty($extended_permissions)) {
			$request = array(
				'method' => 'fql.query',
				'query' => 'SELECT '.$extended_permissions.' FROM permissions WHERE uid = '.$auth['id']
			);
			$result = self::$graph->api($request);
			foreach ($result[0] as $perm) {
				if ($perm === '0') {
					$access = FALSE;
					break;
				}
			}
		}
		if (!$access OR !$session) {
			$loginUrl = self::$graph->getLoginUrl(array(
				'canvas'     => self::$config['canvas'],
				'fbconnect'  => self::$config['fbconnect'],
				'display'    => 'page',
				'next'       => 'http://apps.facebook.com/'.self::$config['canvas_url'].($next ? $next : Request::instance()->uri),
				'cancel_url' => 'http://apps.facebook.com/'.self::$config['canvas_url'].($cancel_url ? $cancel_url : NULL),
				'req_perms'  => $extended_permissions,
			));
			echo "<script type='text/javascript'>top.location.href = '$loginUrl';</script>";
			exit;
		}		
	}

}