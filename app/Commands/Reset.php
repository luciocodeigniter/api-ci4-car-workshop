<?php

namespace App\Commands;

use App\Database\Seeds\Address;
use App\Database\Seeds\Car;
use App\Database\Seeds\Customer;
use App\Database\Seeds\Employee;
use App\Database\Seeds\Service;
use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class Reset extends BaseCommand
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
    protected $name = 'api:reset';

    /**
     * The Command's Description
     *
     * @var string
     */
    protected $description = 'Recreate the tables and seed the database with Customers, Cars, Address, Employees and Services';

    /**
     * The Command's Usage
     *
     * @var string
     */
    protected $usage = 'api:reset';

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
            
            command('migrate:rollback -b 0');
            command('api:init');

        } catch (\Exception $e) {
            $this->showError($e);
        }
    }
}
