<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'mapel';
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function guru()
    {
        return $this->belongsTo('App\User', 'pengajar');
    }
    public function kelas()
    {
        return $this->belongsTo('App\Model\Kelas');
    }
    public function quiz()
    {
        return $this->hasMany('App\Model\Quiz', 'mapel');
    }
}
