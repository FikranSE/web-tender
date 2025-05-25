<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HasilEvaluasi extends Model
{
  protected $table = 'hasil_evaluasi';
  protected $primaryKey = 'id';
  protected $fillable = [
    'alasan',
    'evaluasi_administrasi',
    'evaluasi_teknis',
    'harga_penawaran',
    'evaluasi_penawaran',
    'pemenang',
    'id_penawar'
  ];

  // Define the relationship to Penawar
  public function penawar()
  {
    return $this->belongsTo(Penawar::class, 'id_penawar');
  }
}
