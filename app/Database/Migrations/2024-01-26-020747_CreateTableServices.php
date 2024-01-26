<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableServices extends Migration
{
    public function up()
    {
        $this->forge->addField([

            'id' => [
                'type'              => 'INT',
                'constraint'        => 11,
                'unsigned'          => true,
                'auto_increment'    => true
            ],

            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],

            'price' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
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
        $this->forge->addKey('name');

        $this->forge->createTable('services');
    }

    public function down()
    {
        $this->forge->dropTable('services');
    }
}
