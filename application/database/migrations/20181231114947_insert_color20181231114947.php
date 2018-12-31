<?php

class Migration_insert_color20181231114947 extends CI_Migration {

    public function up() {
        $this->load->helper('db_helper');
        $data = array('data' =>
                array(
                    'Name' => 'orange',
                    'Value' => '#ff9800',
                    'CssClass' => 'text-warning',
                    'CssPath' => 'assets/material-dashboard/assets/css/material-dashboard.orange.min.css',
                    'CssCustomPath' => 'assets/material-dashboard/assets/css/Custom.orange.css',

                )
            );
            
            foreach ($data as $value){
                $this->db->insert('g_colors', $value);
            }
    }

    public function down() {
        //$this->dbforge->drop_table('insert_color20181231114947');
    }

}