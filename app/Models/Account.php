<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;
    use HasUuids;

    protected $connection = 'mysql';
    protected $table = 'accounts';
    protected $primaryKey = 'account_id';
    protected $keyType = 'string';
    public $timestamps = false;
    public $incrementing = false;
    protected $attributes = [
        'account_id' => null,
        'role' => 'PASIEN',
        'patient_nik' => null,
        'phone_number' => null,
        'password' => null,
        'patient_erm' => null,
        'full_name' => null,
    ];
}
