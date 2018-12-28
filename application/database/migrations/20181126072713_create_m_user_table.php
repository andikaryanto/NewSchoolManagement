<?php

class Migration_create_m_user_table extends CI_Migration {

    public function up() {
        $this->load->helper('db_helper');
        
        if (!$this->db->table_exists('m_users')){
            $this->dbforge->add_field(array(
                'Id' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'auto_increment' => TRUE
                ),
                'M_Groupuser_Id' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'null' => true
                ),
                'Username' => array(
                    'type' => 'varchar',
                    'constraint' => 100
                ),
                'Password' => array(
                    'type' => 'varchar',
                    'constraint' => 50
                ),
                'IsLoggedIn' => array(
                    'type' => 'smallint',
                    'constraint' => 11,
                    'default' => 0
                ),
                'IsActive' => array(
                    'type' => 'smallint',
                    'constraint' => 11,
                    'default' => 1
                ),
                'Language' => array(
                    'type' => 'varchar',
                    'constraint' => 50,
                    'default' => 'indonesia'
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
            $this->dbforge->create_table('m_users');
            $this->db->query(add_foreign_key('m_users', 'M_Groupuser_Id', 'm_groupusers(Id)', 'RESTRICT', 'CASCADE'));
        }
    }

    public function down() {
        // $this->dbforge->drop_table('m_user');
    }

}