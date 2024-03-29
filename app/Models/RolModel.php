<?php namespace App\Models;

use CodeIgniter\Model;

class RolModel extends Model 
{
    protected $table            =   'rol';
    protected $primaryKey       =   'id';
    
    protected $allowedFields    =  ['nombre'];

    protected $useTimestamps    = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules  = [
        'nombre'                => 'required|alpha_numeric_space|min_length[3]|max_length[45]'
      
    ];

    protected $skipValidation = false;
}