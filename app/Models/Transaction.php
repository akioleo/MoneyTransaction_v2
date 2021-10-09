<?php

namespace App\Models;

use App\Traits\ModelTransform;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{

    use HasFactory, ModelTransform;


    protected $table = "transactions";

    public $transformer = \App\Transformers\TransactionTransformer::class;

    protected $fillable = [
        'payer_id', 'payee_id','value','status', 'operation_type'
    ];

    public function payee()
    {
        return $this->belongsTo(User::class, 'payee_id', 'id');
    }

    public function payer()
    {
        return $this->belongsTo(User::class, 'payer_id', 'id');
    }


}
