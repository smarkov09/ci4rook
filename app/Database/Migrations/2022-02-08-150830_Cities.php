<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Cities extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'city_id' => [
                'type' => 'INT',
                'constraint' => '11',
                'auto_increment' => true
            ],
            'city_name' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ],
            'region_id' => [
                'type' => 'INT',
                'constraint' => '11'
            ],
            'status' => [
                'type' => 'INT',
                'constraint' => '11'
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp'
        ]);

        $this->forge->addKey('city_id', true);
        $this->forge->createTable('cities');
    }

    public function down()
    {
        $this->forge->dropTable('cities');
    }
}
