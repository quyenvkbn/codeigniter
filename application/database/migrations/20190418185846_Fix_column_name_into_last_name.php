<?php

class Migration_Fix_column_name_into_last_name extends CI_Migration {

    public function up() {
        $fields = array(
            'name' => array(
                'name' => 'last_name',
                'type' => 'VARCHAR',
                'constraint' => 255
            )
        );
        $this->dbforge->modify_column('blogs', $fields);
    }

    public function down() {
        $fields = array(
            'last_name' => array(
                'name' => 'name',
                'type' => 'VARCHAR',
                'constraint' => 255
            )
        );
        $this->dbforge->modify_column('blogs', $fields);
    }

}