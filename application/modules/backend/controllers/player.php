<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Player extends MX_Controller {

	var $upload_dir = './uploads/player/';

	public function __construct(){
		parent::__construct();
		$this->load->model('playertbl_m', 'player');
	}
	
	public function index($team_id = false, $id = false)
	{
		$this->load->model('teamtbl_m', 'team');
		if(!$team_id){
			$team = $this->team->get_by('TEAMID', TRUE);
			if(!$team){
				$this->template->build('msg', array('msg' => "Please insert Team data first"));
			}
			else
				redirect('backend/player/index/' . $team->TEAMID);
		}
		else{
			
			
			$model = null;
			 $players_enum = build_enum($this->player->get_many_by('TEAMID', $team_id), 'PLAYERID', 'NAME');
			 
			 
			 $teams_enum = build_enum($this->team->get_all(), 'TEAMID', 'NAME');
			 
			 if($id){
				$model = $this->player->get($id);
				 if(!$model) show_404();
			 }
			 
			 if($this->input->post('player')){
				$player = $this->input->post('player');
				 if($id) $success =  $this->player->update($id, $player);
				 else{
					$player['TEAMID'] = $team_id;
					$success = $this->player->insert($player);
				 } 
				 
				 if($success){
					$upload_error = $this->_do_upload( !$id?$success:$id  );
					 if(!$upload_error)
						redirect("backend/player/index/{$team_id}/" . (!$id?$success:$id) );
				 }
				 else{
					$model = (object) array_merge((array) $model, $player);
				 }
			 }
			 
			 $this->load->helper('form');
			 $this->template->build('player', compact('players_enum','teams_enum', 'team_id',  'model', 'upload_error'));
		}
	}
	
	function _do_upload($id)
	{
		$config['upload_path'] = $this->upload_dir;
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '100';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';

		$this->load->library('upload', $config);

		if(!empty($_FILES['userfile']['name'])){
			if ( ! $this->upload->do_upload())
			{
				return $this->upload->display_errors();
			}
			else
			{
				$pic = $this->upload->data();
				$this->player->update($id, array('IMAGE' => $pic['file_name']));
			}	
		}
		
	}
	
	function delete($id){
		if(($player = $this->player->get($id))){
			$this->_remove_image($player->IMAGE);
			$this->player->delete($id);
			redirect("backend/player/index/{$player->TEAMID}");	
		}
		show_404();
	}
	
	function _remove_image($filename){
		unlink($this->upload_dir . $filename);
	}
	
}

/* End of file player.php */
/* Location: ./application/modules/backend/controllers/player.php */
