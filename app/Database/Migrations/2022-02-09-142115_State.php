<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class State extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'state_id' => [
                'type' => 'INT',
                'constraint' => '11',
                'auto_increment' => true
            ],
            'country_id' => [
                'type' => 'INT',
                'constraint' => '11',
            ],
            'state_name' => [
                'type' => 'VARCHAR',
                'constraint' => '250'
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp'
        ]);

        $this->forge->addKey('state_id', true);
        $this->forge->createTable('state');
    }

    public function down()
    {
        $this->forge->dropTable('state');
    }
}
