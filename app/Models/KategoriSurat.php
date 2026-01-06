<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriSurat extends Model
{
    protected $fillable = ['nama_kategori'];

    public function surats()
    {
        return $this->hasMany(Surat::class);
    }
}
