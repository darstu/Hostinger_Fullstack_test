<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'gift_items';

    protected $fillable = ['name', 'unit_price', 'units_owned'];

    public $timestamps = false;
}
