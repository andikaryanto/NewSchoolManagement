<?php

class Migration_insert_m_form extends CI_Migration {

    private $table = 'm_form';
    public function up() {
        $this->load->helper('db_helper');
        //$data = array();
        $data = array('data' =>
            array(
                'FormName' => 'm_groupuser',
                'AliasName' => 'master group user',
                'LocalName' => 'master grup pengguna',
                'ClassName' => 'Master',
                'Resource' => 'res_groupuser',
                'IndexRoute' => 'mgroupuser'
            ),
            array(
                'FormName' => 'm_user',
                'AliasName' => 'master user',
                'LocalName' => 'master pengguna',
                'ClassName' => 'Master',
                'Resource' => 'res_user',
                'IndexRoute' => 'muser'
            ),
            array(
                'FormName' => 'm_school',
                'AliasName' => 'master school',
                'LocalName' => 'master sekolah',
                'ClassName' => 'Master',
                'Resource' => 'res_school',
                'IndexRoute' => 'mschool'
            ),
            array(
                'FormName' => 'm_kelas',
                'AliasName' => 'master class',
                'LocalName' => 'master kelas',
                'ClassName' => 'Master',
                'Resource' => 'res_class',
                'IndexRoute' => 'mclass'
            ),
            array(
                'FormName' => 'm_schoolyear',
                'AliasName' => 'master school year',
                'LocalName' => 'master tahun ajaran',
                'ClassName' => 'Master',
                'Resource' => 'res_schoolyear',
                'IndexRoute' => 'mschoolyear'
            ),
            array(
                'FormName' => 'm_worker',
                'AliasName' => 'master worker',
                'LocalName' => 'master pekerja',
                'ClassName' => 'Master',
                'Resource' => 'res_worker',
                'IndexRoute' => 'mworker'
            ),
            array(
                'FormName' => 'm_subject',
                'AliasName' => 'master subject',
                'LocalName' => 'master mata pelajaran',
                'ClassName' => 'Master',
                'Resource' => 'res_subject',
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