<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AbsenPending extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'absen_pending';
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
