<?php

class Migration_create_m_province20181223055507 extends CI_Migration {

    public function up() {
        $this->load->helper('db_helper');
        if (!$this->db->table_exists('m_provinces')){
            $this->dbforge->add_field(array(
                'Id' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'auto_increment' => TRUE
                ),
                'Name' => array(
                    'type' => 'varchar',
                    'constraint' => 100
                ),
                'Description' => array(
                    'type' => 'varchar',
                    'constraint' => 300,
                    'null' => true
                ),
                'CreatedBy' => array(
                    'type' => 'varchar',
                    'constraint' => 50,
                    'null' => true
                ),
                'ModifiedBy' => array(
                    'type' => 'varchar',
                    'constraint' => 50,
                    'null' => true
                ),
                'Created' => array(
                    'type' => 'datetime',
                    'null' => true
                ),
                'Modified' => array(
                    'type' => 'datetime',
                    'null' => true
                )

            ));
            $this->dbforge->add_key('Id', TRUE);
            $this->dbforge->create_table('m_provinces');
        }
    }

    public function down() {
    }

}