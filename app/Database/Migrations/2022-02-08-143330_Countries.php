<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Countries extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'countries_id' => [
                'type' => 'INT',
                'constraint' => '11',
                'auto_increment' => true
            ],
            'countries_name' => [
                'type' => 'VARCHAR',
                'constraint' => '64'
            ],
            'countries_iso_code_2' => [
                'type' => 'CHAR',
                'constraint' => '2'
            ],
            'countries_iso_code_3' => [
                'type' => 'CHAR',
                'constraint' => '3'
            ],
            'status' => [
                'type' => 'INT',
                'constraint' => '11'
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp'
        ]);

        $this->forge->addKey('countries_id', true);
        $this->forge->createTable('countries');
    }

    public function down()
    {
        $this->forge->dropTable('countries');
    }
}
