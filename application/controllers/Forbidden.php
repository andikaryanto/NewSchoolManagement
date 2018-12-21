<?php 
class Forbidden extends CI_Controller 
{
 public function __construct() 
 {
    parent::__construct(); 
 } 

 public function index() 
 { 
    $this->load->view('forbidden/forbidden');//loading in custom error view
 } 
} 