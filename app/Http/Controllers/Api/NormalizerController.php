<?php

namespace App\Http\Controllers\Api;

use App\Services\ApiNormalizer\Adapters\Loader\JsonContractLoader;
use App\Services\ApiNormalizer\Adapters\Normalizer;
use App\Services\ApiNormalizer\ApiNormalizerService;
use App\Services\ApiNormalizer\Providers\MockAPI\MockAPIClient;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class NormalizerController extends Controller
{
    public function parcelas (Request $request)
    {
        $loader = new JsonContractLoader();
        $normalizer = new Normalizer();

        $service = new ApiNormalizerService(
            $loader,
            $normalizer,
            [
                'mockAPI' => new MockAPIClient(),
            ]
        );

        $contractFile = base_path() . '\app\Services\ApiNormalizer\Providers\MockAPI\Schemas\clientes.json';

        $result = $service->fetch('mockAPI', $contractFile, [
            'companyId' => 1,
        ]);

        return response()->json($result);
    }

    public function parcelas_pagas (Request $request)
    {
        $loader = new JsonContractLoader();
        $normalizer = new Normalizer();

        $service = new ApiNormalizerService(
            $loader,
            $normalizer,
            [
                'mockAPI' => new MockAPIClient(),
            ]
        );

        $contractFile = base_path() . '\app\Services\ApiNormalizer\Providers\MockAPI\Schemas\parcelas-pagas.yml';

        $result = $service->fetch('mockAPI', $contractFile, [
            'companyId' => 1,
        ]);

        return response()->json($result);
    }
}
