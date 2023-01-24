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
	
	public function getVisa($code);
}

/**
 * Concrete Factory that will implement the interface and determine which type should return in each function
 */
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

	public function getVisa($code)
	{
		switch ($code) {
			case '1234':
				return new VisaCard();
				break;
			case '5678':
				return new MasterCard();
				break;
		}
	}
}

// =============================================== //

// 1- Bank Type

/**
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


// =============================================== //
// 2- Credit Card Type

/**
 *
 * Base Bank to define the basic operation for all bank
 *
 * Create each bank and implement the base bank functions 
 */
interface BaseCreditCard
{
	public function cardName();
}

class VisaCard implements BaseCreditCard
{
	public function cardName()
	{
		echo "Your card is Visa .\n";
	}
}

class MasterCard implements BaseCreditCard
{
	public function cardName()
	{
		echo "Your card is MasterCard .\n";
	}
}



// Client Code

// Call Concrete Factory
$concrete = new ConcreteBankFacotry();

// Call the first type
$bank = $concrete->getBank("5678");
// Call The bank function without any knoweldge about the bank
$bank->accountDetails();

// Call the second type
$card = $concrete->getVisa("1234");
$card->cardName();