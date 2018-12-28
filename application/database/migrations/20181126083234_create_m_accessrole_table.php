<?php

class Migration_create_m_accessrole_table extends CI_Migration {

    public function up() {
        $this->load->helper('db_helper');
        
        if (!$this->db->table_exists('m_accessroles')){
            $this->dbforge->add_field(array(
                'Id' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'auto_increment' => TRUE
                ),
                'M_Form_Id' => array(
                    'type' => 'INT',
                    'constraint' => 11
                ),
                'M_Groupuser_Id' => array(
                    'type' => 'INT',
                    'constraint' => 11
                ),
                'Read' => array(
                    'type' => 'TINYINT',
                    'constraint' => 1
                ),
                'Write' => array(
                    'type' => 'TINYINT',
                    'constraint' => 1
                ),
                'Delete' => array(
                    'type' => 'TINYINT',
                    'constraint' => 1
                ),
                'Print' => array(
                    'type' => 'TINYINT',
                    'constraint' => 1
                ),
            ));
            $this->dbforge->add_key('Id', TRUE);
            $this->dbforge->create_table('m_accessroles');
            $this->db->query(add_foreign_key('m_accessroles', 'M_Groupuser_Id', 'm_groupusers(Id)', 'CASCADE', 'CASCADE'));
            $this->db->query(add_foreign_key('m_accessroles', 'M_Form_Id', 'm_forms(Id)', 'RESTRICT', 'CASCADE'));
        }   
    }

    public function down() {
        // $this->dbforge->drop_table('m_accessrole');
    }

}