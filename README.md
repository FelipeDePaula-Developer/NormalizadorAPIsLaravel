# API Normalizer – Laravel

Serviço desenvolvido em Laravel responsável por consumir múltiplas APIs externas com formatos distintos e normalizar as respostas em um padrão único, facilitando integrações com sistemas internos.

O projeto foi pensado com foco em arquitetura limpa, boas práticas e escalabilidade, simulando um cenário real de mercado.

--------------------------------------------------

OBJETIVO DO PROJETO

- Centralizar integrações com APIs externas
- Padronizar respostas de diferentes fontes
- Reduzir acoplamento entre sistemas e fornecedores externos
- Facilitar manutenção, testes e evolução da aplicação

--------------------------------------------------

CONCEITOS E PADRÕES UTILIZADOS

- Adapter Pattern para encapsular diferenças entre APIs
- Service Layer para regras de negócio
- DTOs (Data Transfer Objects) para saída normalizada
- Interfaces e contratos para desacoplamento
- HTTP Client do Laravel
- Tratamento de erros e exceções
- Cache para otimização de performance
- Autenticação via API Token (Sanctum)

--------------------------------------------------

ESTRUTURA DO PROJETO

app/
├── Services/
│    └── ApiNormalizer/
│         ├── Contracts/
│         ├── Adapters/
│         ├── DTOs/
│         └── ApiNormalizerService.php
├── Http/
│    └── Controllers/
│         └── Api/
│              └── NormalizeController.php

--------------------------------------------------

APIS INTEGRADAS

Atualmente o projeto conta com integrações de exemplo com:

- API A (exemplo)
- API B (exemplo)

Cada integração possui seu próprio Adapter, garantindo isolamento e facilidade de substituição.

--------------------------------------------------

EXEMPLO DE RESPOSTA NORMALIZADA

{
"id": "123",
"name": "Produto X",
"price": 99.90,
"currency": "BRL",
"available": true,
"source": "api_a"
}

--------------------------------------------------

AUTENTICAÇÃO

A API utiliza Laravel Sanctum para autenticação via token.

Header de exemplo:

Authorization: Bearer {token}

--------------------------------------------------

REQUISITOS

- PHP 8.2+
- Composer
- Laravel 10+
- MySQL ou SQLite

--------------------------------------------------

COMO RODAR O PROJETO

1. Clonar o repositório
   git clone https://github.com/seu-usuario/api-normalizer-laravel.git

2. Acessar a pasta do projeto
   cd api-normalizer-laravel

3. Instalar dependências
   composer install

4. Criar arquivo de ambiente
   cp .env.example .env

5. Gerar chave da aplicação
   php artisan key:generate

6. Rodar migrations
   php artisan migrate

7. Subir servidor
   php artisan serve

--------------------------------------------------

TESTES

O projeto conta com testes unitários e de feature focados na normalização dos dados e nos adapters de API.

Para executar:

php artisan test

--------------------------------------------------

POSSÍVEIS EVOLUÇÕES

- Versionamento da API (v1, v2)
- Processamento assíncrono com filas
- Circuit Breaker
- Observabilidade e métricas
- Dockerização
- Integração com novos provedores

--------------------------------------------------

AUTOR

Desenvolvido por: Seu Nome  
PHP Developer | Laravel | APIs | Arquitetura de Software
