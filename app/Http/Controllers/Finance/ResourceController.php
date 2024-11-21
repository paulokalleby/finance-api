<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Http\Resources\ResourceResource;
use App\Services\ResourceService;

class ResourceController extends Controller
{
    protected $resource;

    public function __construct(ResourceService $resource)
    {
        $this->resource = $resource;
    }

    /**
     * @OA\Get(
     *     tags={"Resources"},
     *     path="/resources",
     *     summary="Obter todos os recursos do banco",
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(response=200, description="Sucesso"),
     *     @OA\Response(response="401", description="Não autenticado"),
     *     @OA\Response(response="403", description="Não autorizado"),
     *     @OA\Response(response="500", description="Erro interno"),
     * )
     */
    public function index()
    {
        return ResourceResource::collection(
            $this->resource->getAllResources()
        );
    }
}
