<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTablePortfoliosMigration extends Migration
{
    public function up()
    {
        // menambahkan field/kolom
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'description' => [
                'type' => 'TEXT'
            ],
            'image' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
            'updated_at DATETIME DEFAULT CURRENT_TIMESTAMP',
            'deleted_at DATETIME DEFAULT NULL',
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('portfolios');
    }

    public function down()
    {
        // menghapus table
        $this->forge->dropTable('portfolios');
    }
}
