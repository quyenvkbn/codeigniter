<?php

class Migration_Blogs extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => 255
            )
        ));
        $this->dbforge->add_key('id', TRUE);
        // $this->dbforge->add_key('name');
        $this->dbforge->create_table('blogs');
    }

    public function down() {
        $this->dbforge->drop_table('blogs');
    }

}