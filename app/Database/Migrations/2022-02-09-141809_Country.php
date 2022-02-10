<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Country extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'country_id' => [
                'type' => 'INT',
                'constraint' => '11',
                'auto_increment' => true
            ],
            'country_name' => [
                'type' => 'VARCHAR',
                'constraint' => '250'
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp'
        ]);

        $this->forge->addKey('country_id', true);
        $this->forge->createTable('country');
    }

    public function down()
    {
        $this->forge->dropTable('country');
    }
}
