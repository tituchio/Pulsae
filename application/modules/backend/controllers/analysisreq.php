<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Analysisreq extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('analysisreqtbl_m', 'analysisreq');
	}
	
	public function index($id = false)
	{
		$this->load->model('gametbl_m', 'game');
		
		$model = null;
		 $analysisreqs_enum = build_enum($this->analysisreq->get_all(), 'ANALYSISID', 'GAMEID');
		 $games_enum			= $this->game->with('HOME_TEAM')->with('AWAY_TEAM')->get_all();
		 
		 if($id){
		 	$model = $this->analysisreq->get($id);
			 if(!$model) show_404();
		 }
		 
		 if($this->input->post('analysisreq')){
		 	$analysisreq = $this->input->post('analysisreq');
			 $analysisreq['STATUS'] = 0;
			 if($id) $success =  $this->analysisreq->update($id, $analysisreq);
			 else $success = $this->analysisreq->insert($analysisreq);
			 
			 if($success){
				 redirect('backend/analysisreq/index/' . (!$id?$success:$id) );
			 }
			 else{
			 	$model = (object) array_merge((array) $model, $analysisreq);
			 }
		 }
		 
		 $this->load->helper('form');
		 $this->template->build('analysisreq', compact('analysisreqs_enum', 'model', 'games_enum'));
	}
	
	function delete($id){
		if(($analysisreq = $this->analysisreq->get($id))){
			$this->analysisreq->delete($id);
			redirect('backend/analysisreq');	
		}
		show_404();
	}

	function analysisreq_list($selected_id = false){
		$this->load->model('gametbl_m', 'game');
		$analysisreqs_enum = $this->analysisreq->get_all();
		foreach($analysisreqs_enum as $key => $val){
			$analysisreqs_enum[$key]->GAME = $this->game->with('HOME_TEAM')->with('AWAY_TEAM')->get($val->GAMEID);
		}
		$this->load->view('analysisreq_list', compact('analysisreqs_enum', 'selected_id'));
	}
	
}

/* End of file analysisreq.php */
/* Location: ./application/modules/backend/controllers/analysisreq.php */
