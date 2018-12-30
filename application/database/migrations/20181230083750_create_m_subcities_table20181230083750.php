<?php

class Migration_create_m_subcities_table20181230083750 extends CI_Migration {

    public function up() {
        $this->load->helper('db_helper');
        $this->dbforge->add_field(array(
            'Id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ),
            'M_City_Id' => array(
                'type' => 'INT',
                'constraint' => 11
            ),
            'Name' => array(
                'type' => 'varchar',
                'constraint' => 100
            ),
            'Description' => array(
                'type' => 'varchar',
                'constraint' => 300
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
        $this->dbforge->create_table('m_subcities', TRUE);
        $this->db->query(add_foreign_key('m_subcities', 'M_City_Id', 'm_cities(Id)', 'RESTRICT', 'CASCADE'));
    
        $data = array('data' =>
            array(
                'FormName' => 'm_subcities',
                'AliasName' => 'master sub city',
                'LocalName' => 'master kecamatan',
                'ClassName' => 'Master',
                'Resource' => 'ui_subcity',
                'IndexRoute' => 'msubcity'
            )
        );
        foreach ($data as $value){
            $this->db->insert("m_forms", $value);
        }
    }

    public function down() {
        //$this->dbforge->drop_table('create_m_subcities_table20181230083750');
    }

}