<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Playertbl_m extends MY_Model {
	
	public $_table = 'PLAYERTBL';
	public $primary_key = 'PLAYERID';
	//protected $return_type = 'array';
	
	public $belongs_to = array( 'team' => array( 'model' => 'teamtbl_m' ) );
	
	public $validate = array(
        array( 'field' => 'NAME', 
               'label' => 'Name',
               'rules' => 'required' ),
         array( 'field' => 'POSITION', 
               'label' => 'Position',
               'rules' => 'required' ),
    );
}
