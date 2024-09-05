<?php

namespace App\Models;

use CodeIgniter\Model;

class InputModel extends Model
{
    protected $table    = 'maps';
    protected $primarykey = 'id';
    protected $allowedFields = ['id', 'groundStation', 'sic', 'sac', 'altitude', 'latitude', 'longitude', 'status', 'keterangan'];
}
