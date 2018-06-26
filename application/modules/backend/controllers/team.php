<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Team extends MX_Controller {

	var $upload_dir = './uploads/team/';

	public function __construct(){
		parent::__construct();
		$this->load->model('teamtbl_m', 'team');
	}
	
	public function index($id = false)
	{
		$model = null;
		 $teams_enum = build_enum($this->team->get_all(), 'TEAMID', 'NAME');
		 
		 if($id){
		 	$model = $this->team->get($id);
			 if(!$model) show_404();
		 }
		 
		 if($this->input->post('team')){
		 	$team = $this->input->post('team');
			 if($id) $success =  $this->team->update($id, $team);
			 else $success = $this->team->insert($team);
			 
			 if($success){
			 	$upload_error = $this->_do_upload( !$id?$success:$id  );
				 if(!$upload_error)
				 	redirect('backend/team/index/' . (!$id?$success:$id) );
			 }
			 else{
			 	$model = (object) array_merge((array) $model, $team);
			 }
		 }
		 
		 $this->load->helper('form');
		 $this->template->build('team', compact('teams_enum', 'model', 'upload_error'));
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
				$this->team->update($id, array('IMAGE' => $pic['file_name']));
			}	
		}
		
	}
	
	function delete($id){
		if(($team = $this->team->get($id))){
			$this->_remove_image($team->IMAGE);
			$this->team->delete($id);
			redirect('backend/team');	
		}
		show_404();
	}
	
	function _remove_image($filename){
		unlink($this->upload_dir . $filename);
	}
	
}

/* End of file team.php */
/* Location: ./application/modules/backend/controllers/team.php */
