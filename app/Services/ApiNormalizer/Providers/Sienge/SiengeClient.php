<?php

namespace App\Services\ApiNormalizer\Providers\Sienge;
use App\Services\ApiNormalizer\Providers\ProviderClientInterface;

class SiengeClient implements ProviderClientInterface
{

    public function __construct()
    {
    }

    public function request($method = '', $url = '', $data = '', $mock = false)
    {
        if ($mock) {
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
        }
    }

}
