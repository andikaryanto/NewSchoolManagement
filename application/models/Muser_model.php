<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Muser_model extends MY_Model {

    public function __construct()
    {
        parent::__construct();
        
        $this->load->helper('helpers');
        $this->load->library('session');
        $this->load->model('Mgroupuser_model');
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
        $this->db->join('m_groupusers as b', 'a.GroupId = b.Id', 'left');
        $this->db->where('a.Id', $id);
        $query = $this->db->get();
        return $query->row(); // a single row use row() instead of result()
    }

    public function get_usersetting_by_userid($id){
        $this->db->select('a.*,
                            b.Id as ColorId,
                            b.Name as ColorName,
                            b.Value as ColorValue,
                            b.CssClass,
                            b.CssPath,
                            b.CssCustomPath,
                            c.Id as LanguageId,
                            c.Name as Language');
        $this->db->from('m_usersettings as a');
        $this->db->join('g_colors as b', 'a.ColorId = b.Id', 'left');
        $this->db->join('g_languages as c', 'a.LanguageId = c.Id', 'left');
        $this->db->where('a.UserId', $id);
        $query = $this->db->get();
        return $query->row();
    }
    
    public function get_sigle_data_user($username, $password)
    {
        $md5pass = encryptMd5("school".$username.$password);
        $this->db->select('a.*, b.GroupName');
        $this->db->from('m_users as a');
        $this->db->join('m_groupusers as b', 'a.GroupId = b.Id', 'left');
        $this->db->where('UserName', $username);
        $this->db->where('Password', $md5pass);
        $this->db->where('IsActive', 1);
        //$this->db->where('IsLoggedIn', 0);
        $query = $this->db->get();
        return $query->row(); // a single row use row() instead of result()
    }

    public function get_datapages($page, $pagesize, $search = null)
    {
        $this->db->select('a.*, b.GroupName');
        $this->db->from('m_users as a');
        $this->db->join('m_groupusers as b', 'a.GroupId = b.Id', 'left');
        //$this->db->where('IsActive', 1);
        $this->db->where_not_in('UserName', 'superadmin');
        if(!empty($search))
        {
            $this->db->like('UserName', $search);
        }
        
        $this->db->order_by('a.IsActive','DESC');
        $this->db->order_by('a.UserName','ASC');
        $this->db->limit($pagesize, ($page-1)*$pagesize);
        $query = $this->db->get();

        return $query->result();

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
        $this->db->where('UserName', $name);
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

class Muser_model_object extends Model_object {
	
	public function group_user()
	{
		$CI = get_instance();
		
		$CI->load->model('Mgroupuser_model');	// just another CI Power Model object
		$groupuser = $CI->Mgroupuser_model->get($this->GroupId);
		if ($groupuser)
			return $groupuser;
		return '';
	}
}