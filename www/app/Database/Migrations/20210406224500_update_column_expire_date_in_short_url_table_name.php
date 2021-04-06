<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateColumnExpireDateInShortUrlTableName extends Migration
{
    const SHORT_URL_TABLE_NAME = 'short_url';

    public function up()
    {
        $fields = [
            'expire_date' => [
                'type' => 'DATETIME',
            ],
        ];
        $this->forge->modifyColumn(self::SHORT_URL_TABLE_NAME, $fields);
    }

    public function down()
    {
    }
}