<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_enums_model extends MY_Model {

    public function get_data_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('m_enumdetails', $id);
        $this->db->where('M_Enum_Id', $id);
        $this->db->order_by('Ordering');
        $query = $this->db->get();
        return $query->result();
    }
}

class M_enum_object extends Model_object {
	
	
}