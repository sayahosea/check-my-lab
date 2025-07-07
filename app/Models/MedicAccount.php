<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class MedicAccount extends Model
{
    use HasUuids;

    protected $table = 'puskesmas';

    protected $primaryKey = 'account_id';
    protected $keyType = 'string';

    public $timestamps = false;
    public $incrementing = false;

    protected $attributes = [
        'account_id' => null,
        'full_name' => null,
        'phone_number' => null,
        'password' => null
    ];
}
