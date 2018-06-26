<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Analysisreqtbl_m extends MY_Model {
	
	public $_table = 'ANALYSISREQTBL';
	public $primary_key = 'ANALYSISID';
	
	public $belongs_to = array( 
		'GAME' => array( 'model' => 'gametbl_m', 'primary_key' => 'GAMEID' )
	);
	
}
