<?php

namespace Contracts\Providers\Sienge;
class SiengeClient
{

    public function __construct()
    {
    }

    public function callAPI($method = '', $url = '', $data = '', $mock = false)
    {
        if ($mock) {
            return [
                "data" => [
                    [
                        "companyId" => 5,
                        "clientId" => 2622,
                        "clientName" => "MELISSA ARCANJO LOPES FERREIRA",
                        "receivableBillId" => "7839",
                        "issueDate" => "2025-01-01",
                        "documentNumber" => "CT.TESTE2",
                        "costCentersId" => [36027],
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
                        "companyId" => 6,
                        "clientId" => 2626,
                        "clientName" => "Felipe",
                        "receivableBillId" => "7839",
                        "issueDate" => "2025-01-01",
                        "documentNumber" => "CT.TESTE2",
                        "costCentersId" => [36029],
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
