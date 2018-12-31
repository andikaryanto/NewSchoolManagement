<?php

class Migration_create_m_city_table20181224081245 extends CI_Migration {

    public function up() {
        $this->load->helper('db_helper');
        if (!$this->db->table_exists('m_cities')){
            $this->dbforge->add_field(array(
                'Id' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'auto_increment' => TRUE
                ),
                'M_Province_Id' => array(
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
            $this->dbforge->create_table('m_cities');
            $this->db->query(add_foreign_key('m_cities', 'M_Province_Id', 'm_provinces(Id)', 'RESTRICT', 'CASCADE'));
        
            $data = array('data' =>
                array(
                    'FormName' => 'm_cities',
                    'AliasName' => 'master city',
                    'LocalName' => 'master kota',
                    'ClassName' => 'Master',
                    'Resource' => 'ui_city',
                    'IndexRoute' => 'mcity'
                )
            );
            foreach ($data as $value){
                $this->db->insert("m_forms", $value);
            }
        }
    }

    public function down() {
        
    }

}