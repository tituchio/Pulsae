<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Result extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('gametbl_m', 'game');
	}
	
	public function index($id = false)
	{
		$model = null;
		 $games_enum = $this->game->with('HOME_TEAM')->with('AWAY_TEAM')->get_all();
		 
		 if($id){
		 	$model = $this->game->with('HOME_TEAM')->with('AWAY_TEAM')->get($id);
			 if(!$model) show_404();
		 }
		 
		 if($this->input->post('game')){
		 	$game = $this->input->post('game');
			 if($id) $success =  $this->game->update($id, $game);
			 else $success = $this->game->insert($game);
			 
			 if($success){
				 	redirect('backend/result/index/' . (!$id?$success:$id) );
			 }
			 else{
			 	$model = (object) array_merge((array) $model, $game);
			 }
		 }
		 
		 $this->load->helper('form');
		 $this->template->build('result', compact('games_enum', 'model', 'upload_error'));
	}
	
	function delete($id){
		if(($game = $this->game->get($id))){
			$this->game->delete($id);
			redirect('backend/result');	
		}
		show_404();
	}
	
	function _remove_image($filename){
		unlink($this->upload_dir . $filename);
	}
	
}

/* End of file result.php */
/* Location: ./application/modules/backend/controllers/result.php */
