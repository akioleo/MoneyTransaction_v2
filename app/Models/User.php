<?php

namespace App\Models;

use App\Traits\ModelTransform;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable, ModelTransform;

    public $transformer = \App\Transformers\UserTransformer::class;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'password',
        'email',
        'document',
        'account_type'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected $attributes = [
        'account_type' => 0
    ];

    public function getJWTIdentifier()
    {
        //Pega identificação única desse usuário
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        //Se quiser retornar alguma claim
        return [];
    }

    public function transaction()
    {
        return $this->hasMany(Transaction::class);
    }

    public function getBalance()
    {
        $income = Transaction::where('payee_id', $this->id)->sum('value');
        //dd($receitas);
        $saida = Transaction::where('payer_id', $this->id)->sum('value');
        //dd($saida);
        return (float)$income - $saida;
    }

}
