<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_villages_model extends MY_Model {

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

        if(empty($model->M_Subcity_Id))
            $warning = array_merge($warning, array(0=>'err_msg_city_can_not_null'));
        
        return $warning;
    }

}

class M_village_object extends Model_object {
   
}