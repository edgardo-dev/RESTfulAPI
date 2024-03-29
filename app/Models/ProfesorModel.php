<?php namespace App\Models;

use CodeIgniter\Model;

class ProfesorModel extends Model 
{
    protected $table            =   'profesor';
    protected $primaryKey       =   'id';
    
    protected $allowedFields    =  ['nombre', 'apellido','profesion','telefono', 'dui'];

    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';

    protected $validationRules  = [
        'nombre'                => 'required|alpha_numeric_space|min_length[3]|max_length[75]',
        'apellido'              => 'required|alpha_numeric_space|min_length[3]|max_length[75]',
        'profesion'             => 'required|alpha_numeric_space|min_length[3]|max_length[3]',
        'telefono'              => 'required|integer|min_length[8]|max_length[9]',
        'dui'                   => 'required|duiRegex', 
    ];

    protected $validationMessages = [
        'dui'    => ['duiRegex' => 'El Dui es incorrecto ']
    ];

    protected $skipValidation = false;
}