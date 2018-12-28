<?php
class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_users');

    }

    public function index()
    {
        if(isset($_SESSION['userdata'])){
            redirect('home');
        }
        else{
            $this->load->view('login/login');
        }
    }
    public function dologin()
    {
        $username = $this->input->post('loginUsername');
        $password = $this->input->post('loginPassword');
        
        $query = $this->M_users->get_sigle_data_user($username, $password);
        if ($query)
        {
            if($query->IsLoggedIn == 0){
                //print_r($query->get_list_M_User()); 
                $this->session->set_userdata('userdata',get_object_vars($query));
                $this->session->set_userdata('usersettings',get_object_vars($query->get_list_M_Usersetting()[0]));
                $this->session->set_userdata('languages',get_object_vars($query->get_list_M_Usersetting()[0]->get_G_Language()));
                $this->session->set_userdata('colors',get_object_vars($query->get_list_M_Usersetting()[0]->get_G_Color()));
                // echo json_encode($this->session->userdata('colors'));
                redirect('home');
            } else {
                $this->index();
            }
        }
        else{
            $this->index();
        }
    }

    public function dologout()
    {
        $username = $_SESSION['userdata']->Username;
        unset(
            $_SESSION['userdata']
        );
        $this->M_users->set_logout($username);
        redirect('login');
    }

    private function loadview($viewName)
	{
		$this->load->view('template/header');
		$this->load->view($viewName);
		$this->load->view('template/footer');
    }
    
}