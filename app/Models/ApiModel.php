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

        $this->setSQLMode();
    }

    protected function setSQLMode()
    {
        $this->db->simpleQuery("set session sql_mode=''");
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
     * Escape data
     *
     * @param array $data
     * @return array
     */
    protected function escapeData(array $data)
    {
        return esc($data);
    }
}
