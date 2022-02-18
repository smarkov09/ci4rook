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

    public function new_user_modules($usertype_id, $modules_row_count)
    {
        //$table_row_count = $this->db->countAll('modules');
        $table_row_count = $modules_row_count;
        $i = 1;
        for ($i; $i <= $table_row_count; $i++) {
            $start = [
                'module_id' => $i,
                'usertype_id' => $usertype_id,
                'read' => 0,
                'create' => 0,
                'update' => 0,
                'delete' => 0,
                'print' => 0
            ];
            //$this->db->insert($this->table, $start);
            $this->db->table($this->table)->insert($start);
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

        /******
         * 
         * ****/
        $db = db_connect();
        $sql = "SELECT * FROM usersmodules WHERE usertype_id = " . $usertype;

        // for debug
        /*$query = $db->query($sql);
        $query = $db->getLastQuery();
        echo (string) $query;
        die();*/

        if ($query = $db->query($sql)) {
            foreach ($query->getResult() as $row) {
                $module_name = $this->get_field('name', 'modules', $row->module_id, 'id');
                $row->module_name = $module_name;
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    public function update_p($id, $data)
    {
        /*$db = db_connect();
        $db->where('id', $id);
        if ($db->update($this->table, $data)) {
          return TRUE;
        } else {
          return FALSE;
        }*/
        /*$sql = "UPDATE usersmodules SET ". $data ." WHERE usertype_id = " . $id;
        if ($query = $db->query($sql)) {
            return true;
        }
        else {
            return false;
        }*/
        /*var_dump($data);
        print_r($data);
        print_r($id);
        die();*/
        $db      = \Config\Database::connect();
        $builder = $db->table('usersmodules');
        $builder->where('id', $id);
        if ($builder->update($data)) {
            return true;
        }
        else {
            return false;
        }

    }
}
