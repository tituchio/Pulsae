<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Playermaptbl_m extends MY_Model {
	
	public $_table = 'PLAYERMAPPINGTBL';
	
	public $belongs_to = array( 'player' => array( 'model' => 'playertbl_m', 'primary_key' => 'PLAYERID' ) );
}
