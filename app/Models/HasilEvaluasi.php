<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HasilEvaluasi extends Model
{
    protected $table = 'hasil_evaluasi';
    protected $primaryKey = 'id_hasil_evaluasi';
    protected $fillable = ['id_tender', 'id_peserta', 'id_legend', 'status_evaluasi', 'alasan'];

    public function tender()
    {
        return $this->belongsTo(Tender::class, 'id_tender');
    }

    public function peserta()
    {
        return $this->belongsTo(Peserta::class, 'id_peserta');
    }

    public function legend()
    {
        return $this->belongsTo(Legend::class, 'id_legend');
    }
}