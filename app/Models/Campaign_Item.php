<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign_Item extends Model
{
    protected $table = 'campaigns_item';

    protected $fillable = ['campaign_id', 'gift_id', 'gift_item_count'];

    public $timestamps = false;
}
