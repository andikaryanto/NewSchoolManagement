<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_groupuser extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //$this->load->database('naturedisaster', TRUE);
        $this->load->model(array('M_groupusers','M_accessroles')); 
        $this->load->library(array('paging', 'session','helpers'));
        $this->load->helper('form');
        $this->paging->is_session_set();
    }

    public function index()
    {
        $form = $this->paging->get_form_name_id();
        if($this->M_groupusers->is_permitted($_SESSION['userdata']['M_Groupuser_Id'],$form['m_groupuser'],'Read'))
        {
            $params = array(
                'order' => array('Created' => 'ASC')
            );
            $datapages = $this->M_groupusers->get_list(null, null, $params);
            $data['model'] = $datapages;
            load_view('m_groupuser/index', $data);
        }
        else
        {   
            $this->load->view('forbidden/forbidden');
        }
    }
    
    public function add()
    {
        $form = $this->paging->get_form_name_id();
        if($this->M_groupusers->is_permitted($_SESSION['userdata']['M_Groupuser_Id'],$form['m_groupuser'],'Write'))
        {
            $model = $this->M_groupusers->new_object();
            $data =  $this->paging->set_data_page_add($model);
            load_view('m_groupuser/add', $data);  
        }
        else
        {
            $this->load->view('forbidden/forbidden');
        }
    }

    public function addsave()
    {
        //$date = new DateTime();
        $warning = array();
        $err_exist = false;
        $name = $this->input->post('named');
        $description = $this->input->post('description');
        
        $model = $this->M_groupusers->new_object();
        $model->GroupName = $name;
        $model->Description = $description;
        $model->CreatedBy = $_SESSION['userdata']['Username'];

        $validate = $this->M_groupusers->validate($model);
 
        if($validate)
        {
            $this->session->set_flashdata('add_warning_msg',$validate);
            $data =  $this->paging->set_data_page_add($model);
            load_view('m_groupuser/add', $data);   
        }
        else{
    
            $model->save();
            $successmsg = $this->paging->get_success_message();
            $this->session->set_flashdata('success_msg', $successmsg);
            redirect('mgroupuser/add');
        }
    }

    public function edit($id)
    {
        $form = $this->paging->get_form_name_id();
        if($this->M_groupusers->is_permitted($_SESSION['userdata']['M_Groupuser_Id'],$form['m_groupuser'],'Write'))
        {
            $model = $this->M_groupusers->get($id);
            $data =  $this->paging->set_data_page_edit($model);
            load_view('m_groupuser/edit', $data);  
        }
        else
        {
            $this->load->view('forbidden/forbidden');
        } 
    }

    public function editsave()
    {
        
        $id = $this->input->post('idgroupuser');
        $name = $this->input->post('named');
        $description = $this->input->post('description');

        $model = $this->M_groupusers->get($id);
        $oldmodel = clone $model;
        echo json_encode($oldmodel);
        $model->GroupName = $name;
        $model->Description = $description;
        $model->ModifiedBy = $_SESSION['userdata']['Username'];
        //echo json_encode($model);

        $validate = $this->M_groupusers->validate($model, $oldmodel);
        if($validate)
        {
            $this->session->set_flashdata('edit_warning_msg',$validate);
            $data =  $this->paging->set_data_page_edit($model);
            load_view('m_groupuser/edit', $data);   
        }
        else
        {
            $model->save();
            $successmsg = $this->paging->get_success_message();
            $this->session->set_flashdata('success_msg', $successmsg);
            redirect('mgroupuser');
        }
    }

    public function editrole($groupid)
    {
        $form = $this->paging->get_form_name_id();
        if($this->M_groupusers->is_permitted($_SESSION['userdata']['M_Groupuser_Id'],$form['m_groupuser'],'Write'))
        {
            $modelheader = $this->M_groupusers->get($groupid);
            $modeldetail = $modelheader->View_m_accessrole();

            $data =  $this->paging->set_data_page_index($modeldetail, null, null, null, $modelheader);
            
            load_view('m_groupuser/roles', $data); 
        }
        else
        {
            $this->load->view('forbidden/forbidden');
        } 
    }

    public function saverole()
    {
        $formid = $this->input->post("formid");
        $groupid = $this->input->post("groupid");
        $read = $this->input->post("read");
        $write = $this->input->post("write");
        $delete = $this->input->post("delete");
        $print = $this->input->post("print");

        $params = array(
            'where' => array(
                'M_Form_Id' => $formid,
                'M_Groupuser_Id' => $groupid
            )
        );

        $roles = $this->M_accessroles->get(null, null, $params);
        if($roles){
            $update_roles = $this->M_accessroles->get($roles->Id);
            $update_roles->Read = $read;
            $update_roles->Write = $write;
            $update_roles->Delete = $delete;
            $update_roles->Print = $print;
            $update_roles->save();
            echo json_encode($update_roles);
        } else {
            $new_roles = $this->M_accessroles->new_object();
            $new_roles->M_Form_Id = $formid;
            $new_roles->M_Groupuser_Id = $groupid;
            $new_roles->Read = $read;
            $new_roles->Write = $write;
            $new_roles->Delete = $delete;
            $new_roles->Print = $print;
            $new_roles->save();
            echo json_encode($new_roles);
        }
    }

    public function delete(){
        $id = $this->input->post("id");
        $form = $this->paging->get_form_name_id();
        if($this->M_groupusers->is_permitted($_SESSION['userdata']['M_Groupuser_Id'],$form['m_groupuser'],'Delete'))
        {   
            $deleteData = $this->M_groupusers->get($id);
            $delete = $deleteData->delete();
            if(isset($delete)){
                $deletemsg = $this->helpers->get_query_error_message($delete['code']);
                //$this->session->set_flashdata('warning_msg', $deletemsg);
                echo json_encode(delete_status($deletemsg, FALSE));
            } else {
                $deletemsg = $this->paging->get_delete_message();
                //$this->session->set_flashdata('delete_msg', $deletemsg);
                echo json_encode(delete_status($deletemsg));
            }
        } else {
            echo json_encode(delete_status(FALSE, TRUE));
        }
    }

    public function deletes($id)
    {
        $form = $this->paging->get_form_name_id();
        if($this->M_groupusers->is_permitted($_SESSION['userdata']['M_Groupuser_Id'],$form['m_groupuser'],'Delete'))
        {
            $deleteData = $this->M_groupusers->get($id);
            $delete = $deleteData->delete();
            if(isset($delete)){
                $deletemsg = $this->helpers->get_query_error_message($delete['code']);
                $this->session->set_flashdata('warning_msg', $deletemsg);
            } else {
                $deletemsg = $this->paging->get_delete_message();
                $this->session->set_flashdata('delete_msg', $deletemsg);
            }
            redirect('mgroupuser');
        }
        else
        {   
            $this->load->view('forbidden/forbidden');
        }   
    }
    
}