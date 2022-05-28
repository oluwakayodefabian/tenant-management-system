<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddProperties extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'property_id'          => [
                'type'           => 'INT',
                'constraint'     => 5,
                'auto_increment' => true,
            ],
            'admin_id'          => [
                'type'           => 'INT',
                'constraint'     => 5,
            ],
            'country'       => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'state'       => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'city'       => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'address'       => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'description'       => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'rent_amount'       => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'property_image'       => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'property_status'       => [
                'type'           => 'ENUM',
                'constraint'     => ['vacant', 'occupied'],
                'default'        => 'vacant',
            ],
            'rent_starting_date' => [
                'type'       => 'DATETIME',
            ],
            'rent_ending_date' => [
                'type'       => 'DATETIME',
            ],

        ]);
        $this->forge->addKey('property_id', true);
        $this->forge->createTable('properties');
    }

    public function down()
    {
        $this->forge->dropTable('properties');
    }
}
