<?php

namespace App\Models;

use CodeIgniter\Model;

class Ankh extends Model
{
    protected $DBGroup          = 'default';

    public function get_field($field, $table, $match, $key)
    {
        $query = $this->db->query("SELECT $field FROM $table WHERE $table.$key = $match");
        $row = $query->getRow();
        if (isset($row)) {
          return $row->$field;
        } else {
          return false;
        }
    }
}