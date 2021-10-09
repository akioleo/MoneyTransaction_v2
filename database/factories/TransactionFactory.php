<?php

namespace Database\Factories;

use App\Constants\Constants;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Transaction::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = User::first();

        return [
            'payer_id' => $user->id,
            'payee_id' => ++ $user->id,
            'value' => 10000,
            'status' => Constants::TRANSACTION_STATUS_SUCCESS,
            'operation_type' => Constants::TRANSACTION_OPERATION_TRANSFER
        ];
    }
}
