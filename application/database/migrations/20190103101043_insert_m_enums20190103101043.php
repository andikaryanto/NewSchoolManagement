<?php

class Migration_insert_m_enums20190103101043 extends CI_Migration {

    public function up() {
        $this->load->helper('db_helper');
        //insert data
        $data = array('data' =>
                
            array(
                'Name' => 'Worker'
            ),
            array(
                'Name' => 'BloodType'
            )
        );

        foreach ($data as $value){
            $this->db->insert('m_enums', $value);
        }

        $datadetail = array('data' =>
                
            array(
                'M_Enum_Id' => 4,
                'Value' => 1,
                'EnumName' => 'Teacher',
                'Ordering' => 1,
                'Resource' => 'ui_teacher'
            ),
            array(
                'M_Enum_Id' => 4,
                'Value' => 2,
                'EnumName' => 'Others',
                'Ordering' => 2,
                'Resource' => 'ui_others'
            ),
            array(
                'M_Enum_Id' => 5,
                'Value' => 1,
                'EnumName' => 'A',
                'Ordering' => 1
            ),
            array(
                'M_Enum_Id' => 5,
                'Value' => 2,
                'EnumName' => 'B',
                'Ordering' => 2
            ),
            array(
                'M_Enum_Id' => 5,
                'Value' => 3,
                'EnumName' => 'AB',
                'Ordering' => 3
            ),
            array(
                'M_Enum_Id' => 5,
                'Value' => 4,
                'EnumName' => 'O',
                'Ordering' => 4
            )
        );

        foreach ($datadetail as $value){
            $this->db->insert('m_enumdetails', $value);
        }
    }

    public function down() {
        //$this->dbforge->drop_table('insert_m_enums20190103101043');
    }

}