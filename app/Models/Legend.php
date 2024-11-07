<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Legend extends Model
{
    protected $table = 'legend';
    protected $primaryKey = 'id_legend';
    protected $fillable = ['kode', 'keterangan', 'warna'];
}