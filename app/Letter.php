<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Letter extends Model
{
    protected $fillable = ['title', 'file_url', 'description', 'branch_id', 'sender_name', 'sender_email', 'sender_phone'];

    public function branch () {
        return $this->belongsTo(Branch::class);
    }
}
