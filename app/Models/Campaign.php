<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $table = 'gift_campaigns';

    protected $fillable = ['campaign_name', 'status', 'dispatch_date', 'delivery_date'];

    public $timestamps = false;
}
