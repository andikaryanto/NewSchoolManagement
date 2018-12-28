<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_usersettings_model extends MY_Model {

    public function __construct()
    {
        parent::__construct();
        
    }

    public function get_data_by_userid($userid){

        $condition = array(
            'where' => array("M_User_Id" => $userid)
        );
        return $this->get(null, null, $condition);
    }
    
}

class M_usersetting_object extends Model_object {

}