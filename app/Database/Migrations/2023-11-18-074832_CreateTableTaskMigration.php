<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableTaskMigration extends Migration
{
    public function up()
    {
        // menambahkan column/field di table
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'done' => [
                'type' => 'TINYINT',
                'default' => false
            ]
        ]);

        // Set primary key
        $this->forge->addPrimaryKey('id');

        // membuat table
        $this->forge->createTable('tasks');
    }

    public function down()
    {
        // menghapus table
        $this->forge->dropTable('tasks');
    }
}
