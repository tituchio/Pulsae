<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Game extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('plan_m', 'plan');
		$this->load->model('gametbl_m', 'game');
		$this->load->model('teamtbl_m', 'team');
		$this->load->model('playermaptbl_m', 'playermap');
		$this->load->model('playertbl_m', 'player');
	}
	
	public function test(){
		$this->plan->get_all();
	}
	
	public function index($id = false)
	{
		$model = null;
		 
		 $plans_enum =  build_enum($this->plan->get_all() , 'planId', 'name');
		 $teams_enum = build_enum($this->team->get_all(), 'TEAMID', 'NAME');
		 $players_tag = array('home' => array(), 'away' => array());
		  
		  if($id == 'CREATE NEW') redirect('backend/game');
		  else if($id){
		 	$model = $this->game->get($id);
			 if(!$model) show_404();
			 			 
			$model->HOME_PLAYERS = $this->player->get_many_by('TEAMID', $model->HOME_TEAMID);
			$model->AWAY_PLAYERS = $this->player->get_many_by('TEAMID', $model->AWAY_TEAMID);
		  	$model->HOME_PLAYERS_TAG = build_enum($this->playermap->get_many_by(array('GAMEID' => $id, 'TEAMID' => $model->HOME_TEAMID)), 'PLAYERID', 'EUID');
		  	$model->AWAY_PLAYERS_TAG = build_enum($this->playermap->get_many_by(array('GAMEID' => $id, 'TEAMID' => $model->AWAY_TEAMID)), 'PLAYERID', 'EUID');
			$model->OTHERS_TAG	 = build_enum($this->playermap->get_many_by(array('GAMEID' => $id, 'TEAMID' => -1)), 'PLAYERID', 'EUID');
		 }
		  
		 if($this->input->post('game')){
		 	$game = $this->input->post('game');
			$game['ANALYSIS'] = 0;
		 	$playermap = $game['playermap'];
			
			if($id){
				$this->playermap->delete_by("GAMEID = '{$id}'");
				$success = $this->game->update($id, array(
					'HOME_TEAMID' => $game['HOME_TEAMID'],
					'AWAY_TEAMID' => $game['AWAY_TEAMID'],
					'ANALYSIS'	  => $game['ANALYSIS'],
				));
			}
			else{
				// insert game
				$success = $this->game->insert(array(
					'HOME_TEAMID' => $game['HOME_TEAMID'],
					'AWAY_TEAMID' => $game['AWAY_TEAMID'],
					'PLANID' => $game['PLANID'],
					'ANALYSIS'	  => $game['ANALYSIS'],
				));
				if($success) $id = $success;	 // success insert	
			}
			
			// IF update or insert success
			if($success){
				// set all analysis value of gametbl 1 except this game
				$this->game->update_by("GAMEID <> '{$id}'", array('ANALYSIS' => 1));
				
				// insert player table map
				foreach(array('HOME', 'AWAY') as $team_type){
					foreach($playermap[$team_type] as $player_id => $euid){
						if(!$euid) continue;
						$this->playermap->insert(array(
							'GAMEID' => $id,
							'TEAMID' => $game[ $team_type . "_TEAMID" ],
							'PLAYERID' => $player_id,
							'EUID' => $euid
						));
					}
				}
				
				// ball
				if(isset($game['ball_tag']) && $game['ball_tag']){
					$this->playermap->insert(array(
						'GAMEID' => $id,
						'TEAMID' => -1,
						'PLAYERID' => -1,
						'EUID' => $game['ball_tag']
					));	
				}
				
				// referee
				if(isset($game['referee_tag']) && $game['referee_tag']){
					$this->playermap->insert(array(
						'GAMEID' => $id,
						'TEAMID' => -1,
						'PLAYERID' => -2,
						'EUID' => $game['referee_tag']
					));	
				}
				
				$this->session->set_flashdata('success_msg', 'SAVE SUCCESS');
				redirect('backend/game/index/' . ($id?$id:''));
			}
			 else{
			 	$model = (object) array_merge((array) ($model==null?array():$model), $game);
				$model->HOME_PLAYERS = $playermap['HOME'];
				$model->AWAY_PLAYERS = $playermap['AWAY'];
			 }
		 }
		 
		 $this->load->helper('form');
		 $this->template->build('game', compact('teams_enum', 'plans_enum', 'model'));
	}
	
	function delete($id){
		if(($game = $this->game->get($id))){
			$this->game->delete($id);
			$this->playermap->delete_by("GAMEID = '{$id}'");
			redirect('backend/game');	
		}
		show_404();
	}
	
	function ajax_playerlist($team_id){
		$this->load->model('playertbl_m', 'player');
		$players = $this->player->get_many_by('TEAMID', $team_id);
		echo json_encode($players); 
	}
	
	function table_playermap($type, $team_id){
		$players = $this->player->get_many_by('TEAMID', $team_id);
		$this->load->view('game_playermap_table_tbody', 
			array('type' => $type, 'players' => $players, 'players_tag' => array()));
	}

	function game_list(){
		$games_enum = $this->game->with('HOME_TEAM')->with('AWAY_TEAM')->get_all();
		$this->load->view('game_list', compact('games_enum'));
	}
	
}

/* End of file game.php */
/* Location: ./application/modules/backend/controllers/game.php */
