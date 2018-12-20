<?php

class Migration_insert_m_form extends CI_Migration {

    private $table = 'm_forms';
    public function up() {
        $this->load->helper('db_helper');
        //$data = array();
        $data = array('data' =>
            array(
                'FormName' => 'm_groupusers',
                'AliasName' => 'master group user',
                'LocalName' => 'master grup pengguna',
                'ClassName' => 'Master',
                'Resource' => 'ui_groupuser',
                'IndexRoute' => 'mgroupuser'
            ),
            array(
                'FormName' => 'm_users',
                'AliasName' => 'master user',
                'LocalName' => 'master pengguna',
                'ClassName' => 'Master',
                'Resource' => 'ui_user',
                'IndexRoute' => 'muser'
            ),
            array(
                'FormName' => 'm_schools',
                'AliasName' => 'master school',
                'LocalName' => 'master sekolah',
                'ClassName' => 'Master',
                'Resource' => 'ui_school',
                'IndexRoute' => 'mschool'
            ),
            array(
                'FormName' => 'm_clases',
                'AliasName' => 'master class',
                'LocalName' => 'master kelas',
                'ClassName' => 'Master',
                'Resource' => 'ui_class',
                'IndexRoute' => 'mclass'
            ),
            array(
                'FormName' => 'm_schoolyears',
                'AliasName' => 'master school year',
                'LocalName' => 'master tahun ajaran',
                'ClassName' => 'Master',
                'Resource' => 'ui_schoolyear',
                'IndexRoute' => 'mschoolyear'
            ),
            array(
                'FormName' => 'm_workers',
                'AliasName' => 'master worker',
                'LocalName' => 'master pekerja',
                'ClassName' => 'Master',
                'Resource' => 'ui_worker',
                'IndexRoute' => 'mworker'
            ),
            array(
                'FormName' => 'm_subjects',
                'AliasName' => 'master subject',
                'LocalName' => 'master mata pelajaran',
                'ClassName' => 'Master',
                'Resource' => 'ui_subject',
                'IndexRoute' => 'msubject'
            )
        );
        foreach ($data as $value){
            $this->db->insert($this->table, $value);
        }
    }

    public function down() {
        //$this->dbforge->drop_table('insert_m_form');
    }

}