<?php
class BankAccount {
    private $accountnumber;
    private $balance;

    public function __construct($accountnumber) {
        $this->accountnumber = $accountnumber;
        $this->balance = 0;
    }

    public function getaccount() {
        return $this->accountnumber;
    }

    public function getbalance() {
        return $this->balance;
    }

    public function deposit($amount) {
        $this->balance += $amount;
        echo "Deposited $amount into account $this->accountnumber. New balance: $this->balance</br>";
    }

    public function withdraw($amount) {
        if ($this->balance >= $amount) {
            $this->balance -= $amount;
            echo "Withdrawn $amount from account $this->accountnumber. New balance: $this->balance</br>";
        }
        else
        {
           echo "Want to withdrawn $amount?</br>";
           echo "Insufficient balance in account $this->accountnumber. Current balance: $this->balance</br>";
        }
    }
}

$account = new BankAccount("SB-1234");
echo "Account Number: " . $account->getaccount() . "</br>";
echo "Initial Balance: " . $account->getBalance() . "</br>";

$account->deposit(1000);
$account->withdraw(600);
$account->withdraw(700);
?>