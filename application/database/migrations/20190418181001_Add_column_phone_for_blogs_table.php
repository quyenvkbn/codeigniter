<?php

class Migration_Add_column_phone_for_blogs_table extends CI_Migration {

    public function up() {
        $fields = array(
            'phone' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
            )
        );
        $this->dbforge->add_column('blogs',$fields,'id');
    }

    public function down() {
        $this->dbforge->drop_column('blogs','phone');
    }

}