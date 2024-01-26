<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableMaintenance extends Migration
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

            'car_id' => [
                'type'              => 'INT',
                'constraint'        => 11,
                'unsigned'          => true,
            ],

            'employee_id' => [
                'type'              => 'INT',
                'constraint'        => 11,
                'unsigned'          => true,
            ],
        

            'check_in' => [
                'type'              => 'DATETIME',
                'null'              => true,
                'default'           => null,
            ],
        

            'check_out' => [
                'type'              => 'DATETIME',
                'null'              => true,
                'default'           => null,
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
        $this->forge->addKey('check_in');
        $this->forge->addKey('check_out');
        $this->forge->addKey('created_at');
        $this->forge->addKey('updated_at');


        $this->forge->addForeignKey('car_id', 'cars', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('employee_id', 'employees', 'id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('maintenance');
    }

    public function down()
    {
        $this->forge->dropTable('maintenance');
    }
}
