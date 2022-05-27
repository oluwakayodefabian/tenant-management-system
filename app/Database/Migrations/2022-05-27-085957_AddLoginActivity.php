<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddLoginActivity extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 5,
                'auto_increment' => true,
            ],
            'admin_id'          => [
                'type'           => 'INT',
                'constraint'     => 5,
            ],
            'agent'       => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'ip_address'       => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'login_time' => [
                'type'       => 'DATETIME',
            ],
            'logout_time' => [
                'type'       => 'DATETIME',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('login_activity');
    }

    public function down()
    {
        $this->forge->dropTable('login_activity');
    }
}
