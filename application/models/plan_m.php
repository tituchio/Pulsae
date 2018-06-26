<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Plan_m extends MY_Model {
	
	public $_table = 'plan';
	public $primary_key = 'planId';
	public $_db_group = 'realtime';
	
	function __construct(){
		parent::__construct();
		//$this->_database = $this->load->database($this->_db_group, TRUE);
		//$this->load->database('default');
	}
}
