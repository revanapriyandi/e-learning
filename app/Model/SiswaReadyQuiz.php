<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SiswaReadyQuiz extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'siswa_sudah_mengerjakan';
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function quiz()
    {
        return $this->belongsTo('App\Model\SiswaReadyQuiz', 'topik_quiz');
    }
    public function user()
    {
        return $this->belongsTo('App\User', 'siswa_id');
    }
}
