<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'semester';
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function absen()
    {
        return $this->hasMany('App\Model\Absen');
    }
    public function kode()
    {
        return 'semester' . ' ' . $this->kode;
    }
}
