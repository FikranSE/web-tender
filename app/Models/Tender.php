<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tender extends Model
{
    protected $table = 'tender';
    protected $primaryKey = 'id_tender';
    protected $fillable = ['id_paket', 'kode_tender', 'nama_tender', 'tahapan_tender_saat_ini', 'tanggal_mulai', 'tanggal_selesai', 'dokumen_pemilihan', 'hasil_evaluasi', 'berita_acara'];

    public function paket()
    {
        return $this->belongsTo(Paket::class, 'id_paket');
    }

    public function penawar()
    {
        return $this->hasMany(User::class, 'id');
    }

    public function hasilEvaluasi()
    {
        return $this->hasMany(Penawar::class, 'id');
    }
    
}