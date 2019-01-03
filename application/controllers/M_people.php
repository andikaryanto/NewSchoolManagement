<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_people extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('M_peoples','M_villages','M_enums', 'M_groupusers')); 
        $this->paging->is_session_set();
    }

    public function index()
    {
        $form = $this->paging->get_form_name_id();
        if($this->M_groupusers->is_permitted($_SESSION['userdata']['M_Groupuser_Id'],$form['m_people'],'Read'))
        {
            $params = array(
                'order' => array('Created' => 'ASC')
            );

            $datapages = $this->M_peoples->get_list(null, null, $params);
            $data['model'] = $datapages;
            load_view('m_people/index', $data);
        }
        else
        {   
            $this->load->view('forbidden/forbidden');
        }
    }
    
    function add()
    {
        $form = $this->paging->get_form_name_id();
        if($this->M_groupusers->is_permitted($_SESSION['userdata']['M_Groupuser_Id'],$form['m_people'],'Write'))
        {
            $model = $this->M_peoples->new_object(); 
            $modal_village = $this->M_villages->get_list();
            $data_modal = array(
                'modal_village' => $modal_village
            );
            $enums['bloodtypeenums'] =  $this->M_enums->get_data_by_id(5);
            $data =  $this->paging->set_data_page_add($model,$enums, $data_modal);
            load_view('m_people/add', $data);  
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
        $villageid = $this->input->post('villageid');
        $address = $this->input->post('address');
        $postcode = $this->input->post('postcode');
        $blood = $this->input->post('bloodtype');
        
        $model = $this->M_peoples->new_object();
        $model->Name = $name;
        $model->M_Village_Id = $villageid;
        $model->Address = $address;
        $model->PostCode = $postcode;
        $model->BloodType = $blood;
        $model->CreatedBy = $_SESSION['userdata']['Username'];

        print_r($model);
        $validate = $this->M_peoples->validate($model);
 
        if($validate)
        {
            $this->session->set_flashdata('add_warning_msg',$validate);
            $modal_village = $this->M_villages->get_list();
            $data_modal = array(
                'modal_village' => $modal_village
            );
            $enums['bloodtypeenums'] =  $this->M_enums->get_data_by_id(5);
            $data =  $this->paging->set_data_page_add($model, $enums, $data_modal);
            load_view('m_people/add', $data);   
        }
        else{
    
            $model->save();
            $successmsg = $this->paging->get_success_message();
            $this->session->set_flashdata('success_msg', $successmsg);
            redirect('mpeople/add');
        }
    }

    public function edit($id)
    {
        $form = $this->paging->get_form_name_id();
        if($this->M_groupusers->is_permitted($_SESSION['userdata']['M_Groupuser_Id'],$form['m_people'],'Write'))
        {
            $model = $this->M_peoples->get($id);
            $modal_village = $this->M_villages->get_list();
            $data_modal = array(
                'modal_village' => $modal_village
            );
            $enums['bloodtypeenums'] =  $this->M_enums->get_data_by_id(5);
            $data =  $this->paging->set_data_page_edit($model, $enums, $data_modal);
            load_view('m_people/edit', $data);  
        }
        else
        {
            $this->load->view('forbidden/forbidden');
        } 
    }

    public function editsave()
    {
        
        $id = $this->input->post('idpeople');
        $name = $this->input->post('named');
        $villageid = $this->input->post('villageid');
        $address = $this->input->post('address');
        $postcode = $this->input->post('postcode');
        $blood = $this->input->post('bloodtype');

        $model = $this->M_peoples->get($id);
        $oldmodel = clone $model;
        
        $model->Name = $name;
        $model->M_Village_Id = $villageid;
        $model->Address = $address;
        $model->PostCode = $postcode;
        $model->BloodType = $blood;
        $model->ModifiedBy = $_SESSION['userdata']['Username'];
        print_r($model);

        $validate = $this->M_peoples->validate($model, $oldmodel);
        if($validate)
        {
            $this->session->set_flashdata('edit_warning_msg',$validate);

            $modal_village = $this->M_villages->get_list();
            $data_modal = array(
                'modal_village' => $modal_village
            );
            $enums['bloodtypeenums'] =  $this->M_enums->get_data_by_id(5);
            $data =  $this->paging->set_data_page_edit($model, $enums, $data_modal);
            load_view('m_people/edit', $data);   
        }
        else
        {
            $model->save();
            $successmsg = $this->paging->get_success_message();
            $this->session->set_flashdata('success_msg', $successmsg);
            redirect('mpeople');
        }
    }

    public function delete(){
        $id = $this->input->post("id");
        $form = $this->paging->get_form_name_id();
        if($this->M_groupusers->is_permitted($_SESSION['userdata']['M_Groupuser_Id'],$form['m_people'],'Delete'))
        {   
            $deleteData = $this->M_peoples->get($id);
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