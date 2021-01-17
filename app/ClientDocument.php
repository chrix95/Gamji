<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientDocument extends Model
{
    protected $fillable = ['client_id', 'docs', 'title'];

    public function documents() {
        return $this->hasMany(ClientDocument::class);
    }
}
