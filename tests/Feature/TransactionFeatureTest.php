<?php

namespace Tests\Feature;

use App\Constants\Constants;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class TransactionFeatureTest extends TestCase
{
    /**
     * @var User $user
     */
    public $user;

    /**
     * Test setup
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->userToken = JWTAuth::fromUser($this->user);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_create_transaction_transfer()
    {
        $payee = User::factory()->create();

        $data = [
            'payee_id' => $payee->id,
            'value' => 100,
            'operation_type' => Constants::TRANSACTION_OPERATION_TRANSFER
        ];

        $transactionOne = Transaction::factory()->create(['payee_id' => $this->user->id, 'payer_id'=> null, 'operation_type' => Constants::TRANSACTION_OPERATION_DEPOSIT, 'value' => 10000]);
        $response = $this->withHeaders(['Authorization' => "Bearer " . $this->userToken])->post('api/transactions', $data)
            ->assertJsonFragment(['payee_id' => $payee->id])->assertStatus(201);
    }

    public function test_create_transaction_transfer_unauthorized()
    {
        $payee = User::factory()->create();

        $data = [
            'payee_id' => $payee->id,
            'value' => 100,
            'operation_type' => Constants::TRANSACTION_OPERATION_TRANSFER
        ];

        $response = $this->withHeaders(['Authorization' => "Bearer 1" . $this->userToken])->post('api/transactions', $data)
            ->assertStatus(401);
        $transactionOne = Transaction::factory()->create(['payee_id' => $this->user->id, 'payer_id'=> null, 'operation_type' => Constants::TRANSACTION_OPERATION_DEPOSIT, 'value' => 10000]);
        $response = $this->withHeaders(['Authorization' => "Bearer " . $this->userToken])->post('api/transactions', $data)
            ->assertJsonFragment(['payee_id' => $payee->id])->assertStatus(201);
    }

    public function test_create_transaction_deposit()
    {
        $payee = User::factory()->create();

        $data = [
            'payee_id' => $payee->id,
            'value' => 1000,
            'operation_type' => Constants::TRANSACTION_OPERATION_DEPOSIT
        ];
        //payee created from factory deposit
        $response = $this->withHeaders(['Authorization' => "Bearer " . $this->userToken])->post('api/transactions', $data)
            ->assertJsonFragment(['payee_id' => $payee->id])->assertStatus(201);
        //user deposit
        $transactionOne = Transaction::factory()->create(['payee_id' => $this->user->id, 'payer_id'=> null, 'operation_type' => Constants::TRANSACTION_OPERATION_DEPOSIT, 'value' => 10000]);
        $response = $this->withHeaders(['Authorization' => "Bearer " . $this->userToken])->post('api/transactions', $data)
            ->assertStatus(201);
    }

    public function test_create_transaction_withdrawl()
    {
        $data = [
            'payer_id' => $this->user->id,
            'value' => 100,
            'operation_type' => Constants::TRANSACTION_OPERATION_WITHDRAWL
        ];

        $transactionOne = Transaction::factory()->create(['payee_id' => $this->user->id, 'payer_id'=> null, 'operation_type' => Constants::TRANSACTION_OPERATION_DEPOSIT, 'value' => 10000]);
        $response = $this->withHeaders(['Authorization' => "Bearer " . $this->userToken])->post('api/transactions', $data)
            ->assertStatus(201);
    }
}
