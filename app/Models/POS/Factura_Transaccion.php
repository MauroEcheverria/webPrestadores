<?php

namespace App\Models\POS;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura_Transaccion extends Model
{
    use HasFactory;
    protected $table = "dct_pos_tbl_factura_transaccion";
}
