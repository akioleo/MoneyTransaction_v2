<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    /*
     SUCCESS:
     11 - TRANSFER_SUCCESS
     12 - WITHDRAWL_SUCCESS
     13 - DEPOSIT_SUCCESS

     LOGIC ERRORS:
     21 - SHOPKEEPER_ID
     22 - SAME_ACCOUNTS
     23 - INSUFFICIENT_BALANCE

     EXTERNAL ERRORS:
     31 - AUTHORIZATION_ERROR
     32 - NOTIFICATION_ERROR
     */

    use HasFactory;

    protected $table = "transactions";

    protected $fillable = [
        'payer', 'payee','value','status'
    ];

    protected $attributes = [
        'value' => 0,
        'status' => 0,
    ];
}
