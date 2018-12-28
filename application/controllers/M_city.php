<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_city extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('M_cities','M_provinces','M_groupusers')); 
        $this->paging->is_session_set();
    }

    public function index()
    {
        $form = $this->paging->get_form_name_id();
        if($this->M_groupusers->is_permitted($_SESSION['userdata']['M_Groupuser_Id'],$form['m_city'],'Read'))
        {
            $params = array(
                'order' => array('Created' => 'ASC')
            );

            $datapages = $this->M_cities->get_list(null, null, $params);
            $data['model'] = $datapages;
            load_view('m_city/index', $data);
        }
        else
        {   
            $this->load->view('forbidden/forbidden');
        }
    }
    
    function add()
    {
        $form = $this->paging->get_form_name_id();
        if($this->M_groupusers->is_permitted($_SESSION['userdata']['M_Groupuser_Id'],$form['m_city'],'Write'))
        {
            $model = $this->M_cities->new_object(); 
            $modal_province = $this->M_provinces->get_list();
            $data_modal = array(
                'modal_province' => $modal_province
            );
            $data =  $this->paging->set_data_page_add($model,null, $data_modal);
            load_view('m_city/add', $data);  
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
        $provinceid = $this->input->post('provinceid');
        $description = $this->input->post('description');
        
        $model = $this->M_cities->new_object();
        $model->Name = $name;
        $model->M_Province_Id = $provinceid;
        $model->Description = $description;
        $model->CreatedBy = $_SESSION['userdata']['Username'];

        $validate = $this->M_cities->validate($model);
 
        if($validate)
        {
            $this->session->set_flashdata('add_warning_msg',$validate);
            $modal_province = $this->M_provinces->get_list();
            $data_modal = array(
                'modal_province' => $modal_province
            );
            $data =  $this->paging->set_data_page_add($model, null, $data_modal);
            load_view('m_city/add', $data);   
        }
        else{
    
            $model->save();
            $successmsg = $this->paging->get_success_message();
            $this->session->set_flashdata('success_msg', $successmsg);
            redirect('mcity/add');
        }
    }

    public function edit($id)
    {
        $form = $this->paging->get_form_name_id();
        if($this->M_groupusers->is_permitted($_SESSION['userdata']['M_Groupuser_Id'],$form['m_city'],'Write'))
        {
            $model = $this->M_cities->get($id);
            $modal_province = $this->M_provinces->get_list();
            $data_modal = array(
                'modal_province' => $modal_province
            );
            $data =  $this->paging->set_data_page_edit($model, null, $data_modal);
            load_view('m_city/edit', $data);  
        }
        else
        {
            $this->load->view('forbidden/forbidden');
        } 
    }

    public function editsave()
    {
        
        $id = $this->input->post('idcity');
        $name = $this->input->post('named');
        $provinceid = $this->input->post('provinceid');
        $description = $this->input->post('description');

        $model = $this->M_cities->get($id);
        $oldmodel = clone $model;
        //print_r($oldmodel);
        
        $model->Name = $name;
        $model->M_Province_Id = $provinceid;
        $model->Description = $description;
        $model->ModifiedBy = $_SESSION['userdata']['Username'];
        


        $validate = $this->M_cities->validate($model, $oldmodel);
        if($validate)
        {
            $this->session->set_flashdata('edit_warning_msg',$validate);

            $modal_province = $this->M_provinces->get_list();
            $data_modal = array(
                'modal_province' => $modal_province
            );
            $data =  $this->paging->set_data_page_edit($model, null, $data_modal);
            load_view('m_city/edit', $data);   
        }
        else
        {
            $model->save();
            $successmsg = $this->paging->get_success_message();
            $this->session->set_flashdata('success_msg', $successmsg);
            redirect('mcity');
        }
    }

    public function delete(){
        $id = $this->input->post("id");
        $form = $this->paging->get_form_name_id();
        if($this->M_groupusers->is_permitted($_SESSION['userdata']['M_Groupuser_Id'],$form['m_city'],'Delete'))
        {   
            $deleteData = $this->M_cities->get($id);
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
    
}