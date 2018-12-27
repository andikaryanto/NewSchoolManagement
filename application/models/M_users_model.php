<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_users_model extends MY_Model {

    public function __construct()
    {
        parent::__construct();
        
        $this->load->model('M_groupusers');
    }

    public function get_sigle_data_user($username, $password)
    {
        $md5pass = encryptMd5("school".$username.$password);
        $where = array(
            'Username'=> $username,
            'Password'=> $md5pass,
            'IsActive'=> 1
        );

        $params = array(
            'where' => $where
        );

       return $this->get(null, null, $params);
    }

    public function saveNewPassword($username, $password, $newPassword){
        
        $md5pass = encryptMd5("school".$username.$password);
        $newmd5pass = encryptMd5("school".$username.$newPassword);
        $this->db->set('Password', $newmd5pass);
        $this->db->where('Password', $md5pass);
        $this->db->update('m_users');
    }

    public function is_data_exist($name = null)
    {
        $exist = false;
        $this->db->select('*');
        $this->db->from('m_users');
        $this->db->where('Username', $name);
        $query = $this->db->get();

        $row = $query->result();
        if(count($row) > 0){
            $exist = true;
        }
        return $exist;
    }

    public function validate($model, $oldmodel= null)
    {
        $nameexist  = false;
        $warning    = array();

        if(!empty($oldmodel))
        {
            if($model->Username != $oldmodel->Username)
            {
                $nameexist = $this->is_data_exist($model->Username);
            }
        }
        else{
            if(!empty($model->Username))
            {
                $nameexist = $this->is_data_exist($model->Username);
            }
            else{
                $warning = array_merge($warning, array(0=>'err_msg_name_can_not_null'));
            }
        }

        if($nameexist)
            $warning = array_merge($warning, array(0=>'err_msg_name_exist'));

        if(empty($model->GroupId))
            $warning = array_merge($warning, array(0=>'err_msg_groupuser_can_not_null'));

        if(empty($model->Password))
            $warning = array_merge($warning, array(0=>'err_msg_password_can_not_null'));

        
        return $warning;
    }

    public function validate_changepassword($username, $oldpassword, $newpassword, $confirmpassword){
        $warning = array();
        $datauser = $this->get_sigle_data_user($username, $oldpassword);
        if($datauser){
            if($newpassword != $confirmpassword){
                $warning = array_merge($warning, array(0=>'err_wrong_confirmed_password'));
            }
        } else {
            $warning = array_merge($warning, array(0=>'err_wrong_password'));
        }
        return $warning;

    }   
    
}

class M_user_object extends Model_object {
   
	public function M_groupusers()
	{
		$CI = get_instance();
		
        $CI->load->model('M_groupusers');	// just another CI Power Model objec 
        if(isset($this->GroupId)){
            $groupuser = $CI->M_groupusers->get($this->GroupId);
            if (isset($groupuser))
                return $groupuser;
        }
		return $CI->M_groupusers->new_object();
    }
    
    public function M_usersettings()
	{
		$CI = get_instance();
		
		$CI->load->model('M_usersettings');	// just another CI Power Model object
        if(isset($this->Id)){
            $usersettings = $CI->M_usersettings->get_data_by_userid($this->Id);
            if (isset($usersettings))
                return $usersettings;
        }
		return $CI->M_usersettings->new_object();
    }
    
    public function save_with_detail(){
        $id = $this->save();
        $user_settings = $this->M_usersettings();
        $user_settings->UserId = $id;
        $user_settings->LanguageId = 1;
        $user_settings->ColorId = 1;
        $user_settings->RowPerpage = 5;
        $user_settings->save();
        return $id;
    }
}