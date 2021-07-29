<?php

namespace App\Models;

use CodeIgniter\Model;

class ResponsavelModel extends Model
{
    protected $table = 'responsaveis';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';

    protected $allowedFields = ['nome'];

    protected $useTimestamps = true;
}