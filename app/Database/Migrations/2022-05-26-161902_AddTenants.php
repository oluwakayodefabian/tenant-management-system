<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddTenants extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'tenant_id'          => [
                'type'           => 'INT',
                'constraint'     => 5,
                'auto_increment' => true,
            ],
            'property_id' => [
                'type'       => 'INT',
                'constraint' => '5',
            ],
            'first_name'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'last_name'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'email'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'tenant_username'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'password' => [
                'type' => 'TEXT',
            ],
            'gender' => [
                'type' => 'TEXT',
                'constraint' => '10',
            ],
            'state' => [
                'type' => 'TEXT',
                'constraint' => '50',
            ],
            'lga' => [
                'type' => 'TEXT',
                'constraint' => '50',
            ],
            'phone_no' => [
                'type' => 'TEXT',
                'constraint' => '11',
            ],
            'unique_id' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],

            'created_on' => [
                'type'       => 'DATETIME',
            ],
        ]);
        $this->forge->addKey('tenant_id', true);
        $this->forge->addUniqueKey('email', true);
        $this->forge->createTable('tenants');
    }

    public function down()
    {
        $this->forge->dropTable('tenants');
    }
}
