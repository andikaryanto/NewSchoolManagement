<?php

class Migration_create_g_languages20181219070746 extends CI_Migration {

    public function up() {
        $this->load->helper('db_helper');
        if (!$this->db->table_exists('g_languages')){
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
            $this->dbforge->create_table('g_languages');
            
            $data = array('data' =>
                array(
                    'Name' => 'indonesia'
                ),
                array(
                    'Name' => 'english'
                ),
            );
            
            foreach ($data as $value){
                $this->db->insert('g_languages', $value);
            }
        }

        if (!$this->db->table_exists('g_colors')){
            $this->dbforge->add_field(array(
                'Id' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'auto_increment' => TRUE
                ),
                'Name' => array(
                    'type' => 'Varchar',
                    'constraint' => 300,
                ),
                'Value' => array(
                    'type' => 'Varchar',
                    'constraint' => 300,
                ),
                'CssClass' => array(
                    'type' => 'Varchar',
                    'constraint' => 300,
                ),
                'CssPath' => array(
                    'type' => 'Varchar',
                    'constraint' => 300,
                ),
                'CssCustomPath' => array(
                    'type' => 'Varchar',
                    'constraint' => 300,
                )
            ));

            $this->dbforge->add_key('Id', TRUE);
            $this->dbforge->create_table('g_colors');
            
            $data = array('data' =>
                array(
                    'Name' => 'primary',
                    'Value' => '#9c27b0',
                    'CssClass' => 'text-primary',
                    'CssPath' => 'assets/material-dashboard/assets/css/material-dashboard.min.css',
                    'CssCustomPath' => 'assets/material-dashboard/assets/css/custom.css',

                ),
                array(
                    'Name' => 'green',
                    'Value' => '#4caf50',
                    'CssClass' => 'text-success',
                    'CssPath' => 'assets/material-dashboard/assets/css/material-dashboard.greeen.min.css',
                    'CssCustomPath' => 'assets/material-dashboard/assets/css/custom.green.css'
                ),
            );
            
            foreach ($data as $value){
                $this->db->insert('g_colors', $value);
            }
        }
    }

    public function down() {
    }

}