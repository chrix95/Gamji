<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = [
        'inventory_id', 'supplier_id', 'quantity', 'amount'
    ];

    public function inventory () {
        return $this->belongsTo(Inventory::class);
    }

    public function supplier () {
        return $this->belongsTo(Supplier::class);
    }
}
