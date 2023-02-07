<?php


interface Adapter
{
	public function adapter();
}

/**
 * Adapter class to convert a manager type to employee type
 */
class SalaryAdapter implements Adapter
{
	private Manager $manager;
	
	function __construct(Manager $manager)
	{
		$this->manager = $manager;
	}

	public function adapter()
	{
		return new Employee(
			$this->manager->manager_name, 
			$this->manager->net_salary, 
			$this->manager->subtract, 
			$this->manager->bonus
		);
	}
}


/**
 * calculate the employee salary
 */
class CalcSalary
{
	private $employee;

	public function __construct(Employee $employee)
	{
		$this->employee = $employee;
	}

	public function calculate()
	{
		return $this->employee->base_salary + $this->employee->incentive - $this->employee->deduction;
	}
}


/**
 * Employee Class
 */
class Employee
{
	public $name;
	public $base_salary;
	public $deduction;
	public $incentive;
	
	function __construct(string $name, float $base_salary, float $deduction, float $incentive)
	{
		$this->name = $name;
		$this->base_salary = $base_salary;
		$this->deduction = $deduction;
		$this->incentive = $incentive;
	}
}

/**
 * Manager Class
 */
class Manager
{
	public $manager_name;
	public $net_salary;
	public $subtract;
	public $bonus;
	
	public function __construct(string $manager_name, float $net_salary, float $subtract, float $bonus)
	{
		$this->manager_name = $manager_name;
		$this->net_salary = $net_salary;
		$this->subtract = $subtract;
		$this->bonus = $bonus;
	}
}



// Calc Salary for the employee
$employee = new Employee("Ahmed", 3400, 200, 1000);
$salary = (new CalcSalary($employee))->calculate();
echo "Employee Salary is : " . $salary;

echo "\n =================== \n";

// Calc Salary for the manager
$manager = new Manager("Taha", 20000, 1200, 3000);

// Call the adapter to convert the manager type to employee
$adaptManager = (new SalaryAdapter($manager))->adapter();

$managerSalary = (new CalcSalary($adaptManager))->calculate();
echo "Manager Salary is : " . $managerSalary;
echo "\n =================== \n";

