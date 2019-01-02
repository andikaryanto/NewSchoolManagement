<?php

class Migration_create_m_classes_table20190102101653 extends CI_Migration {

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
        $this->dbforge->create_table('m_classes');

        $data = array('data' =>
                array(
                    'FormName' => 'm_classes',
                    'AliasName' => 'master classes',
                    'LocalName' => 'master kelas',
                    'ClassName' => 'Master',
                    'Resource' => 'ui_class',
                    'IndexRoute' => 'mclass'
                )
            );
        foreach ($data as $value){
            $this->db->insert("m_forms", $value);
        }
    }

    public function down() {
        //$this->dbforge->drop_table('create_m_classes_table20190102101653');
    }

}