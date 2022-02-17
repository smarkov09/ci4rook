<?php

namespace App\Models;

use CodeIgniter\Model;

class Usersmodules extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'usersmodules';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['module_id', 'usertype_id', 'read', 'create', 'update', 'delete', 'print'];

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

    public function new_user_modules($usertype_id)
    {
        $table_row_count = $this->db->countAll('modules');
        $i = 1;
        for ($i; $i <= $table_row_count; $i++) {
            $start = [
                'module_id' => $i,
                'usertype_id' => $usertype_id,
                'read' => 0,
                'create' => 0,
                'update' => 0,
                'update' => 0,
                'print' => 0
            ];
            $this->db->insert($this->table, $start);
        }
    }

    public function get_field($field, $table, $match, $key)
    {
        $query = $this->db->query("SELECT $field FROM $table WHERE $table.$key = $match");
        $row = $query->getRow();
        if (isset($row)) {
          return $row->$field;
        } else {
          return FALSE;
        }
    }

    public function fetch_users_modules($usertype)
    {
        $data = array();
        $db = \Config\Database::connect();
        $builder = $db->table($this->table);
        $builder->where('usertype_id', $usertype);
        $builder->orderBy('module_id', 'ASC');
        
        if ($builder->get()->getResult()) {
            foreach ($builder->get()->getResult() as $row) {
                $module_name = $this->get_field('name', 'modules', $row->module_id, 'id');
                $row->module_name = $module_name;
                $data[] = $row;
            }
            return $data;
        }
        return false;

        /*$this->db->where('usertype_id', $usertype);
        $this->db->order_by('module_id', 'ASC');
        $query = $this->db->get($this->table);*/
/*
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $module_name = $this->get_field('name', 'modules', $row->module_id, 'id');

                $row->module_name = $module_name;
                $data[] = $row;
            }

            return $data;
        }

        return false;*/
    }
}
