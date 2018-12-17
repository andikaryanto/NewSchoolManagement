<?php

class Migration_create_m_usersetting_table20181217062632 extends CI_Migration {

    public function up() {
        $this->load->helper('db_helper');
        if (!$this->db->table_exists('m_usersetting')){
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
                'Language' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 100,
                    'default' => 'indonesia'
                ),
                'Color' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 1000,
                    'default' => 'assets/material-dashboard/assets/css/material-dashboard.min.css'
                ),
                'ColorValue' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 100,
                    'default' => '#9c27b0'
                ),
                'BackGround' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 1000,
                    'default' => 'assets/material-dashboard//assets/img/sidebar-1.jpg'
                ),
                'CustomColor' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 1000,
                    'default' => 'assets/material-dashboard/assets/css/Custom.css'
                ),
                'CustomColorValue' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 1000,
                    'default' => '#9c27b0'
                )
            ));
            $this->dbforge->add_key('Id', TRUE);
            $this->dbforge->create_table('m_usersetting');
            $this->db->query(add_foreign_key('m_usersetting', 'UserId', 'm_user(Id)', 'CASCADE', 'CASCADE'));
        }
    }

    public function down() {
        //$this->dbforge->drop_table('create_m_usersetting_table20181217062632');
    }

}