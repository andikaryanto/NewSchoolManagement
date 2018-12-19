<?php

class Migration_create_m_usersetting_table20181217062632 extends CI_Migration {

    public function up() {
        $this->load->helper('db_helper');
        if (!$this->db->table_exists('m_usersettings')){
            $this->dbforge->add_field(array(
                'Id' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'auto_increment' => TRUE
                ),
                'UserId' => array(
                    'type' => 'INT',
                    'constraint' => 11
                ),
                'LanguageId' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'default' => 1
                ),
                'ColorId' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'default' => 1
                ),
                'RowPerpage' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'default' => 5
                )
            ));
            $this->dbforge->add_key('Id', TRUE);
            $this->dbforge->create_table('m_usersettings');
            $this->db->query(add_foreign_key('m_usersettings', 'UserId', 'm_users(Id)', 'CASCADE', 'CASCADE'));
        
            
            $dataSetting = [
                'UserId' => '1'
            ];
            
            $this->db->insert('m_usersettings', $dataSetting);
        }
    }

    public function down() {
        //$this->dbforge->drop_table('create_m_usersetting_table20181217062632');
    }

}