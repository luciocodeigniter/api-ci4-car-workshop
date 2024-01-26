<?php

namespace App\Database\Seeds;

use App\Entities\Service as ServiceEntity;
use App\Models\EmployeeModel;
use App\Models\ServiceModel;
use CodeIgniter\CLI\CLI;
use CodeIgniter\Database\Seeder;

class Service extends Seeder
{

    /**
     * How many records do you want to create
     */
    private const TOTAL_STEPS = 100;

    public function run()
    {

        $services = $this->getServices();

        model(ServiceModel::class)->insertBatch($services);

        // Done, so erase it...
        CLI::showProgress(false);

        echo count($services) . " services created" . PHP_EOL;
    }

    private function getPrice(): string
    {

        $price = mt_rand(10, 1000);
        return str_replace(',', '', number_format($price, 2, '.', ','));
    }

    private function getServices(): array
    {

        $faker = (new \Faker\Factory())::create();
        $faker->addProvider(new \Faker\Provider\en_US\Company($faker));


        $servicesContainer = [];

        $currStep   = 1;

        for ($i = 0; $i < self::TOTAL_STEPS; $i++) {

            CLI::showProgress($currStep++, self::TOTAL_STEPS); //! mostramos um progresso para orientar o usuário

            $price = number_format(mt_rand(1, 1000) / 100, 2, ',', '.');
            $price =

                $service = new ServiceEntity();
            $service->name  = $faker->bs(); //! isso me dá algumas palavra
            $service->price = $this->getPrice();

            $servicesContainer[] = $service;
        }


        return $servicesContainer;
    }
}
