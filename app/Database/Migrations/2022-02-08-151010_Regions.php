<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Regions extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'region_id' => [
                'type' => 'INT',
                'constraint' => '11',
                'auto_increment' => true
            ],
            'region_name' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ],
            'country_id' => [
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

        $this->forge->addKey('region_id', true);
        $this->forge->createTable('regions');
    }

    public function down()
    {
        $this->forge->dropTable('regions');
    }
}
