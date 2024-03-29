<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableAdresses extends Migration
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

            'customer_id' => [
                'type'              => 'INT',
                'constraint'        => 11,
                'unsigned'          => true,
            ],

            'country' => [
                'type'              => 'VARCHAR',
                'constraint'        => 128,
            ],


            'state' => [
                'type'              => 'VARCHAR',
                'constraint'        => 128,
            ],


            'city' => [
                'type'              => 'VARCHAR',
                'constraint'        => 128,
            ],


            'neighborhood' => [
                'type'              => 'VARCHAR',
                'constraint'        => 128,
            ],
            

            'street' => [
                'type'              => 'VARCHAR',
                'constraint'        => 128,
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

        $this->forge->addKey('created_at');
        $this->forge->addKey('updated_at');


        $this->forge->addForeignKey('customer_id', 'customers', 'id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('adresses');
    }

    public function down()
    {
        $this->forge->dropTable('adresses');
    }
}
