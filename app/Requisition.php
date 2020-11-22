<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requisition extends Model
{
    protected $fillable = [
        'user_id', 'project_id', 'requisition_items_id', 'status'
    ];

    public function items () {
        return $this->hasMany(InventoryItem::class);
    }

    public function project () {
        return $this->belongsTo(Project::class);
    }
}
