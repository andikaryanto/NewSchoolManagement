<?php

class Migration_insert_m_form20181223061200 extends CI_Migration {

    public function up() {
        $this->load->helper('db_helper');
        $data = array('data' =>
            array(
                'FormName' => 'm_provinces',
                'AliasName' => 'master province',
                'LocalName' => 'master provinsi',
                'ClassName' => 'Master',
                'Resource' => 'ui_province',
                'IndexRoute' => 'mprovince'
            )
        );
        foreach ($data as $value){
            $this->db->insert("m_forms", $value);
        }
    }

    public function down() {
        
    }

}