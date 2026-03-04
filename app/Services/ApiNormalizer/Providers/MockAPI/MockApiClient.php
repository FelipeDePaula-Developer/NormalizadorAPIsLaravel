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
            switch ($url){
                case "bulk-data-defaulters":
                    return [
                        "data" => [
                            [
                                "companyId" => 9,
                                "clientId" => 9999,
                                "clientName" => "ALVES LOPES FERREIRA",
                                "receivableBillId" => "9999",
                                "issueDate" => "2025-01-01",
                                "documentNumber" => "CT.TESTE2",
                                "costCentersId" => [99999],
                                "units" => "",
                                "receivableBillValue" => 100000.0,
                                "defaulterInstallments" => [
                                    [
                                        "installmentId" => "12",
                                        "conditionType" => "PM",
                                        "dueDate" => "2026-01-01T00:00:00+00:00",
                                        "daysOfDelay" => 19,
                                        "correctedValueWithoutAdditions" => 4347.83,
                                        "proRata" => 0.0,
                                        "interest" => 0.0,
                                        "fine" => 0.0,
                                        "totalAdditions" => 0.0,
                                        "correctedValueWithAdditions" => 4347.83,
                                        "installmentNumber" => "12",
                                        "installmentSentToSPCSerasa" => "N"
                                    ],
                                    [
                                        "installmentId" => "13",
                                        "conditionType" => "PM",
                                        "dueDate" => "2026-01-01T00:00:00+00:00",
                                        "daysOfDelay" => 19,
                                        "correctedValueWithoutAdditions" => 4347.83,
                                        "proRata" => 0.0,
                                        "interest" => 0.0,
                                        "fine" => 0.0,
                                        "totalAdditions" => 0.0,
                                        "correctedValueWithAdditions" => 4347.83,
                                        "installmentNumber" => "12",
                                        "installmentSentToSPCSerasa" => "N"
                                    ],
                                ],
                                "defaulterJudicialActivities" => []
                            ],
                            [
                                "companyId" => 9,
                                "clientId" => 9999,
                                "clientName" => "Felipe",
                                "receivableBillId" => "9999",
                                "issueDate" => "2025-01-01",
                                "documentNumber" => "CT.TESTE2",
                                "costCentersId" => [9999],
                                "units" => "",
                                "receivableBillValue" => 1000100.0,
                                "defaulterInstallments" => [
                                    [
                                        "installmentId" => "16",
                                        "conditionType" => "PM",
                                        "dueDate" => "2026-01-01T00:00:00+00:00",
                                        "daysOfDelay" => 19,
                                        "correctedValueWithoutAdditions" => 43427.83,
                                        "proRata" => 0.0,
                                        "interest" => 0.0,
                                        "fine" => 0.0,
                                        "totalAdditions" => 0.0,
                                        "correctedValueWithAdditions" => 43347.83,
                                        "installmentNumber" => "12",
                                        "installmentSentToSPCSerasa" => "N"
                                    ],
                                    [
                                        "installmentId" => "20",
                                        "conditionType" => "PM",
                                        "dueDate" => "2026-01-01T00:00:00+00:00",
                                        "daysOfDelay" => 19,
                                        "correctedValueWithoutAdditions" => 43347.83,
                                        "proRata" => 0.0,
                                        "interest" => 0.0,
                                        "fine" => 0.0,
                                        "totalAdditions" => 0.0,
                                        "correctedValueWithAdditions" => 43547.83,
                                        "installmentNumber" => "12",
                                        "installmentSentToSPCSerasa" => "N"
                                    ],
                                ],
                                "defaulterJudicialActivities" => []
                            ]
                        ]
                    ];
                    break;
                default:
                    return [
                        "data" => [
                            [
                                "billReceivableId"          => 987654321,
                                "company"                   => [
                                    "id"   => 10,
                                    "name" => "Construtora Aurora S.A."
                                ],
                                "costCenter"                => [
                                    "id"   => 55,
                                    "name" => "Residencial Nivalis - Torre A"
                                ],
                                "customer"                  => [
                                    "id"       => 12345,
                                    "name"     => "Felipe de Paula",
                                    "document" => "123.456.789-00",
                                    "email"    => "felipe@example.com"
                                ],
                                "emissionDate"              => "2025-03-10",
                                "lastRenegotiationDate"     => "2025-08-05",
                                "correctionDate"            => "2026-01-31",
                                "document"                  => "CTR.00001234",
                                "privateArea"               => 68.75,
                                "oldestInstallmentDate"     => "2025-06-10",
                                "revokedBillReceivableDate" => null,
                                "units"                     => [
                                    [
                                        "description" => "Unidade",
                                        "id"          => 701,
                                        "name"        => "Apto 1204 - Bloco A"
                                    ],
                                    [
                                        "description" => "Garagem",
                                        "id"          => 702,
                                        "name"        => "Vaga G-18"
                                    ]
                                ],
                                "installments"              => [
                                    [
                                        "id"                         => 1,
                                        "annualCorrection"           => false,
                                        "sentToScripturalCharge"     => true,
                                        "paymentTerms"               => [
                                            "id"          => 651,
                                            "name"        => "1/12 Mensal",
                                            "description" => "Pagamento em 12 parcelas mensais"
                                        ],
                                        "baseDate"                   => "2025-03-01",
                                        "originalValue"              => 980.5,
                                        "dueDate"                    => "2025-06-10",
                                        "indexerId"                  => 3,
                                        "calculationDate"            => "2026-01-15",
                                        "currentBalance"             => 1120.85,
                                        "currentBalanceWithAddition" => 1188.32,
                                        "generatedBillet"            => true,
                                        "installmentSituation"       => "0",
                                        "installmentNumber"          => "1/12",
                                        "receipts"                   => [
                                            [
                                                "id"             => 50001,
                                                "receiptDate"    => "2025-06-20",
                                                "paidValue"      => 300,
                                                "discountValue"  => 0,
                                                "interestValue"  => 12.35,
                                                "fineValue"      => 5,
                                                "paymentMethod"  => "BILLET",
                                                "documentNumber" => "BOL.2025.0007781"
                                            ]
                                        ]
                                    ],
                                    [
                                        "id"                         => 2,
                                        "annualCorrection"           => false,
                                        "sentToScripturalCharge"     => true,
                                        "paymentTerms"               => [
                                            "id"          => 651,
                                            "name"        => "1/12 Mensal",
                                            "description" => "Pagamento em 12 parcelas mensais"
                                        ],
                                        "baseDate"                   => "2025-03-01",
                                        "originalValue"              => 980.5,
                                        "dueDate"                    => "2025-07-10",
                                        "indexerId"                  => 3,
                                        "calculationDate"            => "2026-01-15",
                                        "currentBalance"             => 0,
                                        "currentBalanceWithAddition" => 0,
                                        "generatedBillet"            => true,
                                        "installmentSituation"       => "2",
                                        "installmentNumber"          => "2/12",
                                        "receipts"                   => [
                                            [
                                                "id"             => 50002,
                                                "receiptDate"    => "2025-07-08",
                                                "paidValue"      => 980.5,
                                                "discountValue"  => 0,
                                                "interestValue"  => 0,
                                                "fineValue"      => 0,
                                                "paymentMethod"  => "PIX",
                                                "documentNumber" => "PIX.2025.0000459"
                                            ]
                                        ]
                                    ],
                                    [
                                        "id"                         => 3,
                                        "annualCorrection"           => true,
                                        "sentToScripturalCharge"     => false,
                                        "paymentTerms"               => [
                                            "id"          => 651,
                                            "name"        => "1/12 Mensal",
                                            "description" => "Pagamento em 12 parcelas mensais"
                                        ],
                                        "baseDate"                   => "2026-01-01",
                                        "originalValue"              => 980.5,
                                        "dueDate"                    => "2025-08-10",
                                        "indexerId"                  => 3,
                                        "calculationDate"            => "2026-01-15",
                                        "currentBalance"             => 980.5,
                                        "currentBalanceWithAddition" => 1035.9,
                                        "generatedBillet"            => false,
                                        "installmentSituation"       => "1",
                                        "installmentNumber"          => "3/12",
                                        "receipts"                   => [
                                            [
                                                "id"             => 50003,
                                                "receiptDate"    => "2025-08-25",
                                                "paidValue"      => 500,
                                                "discountValue"  => 0,
                                                "interestValue"  => 18,
                                                "fineValue"      => 7.5,
                                                "paymentMethod"  => "CASHIER",
                                                "documentNumber" => "CX.2025.0009002"
                                            ]
                                        ]
                                    ]
                                ]
                            ],
                            [
                                "billReceivableId"          => 987654322,
                                "company"                   => [
                                    "id"   => 10,
                                    "name" => "Construtora Aurora S.A."
                                ],
                                "costCenter"                => [
                                    "id"   => 56,
                                    "name" => "Residencial Nivalis - Torre B"
                                ],
                                "customer"                  => [
                                    "id"       => 12346,
                                    "name"     => "Maria Souza",
                                    "document" => "12.345.678/0001-90",
                                    "email"    => "maria@empresa.com"
                                ],
                                "emissionDate"              => "2024-11-12",
                                "lastRenegotiationDate"     => null,
                                "correctionDate"            => "2026-01-31",
                                "document"                  => "CTR.00004567",
                                "privateArea"               => 55.2,
                                "oldestInstallmentDate"     => "2024-12-12",
                                "revokedBillReceivableDate" => "2025-09-01",
                                "units"                     => [
                                    [
                                        "description" => "Unidade",
                                        "id"          => 880,
                                        "name"        => "Sala 305 - Torre B"
                                    ]
                                ],
                                "installments"              => [
                                    [
                                        "id"                         => 1,
                                        "annualCorrection"           => false,
                                        "sentToScripturalCharge"     => false,
                                        "paymentTerms"               => [
                                            "id"          => 700,
                                            "name"        => "À vista",
                                            "description" => "Pagamento único"
                                        ],
                                        "baseDate"                   => "2024-11-01",
                                        "originalValue"              => 3500,
                                        "dueDate"                    => "2024-12-12",
                                        "indexerId"                  => 1,
                                        "calculationDate"            => "2025-01-05",
                                        "currentBalance"             => 0,
                                        "currentBalanceWithAddition" => 0,
                                        "generatedBillet"            => true,
                                        "installmentSituation"       => "2",
                                        "installmentNumber"          => "1/1",
                                        "receipts"                   => [
                                            [
                                                "id"             => 60001,
                                                "receiptDate"    => "2024-12-10",
                                                "paidValue"      => 3500,
                                                "discountValue"  => 100,
                                                "interestValue"  => 0,
                                                "fineValue"      => 0,
                                                "paymentMethod"  => "BILLET",
                                                "documentNumber" => "BOL.2024.0032100"
                                            ]
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    ];
                    break;
            }
        }
    }

}
