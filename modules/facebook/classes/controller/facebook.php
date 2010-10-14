<?php defined('SYSPATH') OR die('No direct access allowed.');

class Controller_Facebook extends Controller_Template {
	
	public $template = 'facebook';
	
	public function before() {
		parent::before();
		FB::instance();		
		$this->canvas = View::factory($this->canvas);
		$this->template->bind('canvas', $this->canvas);
	}
	
	public function after() {
		parent::after();
	}
	
}