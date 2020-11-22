<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequisitionItem extends Model
{
    protected $fillable = [
        'requisition_id', 'inventories_id', 'quantity'
    ];

    public function requisition () {
        return $this->hasOne(Inventory::class);
    }
}
