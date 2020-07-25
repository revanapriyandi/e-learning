<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'kelas';
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function user()
    {
        return $this->hasMany('App\User');
    }
    public function absen()
    {
        return $this->hasMany('App\Model\Absen');
    }
    public function absenp()
    {
        return $this->hasMany('App\Model\AbsenPending');
    }
    public function guru()
    {
        return $this->belongsTo('App\User', 'walikelas');
    }
    public function ketuaku()
    {
        return $this->belongsTo('App\User', 'ketuakelas');
    }
    public function mapel()
    {
        return $this->hasMany('App\Model\Mapel');
    }
    public function modul()
    {
        return $this->hasMany('App\Model\Modul');
    }
    public function quiz()
    {
        return $this->hasMany('App\Model\Quiz', 'kelas');
    }
}
