<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Modul extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'modul';
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function kelas()
    {
        return $this->belongsTo('App\Model\Kelas');
    }
    public function pembagian()
    {
        if ($this->kelas != Null) {
            return $this->kelas->nama_kelas;
        } else {
            return 'Seluruh Kelas';
        }
    }
}
