<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_users_model extends MY_Model {

    public function __construct()
    {
        parent::__construct();
        
        $this->load->model('M_groupusers');
    }
    
    public function get_alldata()
    {
        $query = $this->db->get('m_users');
        return $query->result();
    }

    public function get_data_by_id($id)
    {
        $this->db->select('a.*, b.GroupName');
        $this->db->from('m_users as a');
        $this->db->join('m_groupusers as b', 'a.GroupId = b.Id', 'left');
        $this->db->where('a.Id', $id);
        $query = $this->db->get();
        return $query->row(); // a single row use row() instead of result()
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

    public function get_datapages($page, $pagesize, $search = null)
    {
        $this->db->where('IsActive', 1);
        $this->db->where_not_in('Username', 'superadmin');
        if(!empty($search))
        {
            $this->db->like('Username', $search);
        }
        
        $this->db->order_by('IsActive','DESC');
        $this->db->order_by('Username','ASC');
        $this->db->limit($pagesize, ($page-1)*$pagesize);
        return $this->get_list();

    }

    public function get_data_by_name($name){
        $this->db->select('a.*, b.GroupName');
        $this->db->from('m_users as a');
        $this->db->join('m_groupusers as b', 'a.GroupId = b.Id', 'left');
        $this->db->where('a.Username', $name);
        $query = $this->db->get();
        return $query->row();
    }

    public function set_loggedin($username){
        $this->db->set('IsLoggedIn', 1);
        $this->db->where('Username', $username);
        $this->db->update('m_users');
    }

    public function set_logout($username){
        $this->db->set('IsLoggedIn', 0);
        $this->db->where('Username', $username);
        $this->db->update('m_users');
    }

    public function save_data($data)
    {
        if($this->db->insert('m_users', $data)){
            $user = $this->get_data_by_name($data['username']);
            $usersetting = $this->create_usersetting_object(null, $user->Id);
            $this->db->insert('m_usersettings', $usersetting);
        }
    }

    public function edit_data($data)
    {
        $this->db->where('Id', $data['id']);
        $this->db->update('m_users', $data);
    }

    public function edit_usersetting($data){
        $this->db->where('Id', $data['id']);
        $this->db->update('m_usersettings', $data);
    }

    public function delete_data($id)
    {
        $this->db->set('IsActive', 0);
        $this->db->set('GroupId', null);
        $this->db->where('Id', $id);
        $this->db->update('m_users');
    }

    public function activate_data($id)
    {
        $this->db->set('IsActive', 1);
        $this->db->where('Id', $id);
        $this->db->update('m_users');
    }

    public function saveNewPassword($username, $password, $newPassword){
        
        $md5pass = encryptMd5("school".$username.$password);
        $newmd5pass = encryptMd5("school".$username.$newPassword);
        $this->db->set('Password', $newmd5pass);
        $this->db->where('Password', $md5pass);
        $this->db->update('m_users');
    }

    public function create_usersetting_object($id = null, $userid = null,
        $languageid = '1', 
        $colorid = '1',
        $rowperpage = 5){
            
        $data = array(
            'id' => $id,
            'userid' => $userid,
            'languageid' => $languageid,
            'colorid' => $colorid,
            'rowperpage' => $rowperpage
        );
        return  $data;

    }

    public function changeLanguage($username,$language){
        $this->db->set('Language', $language);
        $this->db->where('Username', $username);
        $this->db->update('m_users');
    }

    public function create_object($id, $groupuserid, $groupname, $username, $password, $ion, $iby, $uon, $uby)
    {
        $md5pass = null;
        if(!empty($password))
            $md5pass = encryptMd5("school".$username.$password);

        $data = array(
            'id' => $id,
            'groupid' => $groupuserid,
            'groupname' => $groupname,
            'username' => $username,
            'password' => $md5pass,
            'ion' => $ion,
            'iby' => $iby,
            'uon' => $uon,
            'uby' => $uby,
        );

        return $data;
    }

    public function create_object_tabel($id, $groupuserid,$username, $password, $ion, $iby, $uon, $uby)
    {
        $md5pass = null;
        if(!empty($password))
            $md5pass = encryptMd5("school".$username.$password);

        $data = array(
            'id' => $id,
            'groupid' => $groupuserid,
            'username' => $username,
            'password' => $md5pass,
            'ion' => $ion,
            'iby' => $iby,
            'uon' => $uon,
            'uby' => $uby,
        );

        return $data;
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
            if($model['username'] != $oldmodel['username'])
            {
                $nameexist = $this->is_data_exist($model['username']);
            }
        }
        else{
            if(!empty($model['username']))
            {
                $nameexist = $this->is_data_exist($model['username']);
            }
            else{
                $warning = array_merge($warning, array(0=>'err_msg_name_can_not_null'));
            }
        }

        if($nameexist)
            $warning = array_merge($warning, array(0=>'err_msg_name_exist'));

        if(empty($model['groupid']))
            $warning = array_merge($warning, array(0=>'err_msg_groupuser_can_not_null'));

        if(empty($model['password']))
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
    
    public function clone(){
        $CI = get_instance();
		
		$CI->load->model('M_users');
        $new_data = $CI->M_users->new_object();
        $new_data->Id = $this->Id;
        $new_data->GroupId = $this->GroupId;
        $new_data->UserName = $this->UserName;
        $new_data->Description = $this->Id;
        $new_data->IOn = $this->IOn;
        $new_data->IBy = $this->IBy;
        $new_data->UOn = $this->UOn;
        $new_data->UBy = $this->UBy;
        return $new_data;
    }

	public function M_groupusers()
	{
		$CI = get_instance();
		
		$CI->load->model('M_groupusers');	// just another CI Power Model object
		$groupuser = $CI->M_groupusers->get($this->GroupId);
		if (isset($groupuser))
			return $groupuser;
		return $CI->M_groupusers->new_object();
    }
    
    public function M_usersettings()
	{
		$CI = get_instance();
		
		$CI->load->model('M_usersettings');	// just another CI Power Model object
		$usersettings = $CI->M_usersettings->get_data_by_userid($this->Id);
		if (isset($usersettings))
			return $usersettings;
		return $CI->M_usersettings->new_object();
	}
}