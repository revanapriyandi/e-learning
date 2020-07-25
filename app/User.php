<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function jk()
    {
        if ($this->jk == 'L') {
            return 'Laki-Laki';
        } else {
            return 'Perempuan';
        }
    }
    public function kelas()
    {
        return $this->belongsTo('App\Model\Kelas');
    }
    public function absen()
    {
        return $this->hasMany('App\Model\Absen');
    }
    public function modul()
    {
        return $this->hasMany('App\Model\Modul');
    }
    public function mapel()
    {
        return $this->hasOne('App\Model\Mapel', 'pengajar');
    }
    public function kelasku()
    {
        return $this->hasOne('App\Model\Kelas', 'walikelas');
    }
    public function ketuak()
    {
        return $this->hasOne('App\Model\Kelas', 'ketuakelas');
    }
    public function quiz()
    {
        return $this->hasMany('App\Model\Quiz', 'pembuat');
    }
    public function TujuantugasSiswa()
    {
        return $this->hasMany('App\Model\TugasSiswa', 'to');
    }
    public function pengirim()
    {
        return $this->hasMany('App\Model\TugasSiswa', 'dari');
    }
    public function ReadyQuiz()
    {
        return $this->hasMany('App\Model\SiswaReadyQuiz.php', 'siswa_id');
    }
}
