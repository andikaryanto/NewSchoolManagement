<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_schoolyear extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //$this->load->database('naturedisaster', TRUE);
        $this->load->model(array('M_schoolyears','M_groupusers')); 
        $this->paging->is_session_set();
    }

    public function index()
    {
        $form = $this->paging->get_form_name_id();
        if($this->M_groupusers->is_permitted($_SESSION['userdata']['M_Groupuser_Id'],$form['m_schoolyear'],'Read'))
        {

            $params = array(
                'order' => array('Created' => 'ASC')
            );

            $datapages = $this->M_schoolyears->get_list(null, null, $params);
            $data['model'] = $datapages;
            load_view('m_schoolyear/index', $data);
        }
        else
        {   
            $this->load->view('forbidden/forbidden');
        }
    }
    
    function add()
    {
        $form = $this->paging->get_form_name_id();
        if($this->M_groupusers->is_permitted($_SESSION['userdata']['M_Groupuser_Id'],$form['m_schoolyear'],'Write'))
        {
            $model = $this->M_schoolyears->new_object();
            $model->DateStart = get_current_date();
            // print_r($model);
            $data =  $this->paging->set_data_page_add($model);
            load_view('m_schoolyear/add', $data);  
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
        $datestart = $this->input->post('datestart');
        // $isactive = $this->input->post('isactive');
        
        $model = $this->M_schoolyears->new_object();
        $model->Name = $name;
        $model->DateStart = get_formated_date($datestart);
        $model->IsActive = 0;
        $model->CreatedBy = $_SESSION['userdata']['Username'];
        $validate = $this->M_schoolyears->validate($model);
 
        if($validate)
        {
            $this->session->set_flashdata('add_warning_msg',$validate);
            $data =  $this->paging->set_data_page_add($model);
            load_view('m_schoolyear/add', $data);   
        }
        else{
    
            $model->save();
            $successmsg = $this->paging->get_success_message();
            $this->session->set_flashdata('success_msg', $successmsg);
            redirect('mschoolyear');
        }
    }

    public function edit($id)
    {
        $form = $this->paging->get_form_name_id();
        if($this->M_groupusers->is_permitted($_SESSION['userdata']['M_Groupuser_Id'],$form['m_schoolyear'],'Write'))
        {
            $model = $this->M_schoolyears->get($id);
            $model->DateStart = get_formated_date($model->DateStart, 'd/m/Y');
            $data =  $this->paging->set_data_page_edit($model);
            load_view('m_schoolyear/edit', $data);  
        }
        else
        {
            $this->load->view('forbidden/forbidden');
        } 
    }

    public function editsave()
    {
        
        $id = $this->input->post('idschoolyear');
        $name = $this->input->post('named');
        $datestart = $this->input->post('datestart');

        $model = $this->M_schoolyears->get($id);
        $oldmodel = clone $model;
        //print_r($oldmodel);
        
        $model->Name = $name;
        $model->Description = $description;
        $model->ModifiedBy = $_SESSION['userdata']['Username'];
        


        $validate = $this->M_schoolyears->validate($model, $oldmodel);
        if($validate)
        {
            $this->session->set_flashdata('edit_warning_msg',$validate);
            $data =  $this->paging->set_data_page_edit($model);
            load_view('m_schoolyear/edit', $data);   
        }
        else
        {
            $model->save();
            $successmsg = $this->paging->get_success_message();
            $this->session->set_flashdata('success_msg', $successmsg);
            redirect('mschoolyear');
        }
    }

    public function activate($id){
        $form = $this->paging->get_form_name_id();
        if($this->M_groupusers->is_permitted($_SESSION['userdata']['M_Groupuser_Id'],$form['m_schoolyear'],'Write'))
        {
            $muser = $this->M_schoolyears->get($id);
            if($muser){
                $muser->IsActive = $muser->IsActive ? 0 : 1;

                if($muser->IsActive == 1){
                    $params = array(
                        'where' => array(
                            'Id !=' => $id
                        )
                    );
                    $list_user = $this->M_schoolyears->get_list(null, null, $params);
                    if(isset($list_user))
                        foreach($list_user as $user){
                            $user->IsActive = 0;
                            $user->save();
                        }
                } else {
                    $muser->IsActive = 1;
                }
                $muser->save();
            }
            redirect('mschoolyear');
        } else {   
            $this->load->view('forbidden/forbidden');
        }   
    }

    public function delete(){
        $id = $this->input->post("id");
        $form = $this->paging->get_form_name_id();
        if($this->M_groupusers->is_permitted($_SESSION['userdata']['M_Groupuser_Id'],$form['m_schoolyear'],'Delete'))
        {   
            $deleteData = $this->M_schoolyears->get($id);
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