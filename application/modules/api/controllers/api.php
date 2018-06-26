<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends MX_Controller {

	
	public function index()
	{
	}
	
	/**
	 * INITIAL DATA FOR ANALYSIS PAGE
	 */
	public function init($analysis_id){
		ini_set("memory_limit","256M");
		$this->load->model('analysisreqtbl_m', 'analysisreq');
		$this->load->model('analysisteamtbl_m', 'analysisteam');
		$this->load->model('teamtbl_m', 'team');
		$this->load->model('playertbl_m', 'player');
		$this->load->model('playermaptbl_m', 'playermap');
		$this->load->model('gametbl_m', 'game');
		$this->load->model('positionlog_m', 'position');
		
		$analysisreq = $this->analysisreq->get_by('ANALYSISID', $analysis_id);
		
		$game = $this->game->with('PLAN')->get_by('GAMEID', $analysisreq->GAMEID);
		
		$teams = $this->team->with('players')->get_many_by("TEAMID IN ({$game->HOME_TEAMID}, {$game->AWAY_TEAMID})");
		
		$game->teams = array(
			'HOME' => $this->team->with('players')->get($game->HOME_TEAMID),
			'AWAY' => $this->team->with('players')->get($game->AWAY_TEAMID)
		);		
		
		// EUID
		$playermap = array();
		foreach($this->playermap->get_many_by('GAMEID', $game->GAMEID) as $player){
			$playermap[$player->PLAYERID] = $player;
		}
		
		/*
		foreach($game->teams['HOME']->players as $key => $player){
			$event = $this->position->get_by('euid', $playermap[$player->PLAYERID]->EUID);
			$game->teams['HOME']->players[$key]->x = $event?$event->localX/800*100:0; 
			$game->teams['HOME']->players[$key]->y = $event?$event->localY/600*100:0;
		}
		
		foreach($game->teams['AWAY']->players as $key => $player){
			$event = $this->position->get_by('euid', $playermap[$player->PLAYERID]->EUID);
			$game->teams['AWAY']->players[$key]->x = $event?$event->localX/800*100:0; 
			$game->teams['AWAY']->players[$key]->y = $event?$event->localY/600*100:0;
		}
		// */
		
		// ANALYSIS
		$analysis = $this->_get_analysis_events($analysis_id);
		
		//ANALYSIS TEAM
		$analysisteam = $this->analysisteam->order_by('addTime', 'ASC')->get_many_by('ANALYSISID', $analysis_id);
		
		// FROM & TO TIME
		$game->FROM_TIME = count($analysis['events']) > 0?$analysis['events'][0]->addTime:0;
		$game->TO_TIME = count($analysis['events']) > 0?$this->analysis->order_by('addTime', 'DESC')->limit(1)->get_by('ANALYSISID', $analysis_id)->addTime : 0;	

		$return = array(
			'analysisreq' => $analysisreq,
			'game' => $game,
			'analysis' =>$analysis,
			'analysisteam' => $analysisteam 
		); 
		echo json_encode($return);
	}

	public function analysis_next($analysis_id, $last_id){
		$this->load->model('analysistbl_m', 'analysis');
		$this->load->model('teamtbl_m', 'team');
		
		$events = $this->analysis->order_by('addTime', 'ASC')->limit(1000)->get_many_by("ANALYSISID = {$analysis_id} AND OID > {$last_id}");
		$analysis = array(
			'events' => $events
		);
		echo json_encode($analysis);
	}
	/**
	 * GET ANALISIS EVENTS
	 */
	private  function _get_analysis_events($analysisid){
		$this->load->model('analysistbl_m', 'analysis');
		$this->load->model('teamtbl_m', 'team');
		
		$events = $this->analysis->order_by('addTime', 'ASC')->limit(20000)->get_many_by('ANALYSISID', $analysisid);
		//$events = $this->analysis->get_all();die("DIE!!");
		$player_status = array();
		
		$teams = $this->team->with('players')->get_all();
		$player_status_last = array();
		foreach($teams as $team){
			foreach($team->players as $player){
				$player_status[$player->PLAYERID][] = array(
						'BALLKEEPTIME' => 0,
						'PASSSUCESS' => 0,
						'PASSFAIL' => 0,
						'DISTANCE' => 0,
						'VELOCITY_TOTAL' => 0,
						'VELOCITY_MAX' => 0,
						'VELOCITY_COUNT' => 0
					);
				$player_status_last [$player->PLAYERID] = 0;
			}
		}
		$player_status_map = array(0 => $player_status_last);  /*
		foreach($events  as $i => $event){
			if($event->PLAYERID && $event->PLAYERID >= 0){				
					//$player_status_last_count = count($player_status_last[$event->PLAYERID]);
					//$player_last_status = $player_status[$event->PLAYERID][$player_status_last[$event->PLAYERID][$player_status_last_count-1]];
					$player_last_status = $player_status[$event->PLAYERID][$player_status_last[$event->PLAYERID]];
					if($event->BALLKEEPTIME) $player_last_status['BALLKEEPTIME'] += $event->BALLKEEPTIME; 
					if($event->PASSSUCESS) $player_last_status['PASSSUCESS'] += $event->PASSSUCESS;
					if($event->PASSFAIL) $player_last_status['PASSFAIL'] += $event->PASSFAIL;
					if($event->DISTANCE) $player_last_status['DISTANCE'] += $event->DISTANCE;
					if($event->VELOCITY){
						$player_last_status['VELOCITY_TOTAL'] += $event->VELOCITY;
						$player_last_status['VELOCITY_MAX'] = max($player_last_status['VELOCITY_MAX'], $event->VELOCITY);
						$player_last_status['VELOCITY_COUNT']++;
					} 
					$player_status[$event->PLAYERID][] =$player_last_status;
					$player_status_last[$event->PLAYERID] = count($player_status[$event->PLAYERID]) - 1; 
			}
			$player_status_map[$event->addTime] =$player_status_last; 
		}
		// */
		$analysis = array(
			'playerStatuses' => $player_status,
			'playerStatusMap' => $player_status_map,
			'events' => $events
		);
		
		return $analysis;
	}

	/**
	 * INITIALIZE DATA FOR REALTIME
	 */
	public function initRealtime(){
		$this->load->model('teamtbl_m', 'team');
		$this->load->model('gametbl_m', 'game');
		$this->load->model('playertbl_m', 'player');
		$this->load->model('playermaptbl_m', 'playermap');
		
		$game = $this->game->with('PLAN')->get_by('analysis', 0);
		$game->teams = (object) array(
			'HOME' => $this->team->get($game->HOME_TEAMID),
			'AWAY' => $this->team->get($game->AWAY_TEAMID)
		);	
		if($game){
			$game->teams->HOME->players = $this->playermap->with('player')->get_many_by(array(
				'GAMEID' => $game->GAMEID,
				'TEAMID' => $game->HOME_TEAMID
			));
			
			foreach($game->teams->HOME->players as $key => &$player){
				$player->EUID = strtoupper($player->EUID);
			}
			
			$game->teams->AWAY->players = $this->playermap->with('player')->get_many_by(array(
				'GAMEID' => $game->GAMEID,
				'TEAMID' => $game->AWAY_TEAMID
			));
			foreach($game->teams->AWAY->players as $key => &$player){
				$player->EUID = strtoupper($player->EUID);
			}
			
			$br = $this->playermap->with('player')->get_many_by(array(
				'GAMEID' => $game->GAMEID,
				'TEAMID' => -1
			));
			
			$game->others = array();
			foreach($br as $row){
				$row->EUID = strtoupper($row->EUID);
				if($row->PLAYERID == -1) $game->others['ball'] = $row;
				else if($row->PLAYERID == -2) $game->others['referee'] = $row;
			}
			
		}
		echo json_encode(array('game' => $game));
	}
	
	/**
	 * RECORD REALTIME START/STOP PHASE
	 */
	public function realtimeRecord($gameid, $type){
		$this->load->model('gametbl_m', 'game');
		
		$data = array($type => time());
		if($type == 'SH_ETIME') $data['analysis'] = 1;
		
		$this->game->update($gameid, $data);
	}

	/**
	 * TESTING
	 */
	public  function test($analysisid = 1){
		$this->load->model('analysistbl_m', 'analysis');
		$this->load->model('teamtbl_m', 'team');
		//$this->analysis->test();
		$events = $this->analysis->order_by('addTime')->get_many_by('ANALYSISID', $analysisid);
		die("YEAAH!");
		$events = $this->analysis->order_by('addTime')->get_many_by('ANALYSISID', $analysisid);
		
	}
	
}

/* End of file api.php */
/* Location: ./application/modules/api/controllers/api.php */