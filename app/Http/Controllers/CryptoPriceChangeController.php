<?php

namespace App\Http\Controllers;

use App\Models\PriceChangeModel;
use App\Repositories\PriceChangeApiRepository;
use App\Services\Validator\Rules\GreaterThan;
use App\Services\Validator\ValidatorService;
use App\Services\ValidatorAssets\CryptoDataRulesAsset;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CryptoPriceChangeController extends Controller
{
    private PriceChangeApiRepository $repository;
    private ValidatorService $validatorService;
    
    public function __construct(PriceChangeApiRepository $repository, ValidatorService $validatorService)
    {
        $this->repository = $repository;
        $this->validatorService = $validatorService;
    }

    public function index(Request $request): JsonResponse
    {
        try {
            $limit = $request->query('limit');
            $limit = (new GreaterThan(0))->validate($limit) ? $limit : null;
            $offset = $request->query('offset');
            $offset = (new GreaterThan(0))->validate($offset) ? $offset : 0;

            $result = array_map(
                function (PriceChangeModel $model) { return$model->toArray(); },
                $this->repository->getAll($limit, $offset)
            );

            return response()->json($result);
        } catch (\Throwable $throwable) {
             Log::error('crypto_data_not_received', ['error' => $throwable->__toString()]);

            return response()->json('crypto_data_not_received', 500);
        }
    }

    public function show(string $name): JsonResponse
    {
        try {
            $result = $this->repository->getByName($name);
            if (!$result) {
                return response()->json('crypto_data_not_found', 404);
            }

            return response()->json($result->toArray());
        } catch (\Throwable $throwable) {
            Log::error('crypto_data_not_received', ['error' => $throwable->__toString()]);

            return response()->json('crypto_data_not_received', 500);
        }
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $data = $request->post();
            $errors = $this->validatorService->validate((new CryptoDataRulesAsset())->getRules(), $data);
            if ($errors) {
                return response()->json($errors, 400);
            }
            $result = $this->repository->create($data);

            return response()->json($result->toArray());
        } catch (\Throwable $throwable) {
            Log::error('crypto_data_not_created', ['error' => $throwable->__toString()]);

            return response()->json('', 500);
        }
    }

    public function update(Request $request, string $name): JsonResponse
    {
        try {
            $data = $request->post();
            $errors = $this->validatorService->validate((new CryptoDataRulesAsset())->getRules(), $data);
            if ($errors) {
                return response()->json($errors, 400);
            }

            $result = $this->repository->updateByName($name, $data);
            if (!$result) {
                return response()->json('crypto_data_not_found', 404);
            }

            return response()->json($result->toArray());
        } catch (\Throwable $throwable) {
            Log::error('crypto_data_not_created', ['error' => $throwable->__toString()]);

            return response()->json('crypto_data_not_created', 500);
        }
    }

    public function destroy(string $name): JsonResponse
    {
        try {
            $this->repository->deleteByName($name);

            return response()->json('deleted');
        } catch (\Throwable $throwable) {
            Log::error('crypto_data_not_created', ['error' => $throwable->__toString()]);

            return response()->json('crypto_data_not_deleted', 500);
        }
    }
}
