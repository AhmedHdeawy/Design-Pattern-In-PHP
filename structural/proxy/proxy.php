<?php

abstract class SendSMS
{
	abstract public function send_sms(string $phone, string $text);
}

class ConcreteSendSMS
{
	public function send_sms(string $phone, string $text)
	{
		echo "sms sent to $phone with text $text . \n";
	}
}

class SMSProxy
{
	protected array $customersSms = [];

	protected $snedSms = null;

	public function send_sms(int $customerId, string $phone, string $text)
	{
		if ($this->snedSms == null) {
			$this->snedSms = new ConcreteSendSMS();
		}

		if (!isset($this->customersSms[$customerId])) {
			$this->customersSms[$customerId] = 1;
		}

		if ($this->customersSms[$customerId] >= 3) {
			echo "Couldn't send, reached to limit. \n";
			return true;
		}

		$this->customersSms[$customerId] += 1;

		$this->snedSms->send_sms($phone, $text);
	}
}

// Client Code

$proxy = new SMSProxy();

$proxy->send_sms(1, "012", "Hey");
$proxy->send_sms(1, "012", "Hey");
$proxy->send_sms(1, "012", "Hey");
$proxy->send_sms(1, "012", "Hey");