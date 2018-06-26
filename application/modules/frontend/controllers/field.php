<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Field extends MX_Controller {

	public function __construct(){
		$this->template->set_layout('default-sk');
	}
	
	public function index()
	{
	}
	
	public function analysis(){
		$this->load->model('gametbl_m', 'game');
		$this->load->model('analysisreqtbl_m', 'analysisreq');
		$this->load->helper('form');
		
		$game_options = $this->analysisreq->get_many_by('STATUS', 1);
		foreach($game_options as $key => $val){
			$game_options[$key]->GAME = $this->game->with('HOME_TEAM')->with('AWAY_TEAM')->get($val->GAMEID);
		}
		//$game_options = $this->game->with('HOME_TEAM')->with('AWAY_TEAM')->get_many_by('ANALYSIS', 2);
		$this->template->build('analysis', compact('game_options'));
	}
	
	public function realtime(){
		$this->load->model('gametbl_m', 'game');
		$this->load->helper('form');
		
		$game_options = $this->game->with('HOME_TEAM')->with('AWAY_TEAM')->get_many_by('ANALYSIS', 2);
		$this->template->build('realtime', compact('game_options'));
	}
}

/* End of file field.php */
/* Location: ./application/modules/field/controllers/field.php */