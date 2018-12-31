<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_user extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //$this->load->database('natureuser', TRUE);
        $this->load->model(array('M_users','M_groupusers', 'G_languages', 'G_colors', 'M_usersettings'));
        $this->load->library(array('paging', 'session','helpers'));
        $this->load->helper('form');
        $this->paging->is_session_set();
    }

    public function index()
    {
        //echo json_encode($_SESSION);
        $form = $this->paging->get_form_name_id();
        if($this->M_groupusers->is_permitted($_SESSION['userdata']['M_Groupuser_Id'],$form['m_user'],'Read'))
        {
            $params = array(
                'where' => array('Username !=' => 'superadmin'),
                'order' => array('Created' => 'ASC')
            );
            //echo json_encode($params['where_not_in']);

            $datapages = $this->M_users->get_list(null, null, $params);
            $data['model'] = $datapages;
            load_view('m_user/index', $data);
        }
       else
        {   
            
            $this->load->view('forbidden/forbidden');
        }
    }

    public function add()
    {
        $form = $this->paging->get_form_name_id();
        if($this->M_groupusers->is_permitted($_SESSION['userdata']['M_Groupuser_Id'],$form['m_user'],'Write'))
        {
            
            $model = $this->M_users->new_object();
            $modal_group = $this->M_groupusers->get_list();
            $data_modal = array(
                'modal_group' => $modal_group
            );
            $data =  $this->paging->set_data_page_add($model, null, $data_modal);
            load_view('m_user/add', $data);   
        }
        else
        {
            
            $this->load->view('forbidden/forbidden');
        }
    }

    public function addsave()
    {
        //$date = new DateTime();
        $warning    = array();
        $err_exist  = false;
       
        $groupid    = $this->input->post('groupid');
        $username   = $this->input->post('named');
        $password   = $this->input->post('password');

        $model = $this->M_users->new_object();
        $model->M_Groupuser_Id = $groupid;
        $model->Username = $username;
        $model->setPassword($password);
        $model->IsLoggedIn = 0;
        $model->IsActive = 1;
        $model->Language = 'indonesia';
        $model->CreatedBy = $_SESSION['userdata']['Username'];
        //echo json_encode($model);
        $validate = $this->M_users->validate($model);
 
        if($validate)
        {
            $this->session->set_flashdata('add_warning_msg',$validate); 
            $modal_group = $this->M_groupusers->get_list();
            $data_modal = array(
                'modal_group' => $modal_group
            );
            $data =  $this->paging->set_data_page_add($model, null, $data_modal);
            load_view('m_user/add', $data);   
        }
        else{
            $new_data = $model->save_with_detail();
            $successmsg = $this->paging->get_success_message();
            $this->session->set_flashdata('success_msg', $successmsg);
            redirect('muser/add');
        }
    }

    public function edit($id)
    {
        $form = $this->paging->get_form_name_id();
        if($this->M_groupusers->is_permitted($_SESSION['userdata']['M_Groupuser_Id'],$form['m_user'],'Write'))
        {
            
            $edit = $this->M_users->get_data_by_id($id);
            $model = $this->M_users->create_object($edit->Id, $edit->M_Groupuser_Id, $edit->GroupName, $edit->Username, $edit->Password, null, null, null, null);
            $data =  $this->paging->set_data_page_edit($model);
            //echo json_encode($edit);
            load_view('m_user/edit', $data);   
        }
        else{
            
            $this->load->view('forbidden/forbidden');
        }
    }

    public function editsave()
    {
       

        $userid     = $this->input->post('userid');
        $groupid    = $this->input->post('groupid');
        $groupname  = $this->input->post('groupname');
        $username   = $this->input->post('named');
        $password   = $this->input->post('password');

        $edit       = $this->M_users->get_data_by_id($userid);
        $model      = $this->M_users->create_object($edit->Id, $groupid, $groupname, $username,  $password, $edit->IOn, $edit->IBy, null , null);
        $oldmodel   = $this->M_users->create_object($edit->Id, $edit->M_Groupuser_Id, null, $edit->Username,  $edit->Password, $edit->IOn, $edit->IBy, $edit->UOn , $edit->UBy);
        $modeltabel = $this->M_users->create_object_tabel($edit->Id, $groupid, $username, $password, $edit->IOn, $edit->IBy, null , null);

        $validate   = $this->M_users->validate($model, $oldmodel);
 
        if($validate)
        {
            $this->session->set_flashdata('edit_warning_msg',$validate);
            $data =  $this->paging->set_data_page_edit($model);
            load_view('m_user/edit', $data);   
        }
        else
        {
            $date = date("Y-m-d H:i:s");
            $modeltabel['uon'] = $date;
            $modeltabel['uby'] = $_SESSION['userdata']['Username'];

            $this->M_users->edit_data($modeltabel);
            $successmsg = $this->paging->get_success_message();
            $this->session->set_flashdata('success_msg', $successmsg);
            redirect('muser');
        }
    }

    public function delete($id)
    {
        $form = $this->paging->get_form_name_id();
        if($this->M_groupusers->is_permitted($_SESSION['userdata']['M_Groupuser_Id'],$form['m_user'],'Delete'))
        {
            $delete = $this->M_users->delete_data($id);
            if(isset($delete)){
                $deletemsg = $this->helpers->get_query_error_message($delete['code']);
                $this->session->set_flashdata('warning_msg', $deletemsg);
            } else {
                $deletemsg = $this->paging->get_delete_message();
                $this->session->set_flashdata('delete_msg', $deletemsg);
            }
            redirect('muser');
        }
        else
        {   
            $this->load->view('forbidden/forbidden');
        }   
    }

    public function setting(){
        $enums['languageenums'] =  $this->G_languages->get_list();
        $enums['colorenums'] =  $this->G_colors->get_list();
        $data = $this->paging->set_data_page_add(null, $enums);
        load_view('m_user/settings',$data);
    }

    public function activate($id)
    {
        $form = $this->paging->get_form_name_id();
        if($this->M_groupusers->is_permitted($_SESSION['userdata']['M_Groupuser_Id'],$form['m_user'],'Write'))
        {
            $muser = $this->M_users->get($id);
            if($muser){
                $muser->IsActive = $muser->IsActive ? 0 : 1;
                $muser->save();
            }
            redirect('muser');
        }
        else
        {   
            $this->load->view('forbidden/forbidden');
        }   
    }

    public function changePassword(){
        $model = array(
            'oldpassword' => "",
            'newpassword' => "",
            'confirmpassword' => ""
        );
        $data['model'] = $model;
        load_view('m_user/changePassword', $data);    
    }

    public function saveNewPassword(){
        
        $oldpassword = $this->input->post('oldpassword');
        $newpassword = $this->input->post('newpassword');
        $confirmpassword = $this->input->post('confirmpassword');
        $model = array(
            'oldpassword' => $oldpassword,
            'newpassword' => $newpassword,
            'confirmpassword' =>  $confirmpassword
        );
        
        
        $validate = $this->M_users->validate_changepassword($_SESSION['userdata']['Username'], $oldpassword, $newpassword, $confirmpassword);
        if($validate){
            $this->session->set_flashdata('warning_msg',$validate);
            $data =  $this->paging->set_data_page_add($model);
            load_view('m_user/changePassword', $data);    
        }
        else{
            $this->M_users->saveNewPassword($_SESSION['userdata']['Username'], $oldpassword, $newpassword);
            $successmsg = $this->paging->get_success_message();
            $this->session->set_flashdata('success_msg', $successmsg);
            redirect('changePassword');
        }
    }

    public function savesetting(){
        $language = $this->input->post('languageid');
        $radiocolor = $this->input->post('radiocolor');
        $rowperpage = $this->input->post('rowperpage');
        //$usersetting = $this->M_users->create_usersetting_object($_SESSION['usersettings']['Id'], $_SESSION['userdata']['id'],$language, explode("~",$radiocolor)[1],  $rowperpage);
        $usersetting = $this->M_usersettings->get($_SESSION['usersettings']['Id']);
        $usersetting->G_Language_Id = $language;
        $usersetting->G_Color_Id = explode("~",$radiocolor)[1];
        $usersetting->RowPerpage = $rowperpage;
        $usersetting->save();

        $languages = $this->G_languages->get($language);
        $colors = $this->G_colors->get(explode("~",$radiocolor)[1]);
        replaceSession('usersettings', get_object_vars($usersetting));
        replaceSession('languages', get_object_vars($languages));
        replaceSession('colors', get_object_vars($colors));
        redirect('settings');
    }
    
}