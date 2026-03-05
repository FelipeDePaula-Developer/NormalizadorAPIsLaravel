<?php

namespace App\Services\ApiNormalizer\Providers\MockAPI;

use App\Services\ApiNormalizer\Providers\ProviderClientInterface;

class MockAPIClient implements ProviderClientInterface
{

    public function __construct()
    {
    }

    public function request($method = '', $url = '', $data = '', $mock = false)
    {
        if ($mock) {
            switch ($url) {
                case "bulk-data-clients":
                    return [
                        "data" => [
                            [
                                "companyId" => 9,
                                "clientId" => 9999,
                                "clientCode" => "9999",
                                "clientName" => "ALVES LOPES FERREIRA",
                                "personType" => "PF",
                                "document" => "12345678909",
                                "contacts" => [
                                    "email" => "alves.lopes@example.com",
                                    "phones" => [
                                       0 => [ "tel" => "+55 11 99999-9999"],
                                       1 => [ "tel" => "+55 11 88888-8888"],
                                    ]
                                ],
                                "birthDate" => "1990-01-01",
                                "createdAt" => "2025-01-01",
                                "status" => "ATIVO",
                                "address" => [
                                    "street" => "Rua Exemplo",
                                    "number" => "123",
                                    "complement" => null,
                                    "location" => [
                                        "district" => "Centro",
                                        "city" => "São Paulo",
                                        "state" => "SP",
                                        "zipCode" => "01000-000",
                                        "geo" => [
                                            "lat" => -23.5505,
                                            "lng" => -46.6333
                                        ]
                                    ]
                                ],
                                "tags" => ["inadimplente", "vip"],
                                "metadata" => [
                                    "source" => "mockAPI",
                                    "audit" => [
                                        "createdBy" => "system",
                                        "notes" => "Cliente criado a partir de dados do mock de defaulters."
                                    ]
                                ]
                            ],
                            [
                                "companyId" => 9,
                                "clientId" => 9998,
                                "clientCode" => "9998",
                                "clientName" => "Felipe",
                                "personType" => "PF",
                                "document" => "98765432100",
                                "contacts" => [
                                    "email" => "felipe@example.com",
                                    "phones" => [
                                        "primary" => "+55 11 98888-8888",
                                        "secondary" => null
                                    ]
                                ],
                                "birthDate" => "1995-05-10",
                                "createdAt" => "2025-01-01",
                                "status" => "ATIVO",
                                "address" => [
                                    "street" => "Av. Teste",
                                    "number" => "999",
                                    "complement" => "Apto 12",
                                    "location" => [
                                        "district" => "Jardins",
                                        "city" => "São Paulo",
                                        "state" => "SP",
                                        "zipCode" => "01400-000",
                                        "geo" => [
                                            "lat" => -23.5614,
                                            "lng" => -46.6559
                                        ]
                                    ]
                                ],
                                "tags" => [],
                                "metadata" => [
                                    "source" => "mockAPI",
                                    "audit" => [
                                        "createdBy" => "system",
                                        "notes" => "Cliente criado a partir de dados do mock de defaulters."
                                    ]
                                ]
                            ]
                        ]
                    ];
                    break;
                default:
                    return [];
                    break;
            }
        }
    }

}
