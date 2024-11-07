<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penawar extends Model
{
    protected $table = 'penawar';
    protected $primaryKey = 'id';
    protected $fillable = ['id_peserta', 'id_tender', 'nama_perusahaan', 'npwp', 'email', 'nomor_telepon', 'alamat', 'dokumen_perusahaan', 'dokumen_penawaran', 'harga_penawaran'];

    public function tender()
    {
        return $this->belongsTo(Tender::class, 'id_tender');
    }
    
    public function peserta()
    {
        return $this->belongsTo(User::class, 'id_peserta');
    }
}