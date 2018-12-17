<?php

class Migration_create_g_language20181217092435 extends CI_Migration {

    public function up() {
        $this->load->helper('db_helper');
        if (!$this->db->table_exists('g_language')){
            $this->dbforge->add_field(array(
                'Id' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'auto_increment' => TRUE
                ),
                'Name' => array(
                    'type' => 'Varchar',
                    'constraint' => 50,
                )
            ));
            $this->dbforge->add_key('Id', TRUE);
            $this->dbforge->create_table('g_language');
            
            $data = array('data' =>
                array(
                    'Name' => 'indonesia'
                ),
                array(
                    'Name' => 'english'
                ),
            );
            
            foreach ($data as $value){
                $this->db->insert('g_language', $value);
            }
        }

        if (!$this->db->table_exists('g_color')){
            $this->dbforge->add_field(array(
                'Id' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'auto_increment' => TRUE
                ),
                'Name' => array(
                    'type' => 'Varchar',
                    'constraint' => 50,
                ),
                'Value' => array(
                    'type' => 'Varchar',
                    'constraint' => 50,
                )
            ));

            $this->dbforge->add_key('Id', TRUE);
            $this->dbforge->create_table('g_color');
            
            $data = array('data' =>
                array(
                    'Name' => 'primary',
                    'Value' => '#9c27b0'
                ),
                array(
                    'Name' => 'green',
                    'Value' => '#4caf50'
                ),
            );
            
            foreach ($data as $value){
                $this->db->insert('g_color', $value);
            }
        }
    }

    public function down() {
        //$this->dbforge->drop_table('create_g_language20181217092435');
    }

}