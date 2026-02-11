<?php
namespace App\Services\ApiNormalizer;
use App\Services\ApiNormalizer\Adapters\Loader\YamlContractLoader;
use App\Services\ApiNormalizer\Adapters\Normalizer;
use App\Services\ApiNormalizer\Providers\ProviderClientInterface;

final class ApiNormalizerService
{
    private YamlContractLoader $loader;
    private Normalizer $normalizer;
    /** @var array<string, ProviderClientInterface> */
    private array $providers;

    public function __construct(
        YamlContractLoader $loader,
        Normalizer $normalizer,
        array $providers
    ) {
        $this->providers = $providers;
        $this->normalizer = $normalizer;
        $this->loader = $loader;
    }

    public function fetch(string $providerKey, string $contractFile, array $params = []): array
    {
        if (!isset($this->providers[$providerKey])) {
            throw new \RuntimeException("Provider não registrado: {$providerKey}");
        }

        $endpointContract = $this->loader->load($contractFile);

        $schemaPath = $endpointContract['canonical']['schema'] ?? null;
        if (!$schemaPath) {
            throw new \RuntimeException("Contract sem canonical.schema");
        }
        $schemaPath = base_path().$schemaPath;
        $canonicalSchema = $this->loader->load($schemaPath);
        $method = $endpointContract['method'] ?? 'GET';
        $path   = $endpointContract['path'] ?? '/';

        $raw = $this->providers[$providerKey]->request($method, $path, $params, true);
        return $this->normalizer->normalizeItems($raw, $endpointContract, $canonicalSchema);
    }
}
