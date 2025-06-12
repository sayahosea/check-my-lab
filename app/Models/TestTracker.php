<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestTracker extends Model
{
    use HasFactory;

    protected $connection = 'mysql';
    protected $table = 'test_trackers';
    protected $primaryKey = null;
    public $incrementing = false;
    protected $attributes = [
        'test_id' => null,
        'activity' => null,
        'time' => null
    ];
}
