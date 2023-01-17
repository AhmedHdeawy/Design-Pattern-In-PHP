<?php


/**
 * Factory Pattern Details
 * 
 * Create BankFactory Interface
 *
 * Create The ConcreteBankFacotry to implement and determine which bank should return
 */

interface BankFactory
{
	public function getBank($code);
}

class ConcreteBankFacotry implements BankFactory
{
	public function getBank($code)
	{
		switch ($code) {
			case '1234':
				return new AhlyBank();
				break;
			case '5678':
				return new CIBBank();
				break;
		}
	}
}

// ===============================================

/**
 * Logic Details that is used Factor Pattern
 *
 * Base Bank to define the basic operation for all bank
 *
 * Create each bank and implement the base bank functions 
 */

interface BaseBank
{
	public function accountDetails();
}

class AhlyBank implements BaseBank
{
	public function accountDetails()
	{
		echo "Your account details at Alahly Bank .\n";
	}
}

class CIBBank implements BaseBank
{
	public function accountDetails()
	{
		echo "Your account details at CIB Bank .\n";
	}
}



// Client Code

// Call Concrete Bank Factory
$concrete = new ConcreteBankFacotry();
$bank = $concrete->getBank("5678");

// Call The bank function without any knoweldge about the bank
$bank->accountDetails();