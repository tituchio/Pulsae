<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Rd_role {

	var $roles = array(
		'admin' => array(
			'allow' => array('*')
		),
		'guest' => array(
			'deny' => array('backend/*')
		)
	), $CI;
	
    public function __construct()
    {
    	$this->CI =& get_instance();
		$this->CI->load->helper('url');
		
		if(!$this->check_roles()){
			redirect('auth/login');
		}
    }
	
	/**
	 * You can change code below
	 */
	private function in_group($group){
		if($group == 'guest'){
			$guest = !$this->CI->ion_auth->logged_in();
			return $guest;
		}
		return $this->CI->ion_auth->in_group($group);
	}
	
	public function set_roles($roles){
		foreach($roles as $group => $role){
			if(isset($role['allow']))
				$this->roles[$group]['allow'] = $role['allow'];
			else if(isset($role['deny']))
				$this->roles[$group]['deny'] = $role['deny']; 
		}
		
		return $this->check_roles();
	}
	
	public function check_roles(){
		$url_segment = str_replace(base_url(), "", current_url()) . "/";
		
		foreach($this->roles as $group => $role){
			if($this->in_group($group)){
				if(isset($role['allow'])){
					foreach($role['allow'] as $url){
						if(fnmatch($url, $url_segment)) return TRUE;
					}
				}
				if(isset($role['deny'])){
					foreach($role['deny'] as $url){
						if(fnmatch($url, $url_segment)) return FALSE;
					}
				}
			}
		}
		
		return TRUE;
	}
}

/* End of file Rd_role.php */