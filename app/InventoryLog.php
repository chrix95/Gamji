<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InventoryLog extends Model
{
    protected $fillable = [
        'inventories_id', 'type', 'quantity', 'remark'
    ];

    public function project () {
        return $this->belongsTo(Project::class);
    }
}
