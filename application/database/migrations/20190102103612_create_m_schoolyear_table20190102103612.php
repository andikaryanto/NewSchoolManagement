<?php

class Migration_create_m_schoolyear_table20190102103612 extends CI_Migration {

    public function up() {
        $this->load->helper('db_helper');
        $this->dbforge->add_field(array(
            'Id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ),
            'Name' => array(
                'type' => 'VARCHAR',
                'constraint' => 100
            ),
            'DateStart' => array(
                'type' => 'DATETIME'
            ),
            'IsActive' => array(
                'type' => 'SMALLINT',
                'constraint' => 11
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
        $this->dbforge->create_table('m_schoolyears');

        $data = array('data' =>
                array(
                    'FormName' => 'm_schoolyears',
                    'AliasName' => 'master school year',
                    'LocalName' => 'master tahun ajaran',
                    'ClassName' => 'Master',
                    'Resource' => 'ui_schoolyear',
                    'IndexRoute' => 'mschoolyear'
                )
            );
        foreach ($data as $value){
            $this->db->insert("m_forms", $value);
        }
    }

    public function down() {
        //$this->dbforge->drop_table('create_m_schoolyear_table20190102103612');
    }

}