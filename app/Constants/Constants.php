<?php

namespace App\Constants;

class Constants
{
    /**
     * Transaction Status Constants
     */
    const TRANSACTION_STATUS_SUCCESS = 'SUCCESS';
    const TRANSACTION_STATUS_USER_DOESNT_EXIST = 'USER_DOESNT_EXIST';
    const TRANSACTION_STATUS_SHOPKEEPER_ID = 'SHOPKEEPER_ID';
    const TRANSACTION_STATUS_SAME_TRANSFER_ACCOUNTS = 'SAME_TRANSFER_ACCOUNTS';
    const TRANSACTION_STATUS_INSUFFICIENT_BALANCE = 'INSUFFICIENT_BALANCE';


    const statusTransaction = [
        self::TRANSACTION_STATUS_INSUFFICIENT_BALANCE,
        self::TRANSACTION_STATUS_SAME_TRANSFER_ACCOUNTS,
        self::TRANSACTION_STATUS_SHOPKEEPER_ID,
        self::TRANSACTION_STATUS_SUCCESS,
        self::TRANSACTION_STATUS_USER_DOESNT_EXIST
        ];

    /**
     *  External Transaction Constants
     */
    const EXTERNAL_TRANSACTION_AUTHORIZATION_ERROR = 'AUTHORIZATION_ERROR';
    const EXTERNAL_TRANSACTION_NOTIFICATION_ERROR = 'NOTIFICATION_ERROR';

    const transactionExternalValidation = [
        self::EXTERNAL_TRANSACTION_AUTHORIZATION_ERROR,
        self::EXTERNAL_TRANSACTION_NOTIFICATION_ERROR
    ];

    /**
     * Transaction Operation Type Constants
     */
    const TRANSACTION_OPERATION_TRANSFER = 'TRANSFER';
    const TRANSACTION_OPERATION_WITHDRAWL = 'WITHDRAWL';
    const TRANSACTION_OPERATION_DEPOSIT = 'DEPOSIT';

    const statusOperation = [
        self::TRANSACTION_OPERATION_TRANSFER,
        self::TRANSACTION_OPERATION_WITHDRAWL,
        self::TRANSACTION_OPERATION_DEPOSIT
    ];

    /**
     * User Account Type Constants
     */
    const USER_ACCOUNT_TYPE_USER = 'USER';
    const USER_ACCOUNT_TYPE_SHOPKEEPER = 'SHOPKEEPER';

    const statusAccountType = [
        self::USER_ACCOUNT_TYPE_USER,
        self::USER_ACCOUNT_TYPE_SHOPKEEPER
    ];
}
