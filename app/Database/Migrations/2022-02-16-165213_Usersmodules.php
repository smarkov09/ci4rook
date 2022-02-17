<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Usersmodules extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => '11',
                'auto_increment' => true
            ],
            'module_id' => [
                'type' => 'INT',
                'constraint' => '11'
            ],
            'usertype_id' => [
                'type' => 'INT',
                'constraint' => '11'
            ],
            'read' => [
                'type' => 'tinyint',
                'constraint' => '4',
                'default' => 0
            ],
            'create' => [
                'type' => 'tinyint',
                'constraint' => '4',
                'default' => 0
            ],
            'update' => [
                'type' => 'tinyint',
                'constraint' => '4',
                'default' => 0
            ],
            'delete' => [
                'type' => 'tinyint',
                'constraint' => '4',
                'default' => 0
            ],
            'print' => [
                'type' => 'tinyint',
                'constraint' => '4',
                'default' => 0
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp'
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('usersmodules');
    }

    public function down()
    {
        $this->forge->dropTable('usersmodules');
    }
}
