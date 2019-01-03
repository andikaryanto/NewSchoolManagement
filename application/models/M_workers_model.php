<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_workers_model extends MY_Model {

    public function __construct(){
        parent::__construct();
    }

    public function is_data_exist($nip = null)
    {
        $exist = false;
        if($this->count(array('Nip' => $nip)) > 0){
            $exist = true;
        }
        return $exist;
    }

    public function validate($model, $oldmodel = null){
        $nipexist  = false;
        $warning    = array();

        if(!empty($oldmodel))
        {
            if($model->Nip != $oldmodel->Nip)
            {
                $nipexist = $this->is_data_exist($model->Nip);
            }
        }
        else{
            if(!empty($model->Nip))
            {
                $nipexist = $this->is_data_exist($model->Nip);
            }
        }

        if($nipexist)
            $warning = array_merge($warning, array(0=>'err_msg_nip_exist'));
        
        return $warning;
    }

}

class M_worker_object extends Model_object {
   
}