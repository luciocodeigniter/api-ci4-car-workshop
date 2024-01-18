<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableCars extends Migration
{
    public function up()
    {
        $this->forge->addField(
            [
                'id' => [
                    'type'              => 'INT',
                    'constraint'        => 11,
                    'unsigned'          => true,
                    'auto_increment'    => true
                ],


                'customer_id' => [
                    'type'              => 'INT',
                    'constraint'        => 11,
                ],


                'brand' => [
                    'type'              => 'VARCHAR',
                    'constraint'        => 128,
                ],


                'model' => [
                    'type'              => 'VARCHAR',
                    'constraint'        => 128,
                ],


                'color' => [
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

            ],
        );

        $this->forge->addKey('id', true);
        $this->forge->addKey('brand');       
        $this->forge->addKey('model');       
        $this->forge->addKey('color');       
        $this->forge->addKey('created_at');
        $this->forge->addKey('updated_at');

        $this->forge->addForeignKey('customer_id', 'customers', 'id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('cars');
    }

    public function down()
    {
        $this->forge->dropTable('cars');
    }
}
