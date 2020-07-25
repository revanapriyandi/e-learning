<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Absen extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'absen';
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
    public function semester()
    {
        return $this->belongsTo('App\Model\Semester');
    }
    public function kelas()
    {
        return $this->belongsTo('App\Model\Kelas');
    }
    public function hadir()
    {
        if ($this->keterangan == '1') {
            return '1';
        } else {
            return '0';
        }
    }
    public function izin()
    {
        if ($this->keterangan == '2') {
            return '1';
        } else {
            return '0';
        }
    }
    public function sakit()
    {
        if ($this->keterangan == '3') {
            return '1';
        } else {
            return '0';
        }
    }
    public function alpha()
    {
        if ($this->keterangan == '4') {
            return '1';
        } else {
            return '0';
        }
    }
    public function Counthadir()
    {
        return $this->where('keterangan', '1')->count();
    }
    public function Countizin()
    {
        return $this->where('keterangan', '2')->count();
    }
    public function Countsakit()
    {
        return $this->where('keterangan', '3')->count();
    }
    public function Countalpha()
    {
        return $this->where('keterangan', '4')->count();
    }
    public function keterangan()
    {

        if ($this->keterangan == '1') {
            return 'Hadir';
        } elseif ($this->keterangan == '2') {
            return 'Izin';
        } elseif ($this->keterangan == '3') {
            return 'Sakit';
        } else {
            return 'Alpha';
        }
    }
}
