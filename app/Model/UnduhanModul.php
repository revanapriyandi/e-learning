<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UnduhanModul extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'modul_diunduh';
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
}
