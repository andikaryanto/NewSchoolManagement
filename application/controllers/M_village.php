<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_village extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('M_villages','M_subcities','M_groupusers')); 
        $this->paging->is_session_set();
    }

    public function index()
    {
        $form = $this->paging->get_form_name_id();
        if($this->M_groupusers->is_permitted($_SESSION['userdata']['M_Groupuser_Id'],$form['m_village'],'Read'))
        {
            $params = array(
                'order' => array('Created' => 'ASC')
            );

            $datapages = $this->M_villages->get_list(null, null, $params);
            $data['model'] = $datapages;
            load_view('m_village/index', $data);
        }
        else
        {   
            $this->load->view('forbidden/forbidden');
        }
    }
    
    function add()
    {
        $form = $this->paging->get_form_name_id();
        if($this->M_groupusers->is_permitted($_SESSION['userdata']['M_Groupuser_Id'],$form['m_village'],'Write'))
        {
            $model = $this->M_villages->new_object(); 
            $modal_subcity = $this->M_subcities->get_list();
            $data_modal = array(
                'modal_subcity' => $modal_subcity
            );
            $data =  $this->paging->set_data_page_add($model,null, $data_modal);
            load_view('m_village/add', $data);  
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
        $subcityid = $this->input->post('subcityid');
        $description = $this->input->post('description');
        
        $model = $this->M_villages->new_object();
        $model->Name = $name;
        $model->M_Subcity_Id = $subcityid;
        $model->Description = $description;
        $model->CreatedBy = $_SESSION['userdata']['Username'];

        $validate = $this->M_villages->validate($model);
 
        if($validate)
        {
            $this->session->set_flashdata('add_warning_msg',$validate);
            $modal_subcity = $this->M_subcities->get_list();
            $data_modal = array(
                'modal_subcity' => $modal_subcity
            );
            $data =  $this->paging->set_data_page_add($model, null, $data_modal);
            load_view('m_village/add', $data);   
        }
        else{
    
            $model->save();
            $successmsg = $this->paging->get_success_message();
            $this->session->set_flashdata('success_msg', $successmsg);
            redirect('mvillage/add');
        }
    }

    public function edit($id)
    {
        $form = $this->paging->get_form_name_id();
        if($this->M_groupusers->is_permitted($_SESSION['userdata']['M_Groupuser_Id'],$form['m_village'],'Write'))
        {
            $model = $this->M_villages->get($id);
            $modal_subcity = $this->M_subcities->get_list();
            $data_modal = array(
                'modal_subcity' => $modal_subcity
            );
            $data =  $this->paging->set_data_page_edit($model, null, $data_modal);
            load_view('m_village/edit', $data);  
        }
        else
        {
            $this->load->view('forbidden/forbidden');
        } 
    }

    public function editsave()
    {
        
        $id = $this->input->post('idvillage');
        $name = $this->input->post('named');
        $subcityid = $this->input->post('subcityid');
        $description = $this->input->post('description');

        $model = $this->M_villages->get($id);
        $oldmodel = clone $model;
        //print_r($oldmodel);
        
        $model->Name = $name;
        $model->M_Subcity_Id = $subcityid;
        $model->Description = $description;
        $model->ModifiedBy = $_SESSION['userdata']['Username'];
        


        $validate = $this->M_villages->validate($model, $oldmodel);
        if($validate)
        {
            $this->session->set_flashdata('edit_warning_msg',$validate);

            $modal_subcity = $this->M_subcities->get_list();
            $data_modal = array(
                'modal_subcity' => $modal_subcity
            );
            $data =  $this->paging->set_data_page_edit($model, null, $data_modal);
            load_view('m_village/edit', $data);   
        }
        else
        {
            $model->save();
            $successmsg = $this->paging->get_success_message();
            $this->session->set_flashdata('success_msg', $successmsg);
            redirect('mvillage');
        }
    }

    public function delete(){
        $id = $this->input->post("id");
        $form = $this->paging->get_form_name_id();
        if($this->M_groupusers->is_permitted($_SESSION['userdata']['M_Groupuser_Id'],$form['m_village'],'Delete'))
        {   
            $deleteData = $this->M_villages->get($id);
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