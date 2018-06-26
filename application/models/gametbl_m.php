<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gametbl_m extends MY_Model {
	
	public $_table = 'GAMETBL';
	public $primary_key = 'GAMEID';
	
	public $belongs_to = array( 
		'HOME_TEAM' => array( 'model' => 'teamtbl_m', 'primary_key' => 'HOME_TEAMID' ) ,
		'AWAY_TEAM' => array( 'model' => 'teamtbl_m', 'primary_key' => 'AWAY_TEAMID' ),
		'PLAN' => array( 'model' => 'plan_m', 'primary_key' => 'PLANID' ),
		'ANALYSISREQTBL' => array( 'model' => 'analysisreqtbl_m', 'primary_key' => 'ANALYSISID' )
	);
	
}
