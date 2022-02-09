<?php

namespace App\Models;

use CodeIgniter\Model;

class Region extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'regions';
    protected $primaryKey       = 'region_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['region_name', 'country_id'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getCountriesDropdown()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('countries');
        $builder->select('countries_name, countries_id');


        $this->db->select('countries_name', 'countries_id');
        $query = $this->db->get($this->table);
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[$row->countries_id] = $row->countries_name;
            }
            return $data;
        }
    }
}
