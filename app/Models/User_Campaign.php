<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_Campaign extends Model
{
    protected $table = 'user_campaigns';

    protected $fillable = ['user_id', 'campaign_id'];

    public $timestamps = false;
}
