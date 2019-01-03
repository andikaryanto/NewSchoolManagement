<?php

class Migration_add_m_class20190103111220 extends CI_Migration {

    public function up() {
        $this->load->helper('db_helper');
        $fields = array(
            'M_Worker_Id' => array(
                    'type' => 'INT',
                    'contraint' => '11',
                    'null' => true,
                    'after' => 'Description'
                    )
        );
        $this->dbforge->add_column('m_classes', $fields);
        $this->db->query(add_foreign_key('m_classes', 'M_Worker_Id', 'm_workers(Id)', 'RESTRICT', 'CASCADE'));
    }

    public function down() {
        $this->dbforge->drop_table('add_m_class20190103111220');
    }

}