<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateShortUrlTableName extends Migration
{
    const SHORT_URL_TABLE_NAME = 'short_url';

    public function up()
    {
        $attributes = ['ENGINE' => 'InnoDB'];
        $this->forge->addField('id');
        $this->forge->addField([
            'alias' => [
                'type' => 'VARCHAR',
                'constraint' => '10',
                'unique' => true,
                'null' => true,
            ],
            'url' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'hits' => [
                'type' => 'INT',
                'constraint' => '11',
                'default' => 0,
            ],
            'expire_date' => [
                'type' => 'DATE',
            ],
            'created_date datetime default current_timestamp',
        ]);
        $this->forge->createTable(self::SHORT_URL_TABLE_NAME, false, $attributes);
    }

    public function down()
    {
        $this->forge->dropTable(self::SHORT_URL_TABLE_NAME);
    }
}