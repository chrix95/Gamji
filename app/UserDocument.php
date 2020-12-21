<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDocument extends Model
{
    //
    protected $fillable = ['user_id', 'title', 'docs'];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
