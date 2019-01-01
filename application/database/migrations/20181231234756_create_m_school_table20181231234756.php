<?php

class Migration_create_m_school_table20181231234756 extends CI_Migration {

    public function up() {
        $this->load->helper('db_helper');
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
            'Address'  => array(
                'type' => 'varchar',
                'constraint' => 500
            ),
            'PostCode'  => array(
                'type' => 'varchar',
                'constraint' => 10
            ),
            'Telp'  => array(
                'type' => 'varchar',
                'constraint' => 15
            ),
            'Fax'  => array(
                'type' => 'varchar',
                'constraint' => 20,
                'null' => true
            ),
            'Email'  => array(
                'type' => 'varchar',
                'constraint' => 100
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
        $this->dbforge->create_table('m_schools');
    }

    public function down() {
        //$this->dbforge->drop_table('create_m_school_table20181231234756');
    }

}