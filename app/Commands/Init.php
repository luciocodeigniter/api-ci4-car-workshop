<?php

namespace App\Commands;

use App\Database\Seeds\Address;
use App\Database\Seeds\Car;
use App\Database\Seeds\Customer;
use App\Database\Seeds\Employee;
use App\Database\Seeds\Service;
use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class Init extends BaseCommand
{
    /**
     * The Command's Group
     *
     * @var string
     */
    protected $group = 'Api';

    /**
     * The Command's Name
     *
     * @var string
     */
    protected $name = 'api:init';

    /**
     * The Command's Description
     *
     * @var string
     */
    protected $description = 'Create tables, seed the database with Customers, Cars, Address, Employees and Services';

    /**
     * The Command's Usage
     *
     * @var string
     */
    protected $usage = 'api:init';

    /**
     * The Command's Arguments
     *
     * @var array
     */
    protected $arguments = [];

    /**
     * The Command's Options
     *
     * @var array
     */
    protected $options = [];

    /**
     * Actually execute a command.
     *
     * @param array $params
     */
    public function run(array $params)
    {


        try {

            command('migrate --all');

            $seeder = \Config\Database::seeder();
            $seeder->call(Customer::class);
            $seeder->call(Car::class);
            $seeder->call(Address::class);
            $seeder->call(Service::class);
            $seeder->call(Employee::class);

            

            CLI::write();
            CLI::write('The API is ready to use!', 'blue');
        } catch (\Exception $e) {
            $this->showError($e);
        }
    }
}
