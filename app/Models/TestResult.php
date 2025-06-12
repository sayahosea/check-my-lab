<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestResult extends Model
{
    use HasFactory;

    protected $connection = 'mysql';
    protected $table = 'test_results';
    protected $primaryKey = 'test_id';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $attributes = [
        'test_id' => null,
        'patient_nik' => null,
        'test_file' => null
    ];
}
