<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class RegisterLog extends Model
{

    protected $table = 'register_logs';

    protected $fillable = [
        'register_id', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function register()
    {
        return $this->belongsTo(Register::class);
    }
}
