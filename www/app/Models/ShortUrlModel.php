<?php

namespace App\Models;

use CodeIgniter\Model;

class ShortUrlModel extends Model
{
    public function __construct() {
        parent::__construct();
        $this->table = 'short_url';
    }

    protected $table = 'short_url';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['alias', 'url', 'hits', 'expire_date'];

    protected $useTimestamps = false;
    protected $createdField = 'created_at';

    protected $validationRules = [
        'alias' => 'required|max_length[10]|is_unique[short_url.alias]',
        'url' => 'required|max_length[255]|valid_url',
        'hits' => 'required|numeric|max_length[11]',
        'expire_date' => 'required|valid_date'
    ];
    protected $validationMessages = [];
    protected $skipValidation = false;
}