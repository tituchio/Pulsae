<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Teamtbl_m extends MY_Model {
	
	public $_table = 'TEAMTBL';
	public $primary_key = 'TEAMID';
	
	public $has_many = array( 'players' => array( 'model' => 'playertbl_m', 'primary_key' => 'TEAMID' ) );
	
	
	public $validate = array(
        array( 'field' => 'NAME', 
               'label' => 'Name',
               'rules' => 'required' )
    );
	
}
