<?php

namespace App\Database\Seeds;

use App\Entities\Employee as EmployeeEntity;
use App\Models\EmployeeModel;
use CodeIgniter\CLI\CLI;
use CodeIgniter\Database\Seeder;

class Employee extends Seeder
{

    /**
     * How many records do you want to create
     */
    private const TOTAL_STEPS = 100;

    public function run()
    {

        $employees = $this->getEmployees();

        CLI::write('Creating ' . count($employees) . ' employees. Please, wait.', 'yellow');

        model(EmployeeModel::class)->insertBatch($employees);

        // Done, so erase it...
        CLI::showProgress(false);
        CLI::write('=================================================================================', 'white') . PHP_EOL;
    }


    private function getEmployees(): array
    {

        $faker = (new \Faker\Factory())::create();
        $faker->addProvider(new \Faker\Provider\en_US\Person($faker));
        $faker->addProvider(new \Faker\Provider\en_US\Company($faker));


        $employeesContainer = [];

        $currStep   = 1;

        for ($i = 0; $i < self::TOTAL_STEPS; $i++) {

            CLI::showProgress($currStep++, self::TOTAL_STEPS); //! mostramos um progresso para orientar o usuário

            $employee = new EmployeeEntity();
            $employee->name   = "{$faker->name()} {$faker->lastName()}";
            $employee->skills = $faker->bs(); //! isso me dá algumas palavras

            $employeesContainer[] = $employee;
        }


        return $employeesContainer;
    }
}
