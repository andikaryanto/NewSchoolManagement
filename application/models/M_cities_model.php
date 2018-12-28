<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_cities_model extends MY_Model {

    public function __construct(){
        parent::__construct();
    }

    public function is_data_exist($name = null)
    {
        $exist = false;
        if($this->count(array('Name'=> $name)) > 0){
            $exist = true;
        }
        return $exist;
    }

    public function validate($model, $oldmodel = null){
        $nameexist  = false;
        $warning    = array();

        if(!empty($oldmodel))
        {
            if($model->Name != $oldmodel->Name)
            {
                $nameexist = $this->is_data_exist($model->Name);
            }
        }
        else{
            if(!empty($model->Name))
            {
                $nameexist = $this->is_data_exist($model->Name);
            }
            else{
                $warning = array_merge($warning, array(0=>'err_msg_name_can_not_null'));
            }
        }

        if($nameexist)
            $warning = array_merge($warning, array(0=>'err_msg_name_exist'));

        if(empty($model->M_Province_Id))
            $warning = array_merge($warning, array(0=>'err_msg_province_can_not_null'));
        
        return $warning;
    }

}

class M_city_object extends Model_object {

    public function __get($name){
        switch($name) {
            case 'Test': 
              return $this->get_test();
        }
    }

    private function get_test(){
        $Test = $this->Name;
        return $Test;
    }
}