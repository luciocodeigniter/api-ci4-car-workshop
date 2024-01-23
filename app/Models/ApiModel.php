<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Model that concentrates common functionalities
 */
class ApiModel extends Model
{

    public function __construct()
    {
        parent::__construct();

        $this->enableForeingSuport();
    }

    /**
     * Enable SQLite foreign key suport. Otherwise, we cannot delete by cascade
     *
     * @return void
     */
    private function enableForeingSuport(): void
    {

        $this->db->simpleQuery('PRAGMA foreign_keys = ON');
    }


    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array'; //! as array
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $beforeInsert = ['escapeData'];
    protected $beforeUpdate = ['escapeData'];

    /**
     * Escape data before save
     *
     * @param array $data
     * @return array
     */
    protected function escapeData(array $data): array
    {

        return esc($data);
    }
}
