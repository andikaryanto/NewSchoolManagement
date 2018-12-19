<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mgroupuser_model extends MY_Model {
    public $id;
    public $groupname;
    public $description;
    public $ion;
    public $iby;
    public $uon;
    public $uby;

    public function __construct(){
        parent::__construct();
        $this->load->model(array("Mform_model"));
        $this->load->library('session');
        $this->load->library('paging');
    }
    
    public function get_alldata()
    {
        $query = $this->db->get('m_groupusers');
        return $query->result();
    }

    public function get_data_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('m_groupusers');
        $this->db->where('Id', $id);
        $query = $this->db->get();
        return $query->row(); // a single row use row() instead of result()
    }

    public function get_datapages($page, $pagesize, $search = null)
    {
        
        $this->db->select('*');
        $this->db->from('m_groupusers');
        if(!empty($search))
        {
            $this->db->like('GroupName', $search);
        }
        $this->db->order_by('IOn','ASC');
        $this->db->limit($pagesize, ($page-1)*$pagesize);
        $query = $this->db->get();

        return $query->result();

    }

    public function get_role($groupid)
    {
        //where 
        //$group = array($groupid, null);

        $this->db->select('*');
        $this->db->from('view_m_accessroles');
        $this->db->where('GroupId', $groupid);
        $this->db->or_where('GroupId', null);
        $this->db->order_by('ClassName', 'ASC');
        $this->db->order_by('Header', 'DESC');
        $this->db->order_by('FormName', 'ASC');
        $query = $this->db->get();
        
        return $query->result();
    }

    public function save_data($data)
    {
        $this->db->insert('m_groupusers', $data);
    }

    public function edit_data($data)
    {
        $this->db->where('Id', $data['id']);
        $this->db->update('m_groupusers', $data);
    }

    public function delete_data($id)
    {
        $this->db->where('Id', $id);
        if(!$this->db->delete('m_groupusers')){
            return $this->db->error();
        }
        else{
            return;
        }
    }

    public function save_role($data)
    {
        $this->db->select('*');
        $this->db->from('m_accessroles');
        $this->db->where('GroupId', $data['groupid']);
        $this->db->where('FormId', $data['formid']);
        $query = $this->db->get()->row();
        if($query)
        {
            $this->db->where('GroupId', $data['groupid']);
            $this->db->where('FormId', $data['formid']);
            $this->db->update('m_accessroles', $data);
        }
        else
        {
            $this->db->insert('m_accessroles', $data);
        }
    }

    public function create_object($id, $groupname, $description, $ion, $iby, $uon, $uby)
    {
        $data = array(
            'id' => $id,
            'groupname' => $groupname,
            'description' => $description,
            'ion' => $ion,
            'iby' => $iby,
            'uon' => $uon,
            'uby' => $uby,
        );

        return $data;
    }

    public function create_object_role_tabel($groupid, $formid, $read, $write, $delete, $print)
    {
        $data = array(
            'groupid' => $groupid,
            'formid' => $formid,
            'read' => $read,
            'write' => $write,
            'delete' => $delete,
            'print' => $print
        );

        return $data;
    }

    public function create_object_role($groupid, $formid, $formname, $aliasname, $read, $write, $delete, $print)
    {
        $data = array(
            'groupid' => $groupid,
            'formid' => $formid,
            'formname' => $formname,
            'aliasname' => $aliasname,
            'read' => $read,
            'write' => $write,
            'delete' => $delete,
            'print' => $print
        );

        return $data;
    }

    public function is_data_exist($groupname = null)
    {
        $exist = false;
        $this->db->select('*');
        $this->db->from('m_groupusers');
        $this->db->where('GroupName', $groupname);
        $query = $this->db->get();

        $row = $query->result();
        if(count($row) > 0){
            $exist = true;
        }
        return $exist;
    }

    public function validate($model, $oldmodel = null)
    {
        $nameexist = false;
        $warning = array();
        
        if(!empty($oldmodel))
        {
            if($model['groupname'] != $oldmodel['groupname'])
            {
                $nameexist = $this->is_data_exist($model['groupname']);
            }
        }
        else{
            if(!empty($model['groupname']))
            {
                $nameexist = $this->is_data_exist($model['groupname']);
            }
            else{
                $warning = array_merge($warning, array(0=>'ui_msg_group_name_can_not_null'));
            }
        }
        if($nameexist)
        {
            $warning = array_merge($warning, array(0=>'err_msg_name_exist'));
        }
        
        return $warning;
    }

    
    public function has_role($groupid, $formid, $role)
    {
        $permitted = false;
        $this->db->select('*');
        $this->db->from('m_accessroles');
        $this->db->where('GroupId', $groupid);
        $this->db->where('FormId', $formid);
        $this->db->where($role, 1);
        $query = $this->db->get();
        $result = $query->row();
        if($result)
        {
            $permitted = true;
        }

        return $permitted;
    }

    public function is_permitted($groupid = null, $form = null, $role = null)
    {
        $formid = $form;
        if(isset($form)){
            $forms = $this->Mform_model->get_data_by_formname($form);
            $formid = $forms->Id;
        }

        $permitted = false;
        if($this->paging->is_superadmin($_SESSION['userdata']['username'])
            ||  $this->has_role($groupid,$formid,$role)
        )
        {
            $permitted = true;
        }
        return $permitted;
    }
    
}