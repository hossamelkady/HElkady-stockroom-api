<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['sku',
            'name',
            'quantity',
            'reorder_level',
            'unit_price'];
}
