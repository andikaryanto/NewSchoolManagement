<?php

class Migration_create_m_villages_table20181231042405 extends CI_Migration {

    public function up() {
        $this->load->helper('db_helper');
        $this->dbforge->add_field(array(
            'Id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ),
            'M_Subcity_Id' => array(
                'type' => 'INT',
                'constraint' => 11
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
        $this->dbforge->create_table('m_villages', TRUE);
        $this->db->query(add_foreign_key('m_villages', 'M_Subcity_Id', 'm_subcities(Id)', 'RESTRICT', 'CASCADE'));
    
        $data = array('data' =>
            array(
                'FormName' => 'm_villages',
                'AliasName' => 'master village',
                'LocalName' => 'master kelurahan',
                'ClassName' => 'Master',
                'Resource' => 'ui_village',
                'IndexRoute' => 'mvillage'
            )
        );
        foreach ($data as $value){
            $this->db->insert("m_forms", $value);
        }
    }

    public function down() {
        //$this->dbforge->drop_table('create_m_villages_table20181231042405');
    }

}