<?php

namespace App\Models;

use CodeIgniter\Model;

class InputDataModel extends Model
{
  protected $table    = 'input_data';
  protected $primarykey = 'id';
  protected $allowedFields = ['id', 'sic', 'tanggal', 'waktu', 'time_update'];
}
