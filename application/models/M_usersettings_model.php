<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_usersettings_model extends MY_Model {

    public function __construct()
    {
        parent::__construct();
        
    }

    public function get_data_by_userid($userid){

        $condition = array(
            'where' => array("UserId" => $userid)
        );
        return $this->get(null, null, $condition);
    }
    
}

class M_usersetting_object extends Model_object {

    public function G_languages()
	{
		$CI = get_instance();
		
        $CI->load->model('G_languages');	// just another CI Power Model object
        if($this->LanguageId){
            $languages = $CI->G_languages->get($this->LanguageId);
            if (isset($languages))
                return $languages;
        }
		return $CI->G_languages->new_object();
    }

    public function G_colors()
	{
		$CI = get_instance();
		
		$CI->load->model('G_colors');	// just another CI Power Model object
        if($this->ColorId){
            $colors = $CI->G_colors->get($this->ColorId);
            if (isset($colors))
                return $colors;
        }
		return $CI->G_colors->new_object();
    }
}