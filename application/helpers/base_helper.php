<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	/**
	 *****************************
	 * ENCYPT
	 *****************************
	 */
	function enc($text){
		return md5($text).strlen($text);
	}
	/**
	 *****************************
	 * FORM
	 *****************************
	 */
	function f_val($post_field, $data, $field = false){
		if(!$field) $field = $post_field;
		return set_value(
			$post_field,
			(isset($data->$field)?$data->$field:FALSE)
		);
	}
	
	function g_val($data, $prop){
		$props = explode('.', $prop);
		if(count($props) == 1){
			return isset($data->$prop)?$data->$prop:(is_array($data) && isset($data[$prop])?$data[$prop]:'');
		}
		else{
			$prop = $props[0]; 
			array_shift($props);
			if(is_array($props))
				$next_prop = implode(".", $props);
			else 
				$next_prop = $props;
			return isset($data->$prop)?g_val($data->$prop, $next_prop):(is_array($data) && isset($data[$prop])?g_val($data[$prop], $next_prop):'');
		}
	}
	
	
	/**
	 *****************************
	 * AJAX
	 *****************************
	 */
	function ajax_response($that, $status='ok', $data=NULL, $message=NULL){	
		header('Content-type: application/json');
		$that->ajaxresponse->status = $status;
		$that->ajaxresponse->data = $data;
		$that->ajaxresponse->messages = $message;
		echo json_encode($that->ajaxresponse);
		exit(0);
	}
	
	/**
	 *****************************
	 * DATE
	 *****************************
	 */
	function now($format = 'Y-m-d H:i:s')
	{ return date($format); }
	
	//======= END OF CORE ============//
	
	function build_filter($that, $fields = array(), $defaults = array()){
		$filter = array();
		foreach($fields as $k){
			if($that->input->post($k) === false || $that->input->post($k) == '' || $that->input->post($k) == '-1') continue;
			$filter[] = "$k = '" . $that->input->post($k) . "'";
		}
		foreach($defaults as $k => $v){
			$filter[] = "$k = '$v'";
		}
		return count($filter) == 0 ? NULL : implode(" and ", $filter);
	}
	
	function bulan($index){
		$CI =& get_instance();
		$bulan = $CI->m_base->bulan($index);
		return isset($bulan[$index])?$bulan[$index]:" ";
	}
	
	/**
	 *****************************
	 * URL
	 *****************************
	 */
	function uri_segment($id){
		$uri = uri_string();
		if(!empty($uri))    {
			$uri_array = explode('/',$uri);
			return $uri_array[$id];
		}
		else return NULL;
	}
	
	/**
	 * Date Helper
	 *
	 * @author Ardi Imawan, ardiimawan@yahoo.co.id
	 */



	/**
	 * Date Format DB
	 *
	 **/
	function date_format_db($date_text, $separator = '/'){
		$contains_separator = strpos($date_text, $separator);
			if(!$contains_separator)
			{ return $date_text; }
			list($d, $m, $y) = explode($separator, $date_text);
			$date = $y.'-'.$m.'-'.$d;
			return $date;
	}

	function date_format_indo($date_text, $separator = '-'){
		$contains_separator = strpos($date_text, $separator);
			if(!$contains_separator)
			{ return $date_text; }
			$date = explode(" ", $date_text);
			list($y, $m, $d) = explode($separator, $date[0]);
			$date = $d.'/'.$m.'/'.$y;
			return $date;
	}
	
	/**
	 *****************************
	 * JSON
	 *****************************
	 */
	
	
	function json_get_item($json, $key){
		if(is_string($json) && trim($json) != "" ){
			$json = json_decode($json);	// string to object
		}
		if(is_object($json)){
			if(isset($json->$key)) return $json->$key;
			else NULL;
		}
		else return NULL;
	}
	
	function json_set_item($json, $key, $object){
		if(is_string($json)&& trim($json) != "" ){
			$json = json_decode($json);	// string to object
		}
		$obj = (object)array();
		if(is_object($json) && $json != null) $obj = $json;
		
		$obj->$key = $object;
		return $obj;
	}

	function build_enum($data, $key, $val){
		$enum = array();
		foreach($data as $record){
			$enum[$record->$key] = $record->$val; 
		}
		return $enum;
	}	
	
?>
