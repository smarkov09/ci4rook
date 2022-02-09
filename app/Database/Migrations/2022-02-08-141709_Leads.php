<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Leads extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => '11',
                'auto_increment' => true
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '128'
            ],
            'lastname' => [
                'type' => 'VARCHAR',
                'constraint' => '128'
            ],
            'job' => [
                'type' => 'VARCHAR',
                'constraint' => '128'
            ],
            'age' => [
                'type' => 'TINYINT',
                'constraint' => '4'
            ],
            'tel_home' => [
                'type' => 'VARCHAR',
                'constraint' => '16'
            ],
            'tel_cel' => [
                'type' => 'VARCHAR',
                'constraint' => '16'
            ],
            'tel_job' => [
                'type' => 'VARCHAR',
                'constraint' => '16'
            ],
            'tel_ext' => [
                'type' => 'VARCHAR',
                'constraint' => '8'
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => '128'
            ],
            'address' => [
                'type' => 'VARCHAR',
                'constraint' => '128'
            ],
            'country' => [
                'type' => 'VARCHAR',
                'constraint' => '64'
            ],
            'state' => [
                'type' => 'VARCHAR',
                'constraint' => '64'
            ],
            'city' => [
                'type' => 'VARCHAR',
                'constraint' => '64'
            ],
            'obs' => [
                'type' => 'TEXT'
            ],
            'date_of_travel' => [
                'type' => 'DATE'
            ],
            'user_id' => [
                'type' => 'INT',
                'constraint' => '11'
            ],
            'status' => [
                'type' => 'INT',
                'constraint' => '11'
            ],
            'referral' => [
                'type' => 'INT',
                'constraint' => '11'
            ],
            'afectable' => [
                'type' => 'TINYINT',
                'constraint' => '1'
            ],
            'last_user' => [
                'type' => 'INT',
                'constraint' => '11'
            ],
            'program' => [
                'type' => 'INT',
                'constraint' => '11'
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp'
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('leads');
    }

    public function down()
    {
        $this->forge->dropTable('leads');
    }
}
