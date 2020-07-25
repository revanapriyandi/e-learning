<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ModulDownload extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'modul_has_download';
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
}
