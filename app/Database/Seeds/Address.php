<?php

namespace App\Database\Seeds;

use App\Entities\Address as CustomerAddress;
use App\Models\AddressModel;
use App\Models\CustomerModel;
use CodeIgniter\CLI\CLI;
use CodeIgniter\Database\Seeder;

class Address extends Seeder
{

    /**
     * How many records do you want to create
     */
    private const TOTAL_STEPS = 1000;

    public function run()
    {

        $address = $this->getAddress();

        CLI::write('Creating ' . count($address) . ' addresses. Please, wait.', 'yellow');

        model(AddressModel::class)->insertBatch($address);
        
        // Done, so erase it...
        CLI::showProgress(false);

        CLI::write('=================================================================================', 'white') . PHP_EOL;
    }


    private function getAddress(): array
    {

        $customers = model(CustomerModel::class)->select(['id'])->orderBy('id', 'ASC')->findAll();

        if (empty($customers)) {

            exit('There are no customers to associate with the cars. Make sure the customer table is properly populated.');
        }

        $customersIds = array_column($customers, 'id');

        $adressesContainer = [];

        $currStep   = 1;

        $faker = (new \Faker\Factory())::create();
        $faker->addProvider(new \Faker\Provider\pt_BR\Address($faker));

        for ($i = 0; $i < self::TOTAL_STEPS; $i++) {

            CLI::showProgress($currStep++, self::TOTAL_STEPS); //! mostramos um progresso para orientar o usuário

            $address = new CustomerAddress();
            $address->customer_id  = $customersIds[array_rand($customersIds)];
            $address->country      = $faker->country();
            $address->state        = $faker->state();
            $address->city         = $faker->city();
            $address->street       = $faker->streetAddress();
            $address->neighborhood = $faker->streetAddress(); //! same

            $adressesContainer[] = $address;
        }


        return $adressesContainer;
    }
}
