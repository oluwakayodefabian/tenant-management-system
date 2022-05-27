<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddAdminUsers extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'admin_id'          => [
                'type'           => 'INT',
                'constraint'     => 5,
                'auto_increment' => true,
            ],
            'first_name'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'last_name'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'admin_email'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'admin_username'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'admin_type'       => [
                'type'           => 'ENUM',
                'constraint'     => ['super_admin', 'sub_admin'],
                'default'        => 'super_admin',
            ],
            'password' => [
                'type' => 'TEXT',
            ],
            'unique_id' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'created_on' => [
                'type'       => 'DATETIME',
            ],
        ]);
        $this->forge->addKey('admin_id', true);
        $this->forge->addUniqueKey('admin_username', true);
        $this->forge->createTable('admin_users');
    }

    public function down()
    {
        $this->forge->dropTable('admin_users');
    }
}
