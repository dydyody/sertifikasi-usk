<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Peserta extends Model
{
    protected $fillable = [
        'no_peserta',
        'nama',
        'nik',
        'email',
        'no_hp',
        'alamat',
        'skema_sertifikasi_id',
    ];

    public function skemaSertifikasi(): BelongsTo
    {
        return $this->belongsTo(
            SkemaSertifikasi::class,
            'skema_sertifikasi_id'
        );
    }

    public function pendaftarans()
    {
        return $this->hasMany(\App\Models\Pendaftaran::class);
    }
}
