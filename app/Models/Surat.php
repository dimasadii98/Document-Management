<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\KategoriSurat;

class Surat extends Model
{
    protected $fillable = [
        'judul',
        'isi',
        'kategori_id',
        'user_id',
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriSurat::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
