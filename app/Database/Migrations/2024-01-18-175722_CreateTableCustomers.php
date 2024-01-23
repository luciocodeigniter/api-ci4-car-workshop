<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableCustomers extends Migration
{
    public function up()
    {
        $this->forge->addField([
            
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'AUTOINCREMENT' => true,
            ],

            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],

            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],

            'phone' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],

            'created_at' => [
                'type'              => 'DATETIME',
                'null'              => true,
                'default'           => null,
            ],

            'updated_at' => [
                'type'              => 'DATETIME',
                'null'              => true,
                'default'           => null,
            ],

        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey('email');
        $this->forge->addKey('phone');

        $this->forge->createTable('customers');
    }

    public function down()
    {
        $this->forge->dropTable('customers');
    }
}
