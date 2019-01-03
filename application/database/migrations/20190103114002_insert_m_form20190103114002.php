<?php

class Migration_insert_m_form20190103114002 extends CI_Migration {

    public function up() {
        $this->load->helper('db_helper');
        $data = array('data' =>
            array(
                'FormName' => 'm_people',
                'AliasName' => 'master people',
                'LocalName' => 'master orang',
                'ClassName' => 'Master',
                'Resource' => 'ui_people',
                'IndexRoute' => 'mpeople'
            )
        );
        foreach ($data as $value){
            $this->db->insert("m_forms", $value);
        }
    }

    public function down() {
        //$this->dbforge->drop_table('insert_m_form20190103114002');
    }

}