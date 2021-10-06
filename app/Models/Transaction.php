<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    /*
    STATUS_MESSAGES:

     * 11 - SUCCESS

     * LOGIC ERRORS:
     21 - USER_DOESNT_EXIST
     22 - SHOPKEEPER_ID
     23 - SAME_TRANSFER_ACCOUNTS
     24 - INSUFFICIENT_BALANCE

     * EXTERNAL ERRORS:
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
