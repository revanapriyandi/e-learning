<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TugasSiswa extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tugas_siswa';
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function tujuan()
    {
        return $this->belongsTo('App\User', 'to');
    }
    public function pengirim()
    {
        return $this->belongsTo('App\User', 'dari');
    }
    public function status()
    {
        if ($this->status == 'send') {
            return 'Belum dilihat';
        } else {
            return 'Sudah dilihat';
        }
    }
}
