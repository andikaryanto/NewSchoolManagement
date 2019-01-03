<?php

class Migration_create_m_enum_table20181201061354 extends CI_Migration {

    private $tabledetail = 'm_enumdetails';
    public function up() {
        $this->load->helper('db_helper');
        
        if (!$this->db->table_exists('m_enums')){
            $this->dbforge->add_field(array(
                'Id' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'auto_increment' => TRUE
                ),
                'Name' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 100
                )
            ));
            $this->dbforge->add_key('Id', TRUE);
            $this->dbforge->create_table('m_enums');

            //insert data
            $data = array('data' =>
                
                array(
                    'Name' => 'Months'
                ),
                array(
                    'Name' => 'Gender'
                ),
                array(
                    'Name' => 'Religion'
                ));
            foreach ($data as $value){
                $this->db->insert('m_enums', $value);
            }
        }
        
        if (!$this->db->table_exists('m_enumdetails')){
        //table detail
            $this->dbforge->add_field(array(
                'Id' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'auto_increment' => TRUE
                ),
                'M_Enum_Id' => array(
                    'type' => 'INT',
                    'constraint' => 11
                ),
                'Value' => array(
                    'type' => 'INT',
                    'constraint' => 11
                ),
                'EnumName' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 50
                ),
                'Ordering' => array(
                    'type' => 'TINYINT',
                    'constraint' => 11
                ),
                'Resource' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 50,
                    'null' => true
                )
            ));

            $this->dbforge->add_key('Id', TRUE);
            $this->dbforge->create_table('m_enumdetails');
            $this->db->query(add_foreign_key('m_enumdetails', 'M_Enum_Id', 'm_enums(Id)', 'CASCADE', 'CASCADE'));

            //insert data
            $data = array('data' =>
                
                array(
                    'M_Enum_Id' => 1,
                    'Value' => 1,
                    'EnumName' => 'January',
                    'Ordering' => 1,
                    'Resource' => 'ui_january'
                ),
                array(
                    'M_Enum_Id' => 1,
                    'Value' => 2,
                    'EnumName' => 'February',
                    'Ordering' => 2,
                    'Resource' => 'ui_february'
                ),
                array(
                    'M_Enum_Id' => 1,
                    'Value' => 3,
                    'EnumName' => 'March',
                    'Ordering' => 3,
                    'Resource' => 'ui_march'
                ),
                array(
                    'M_Enum_Id' => 1,
                    'Value' => 4,
                    'EnumName' => 'April',
                    'Ordering' => 4,
                    'Resource' => 'ui_april'
                ),
                array(
                    'M_Enum_Id' => 1,
                    'Value' => 5,
                    'EnumName' => 'May',
                    'Ordering' => 5,
                    'Resource' => 'ui_may'
                ),
                array(
                    'M_Enum_Id' => 1,
                    'Value' => 6,
                    'EnumName' => 'June',
                    'Ordering' => 6,
                    'Resource' => 'ui_june'
                ),
                array(
                    'M_Enum_Id' => 1,
                    'Value' => 7,
                    'EnumName' => 'July',
                    'Ordering' => 7,
                    'Resource' => 'ui_july'
                ),
                array(
                    'M_Enum_Id' => 1,
                    'Value' => 8,
                    'EnumName' => 'August',
                    'Ordering' => 8,
                    'Resource' => 'ui_august'
                ),
                array(
                    'M_Enum_Id' => 1,
                    'Value' => 9,
                    'EnumName' => 'September',
                    'Ordering' => 9,
                    'Resource' => 'ui_september'
                ),
                array(
                    'M_Enum_Id' => 1,
                    'Value' => 10,
                    'EnumName' => 'October',
                    'Ordering' => 10,
                    'Resource' => 'ui_october'
                ),
                array(
                    'M_Enum_Id' => 1,
                    'Value' => 11,
                    'EnumName' => 'November',
                    'Ordering' => 11,
                    'Resource' => 'ui_november'
                ),
                array(
                    'M_Enum_Id' => 1,
                    'Value' => 12,
                    'EnumName' => 'December',
                    'Ordering' => 12,
                    'Resource' => 'ui_december'
                ),
                array(
                    'M_Enum_Id' => 2,
                    'Value' => 1,
                    'EnumName' => 'Male',
                    'Ordering' => 1,
                    'Resource' => 'ui_male'
                ),
                array(
                    'M_Enum_Id' => 2,
                    'Value' => 2,
                    'EnumName' => 'Female',
                    'Ordering' => 2,
                    'Resource' => 'ui_female'
                ),
                array(
                    'M_Enum_Id' => 3,
                    'Value' => 1,
                    'EnumName' => 'Islam',
                    'Ordering' => 1
                ),
                array(
                    'M_Enum_Id' => 3,
                    'Value' => 2,
                    'EnumName' => 'Kristen',
                    'Ordering' => 2
                ),
                array(
                    'M_Enum_Id' => 3,
                    'Value' => 2,
                    'EnumName' => 'Katholik',
                    'Ordering' => 3
                ),
                array(
                    'M_Enum_Id' => 3,
                    'Value' => 4,
                    'EnumName' => 'Hindu',
                    'Ordering' => 4
                ),
                array(
                    'M_Enum_Id' => 3,
                    'Value' => 5,
                    'EnumName' => 'Budha',
                    'Ordering' => 5
                ),
                array(
                    'M_Enum_Id' => 3,
                    'Value' => 6,
                    'EnumName' => 'None',
                    'Ordering' => 6
                )
            );
            foreach ($data as $value){
                $this->db->insert('m_enumdetails', $value);
            }
        }
    }

    public function down() {
        // $this->dbforge->drop_table('m_enumdetails');
        // $this->dbforge->drop_table('m_enums');
    }

}