<?php

declare(strict_types=1);

namespace App\Libraries\Address;

use App\Models\AddressModel;
use App\Models\CustomerModel;

class AddressGetDataService
{

    /**
     * Retrieves paginated records
     *
     * @param integer|null $perPage
     * @param integer|null $page
     * @return array
     */
    public function paginate(?int $perPage = null, ?int $page = null): array
    {

        // Pagina os endereços
        $adresses = model(AddressModel::class)->paginate(perPage: $perPage, page: $page);

        // Verifica se não há endereços
        if (empty($adresses)) {
            return [];
        }

        // Obtém os IDs dos clientes
        $customersIds = array_column($adresses, 'customer_id');

        // Busca todos os clientes associados aos carros em uma única consulta
        $customers = empty($customersIds) ? [] : model(CustomerModel::class)->whereIn('id', $customersIds)->findAll();


        // Cria um índice dos clientes usando seus IDs
        $indexedCustomers = [];
        foreach ($customers as $customer) {
            $indexedCustomers[$customer->id] = $customer;
        }

        // Associa cada endereço ao seu cliente correspondente.
        // se o índice, recebe null
        foreach ($adresses as &$address) {
            $address->customer = $indexedCustomers[$address->customer_id] ?? null;
        }


        return $adresses;
    }
}
