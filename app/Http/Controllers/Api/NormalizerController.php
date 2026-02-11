<?php

namespace App\Http\Controllers\Api;

use App\Services\ApiNormalizer\Adapters\Loader\YamlContractLoader;
use App\Services\ApiNormalizer\Adapters\Normalizer;
use App\Services\ApiNormalizer\ApiNormalizerService;
use App\Services\ApiNormalizer\Providers\Sienge\SiengeClient;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class NormalizerController extends Controller
{
    public function parcelas (Request $request)
    {
        $loader = new YamlContractLoader();
        $normalizer = new Normalizer();

        $service = new ApiNormalizerService(
            $loader,
            $normalizer,
            [
                'sienge' => new SiengeClient(),
            ]
        );

        $contractFile = base_path() . '\app\Services\ApiNormalizer\Providers\Sienge\Schemas\Parcelas.yml';

        $result = $service->fetch('sienge', $contractFile, [
            'companyId' => 1,
        ]);

        return response()->json($result);
    }
}
