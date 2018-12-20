<?php
class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //$this->load->database('naturedisaster', TRUE);
        //$this->load->model('Login_model');
        //$this->lang->load('form_ui', $_SESSION['language']['language']);
        
        //$this->paging->is_session_set();

    }

    public function index()
    {
        //echo json_encode($this->session->userdata('language'));
        //echo json_encode($this->session->userdata('userdata'));
        if(!isset($_SESSION['userdata'])){
            redirect('login');
        }
        else{
            $this->loadview('home/home');
        }
    }

    private function loadview($viewName)
	{
		$this->paging->load_header();
		$this->load->view($viewName);
		$this->paging->load_footer();
    }
}