<?php

namespace Tests\Unit;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */


    public function test_user_balance()
    {
        $user = User::factory()->create();
        $user2 = User::factory()->create();
        $transactionOne = Transaction::factory()->create(['payee_id' => $user->id, 'payer_id' => $user2->id]);
        $transactionTwo = Transaction::factory()->create(['payer_id' => $user->id, 'payee_id' => $user2->id, 'value' => 5000]);
        $this->assertEquals(5000, (int)$user->getBalance());
    }
}
