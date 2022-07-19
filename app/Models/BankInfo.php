<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankInfo extends Model
{
    use HasFactory;
    public $table = 'bankinfo';
    protected $fillable = [
        'user_id', 'acctname','acctno','bank'
    ];
}
