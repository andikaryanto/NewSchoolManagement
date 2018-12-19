<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Gsetting_model extends CI_Model {

    public function __construct(){
        parent::__construct();
    }

    public function get_language(){
        $this->db->select('*');
        $this->db->from('g_languages');
        $this->db->order_by('Id');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_color(){
        $this->db->select('*');
        $this->db->from('g_colors');
        $this->db->order_by('Id');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_alldata(){
        // get all data
    }

    public function get_data_by_id($id){  
        // get data by primary key
    }

    public function get_datapages($page, $pagesize, $search = null){  
        // your datapages
    }

    public function save_data($data){  
        // your save data
    }

    public function edit_data($data){  
        // your edit data
    }

    public function delete_data($id){
        // delete data
    }

    public function create_object(){
        // create object goes here
        $data = array(
        );
        return $data;
    }

    public function create_object_tabel(){
        //create object goes here
        $data = array(
        );
        return $data;
    }

    public function validate($model, $oldmodel = null){
        //validate goes here
    }

    public function set_resources(){
        // resource language goes here
    }

}