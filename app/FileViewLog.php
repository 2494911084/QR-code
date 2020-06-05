<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\Pivot;

class FileViewLog extends Model
{

    protected $table = 'file_view_logs';

    protected $fillable = [
        'user_id', 'file_id', 'qm_img'
    ];

    public function file()
    {
        return $this->belongsTo(File::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
