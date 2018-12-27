<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_cities_model extends MY_Model {

    public function __construct(){
        parent::__construct();
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

        if(empty($model->ProvinceId))
            $warning = array_merge($warning, array(0=>'err_msg_province_can_not_null'));
        
        return $warning;
    }

}

class M_city_object extends Model_object {

    public function M_provinces()
	{
		$CI = get_instance();
		
        $CI->load->model('M_provinces');	// just another CI Power Model objec 
        if(isset($this->ProvinceId)){
            $province = $CI->M_provinces->get($this->GroupId);
            if (isset($province))
                return $province;
        }
		return $CI->M_provinces->new_object();
    }
}