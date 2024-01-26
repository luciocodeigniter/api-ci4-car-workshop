<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableMaintenanceServices extends Migration
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

            'service_id' => [
                'type'              => 'INT',
                'constraint'        => 11,
                'unsigned'          => true,
            ],

            'quantity' => [
                'type'              => 'INT',
                'constraint'        => 11,
            ],

        ]);

        $this->forge->addKey('id', true);

        $this->forge->addForeignKey('service_id', 'services', 'id', 'CASCADE', 'CASCADE');


        $this->forge->createTable('maintenance_services');
    }

    public function down()
    {
        $this->forge->dropTable('maintenance_services');
    }
}
