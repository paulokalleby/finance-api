<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Http\Requests\MovimentRequest;
use App\Http\Resources\MovimentResource;
use App\Services\MovimentService;
use Illuminate\Http\Request;

class MovimentController extends Controller
{
    protected $moviment;

    public function __construct(MovimentService $moviment)
    {
        $this->moviment = $moviment;
    }

    /**
     * @OA\Get(
     *     tags={"Moviments"},
     *     path="/moviments",
     *     summary="Obter todos os recursos",
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *          name="paginate", in="query", description="Quantidade de dados por página",
     *          @OA\Schema(type="int")
     *     ),
     *     @OA\Parameter(
     *          name="type", in="query", description="Filtrar recurso pelo type",
     *          @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *          name="category_id", in="query", description="Filtrar recurso pelo id da categoria",
     *          @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *     )
     * )
     */
    public function index(Request $request)
    {
        return MovimentResource::collection(
            $this->moviment->getAllMoviments(
                (array) $request->all()
            )
        );
    }

    /**
     * @OA\Post(
     *     tags={"Moviments"},
     *     path="/moviments",
     *     summary="Armazenar novo recurso no banco de dados",
     *     security={{"bearerAuth": {}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="category_id", type="string"),
     *              @OA\Property(property="description", type="string"),
     *              @OA\Property(property="type", type="string"),
     *              @OA\Property(property="value", type="double"),
     *        )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Created"
     *     )
     * )
     */
    public function store(MovimentRequest $request)
    {
        return new MovimentResource(
            $this->moviment->createMoviment(
                (array) $request->validated()
            )
        );
    }

    /**
     * @OA\Get(
     *     tags={"Moviments"},
     *     path="/moviments/{id}",
     *     summary="Ver um recurso",
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="string", format="char32"),
     *         @OA\Examples(example="uuid", value="0006faf6-7a61-426c-9034-579f2cfcfa83", summary="UUID value."),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK"
     *     )
     * )
     */
    public function show(string $id)
    {
        return new MovimentResource(
            $this->moviment->findMovimentById($id)
        );
    }

    /**
     * @OA\Put(
     *     tags={"Moviments"},
     *     path="/moviments/{id}",
     *     summary="Atualizar um recurso no banco de dados",
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="string", format="char32"),
     *         @OA\Examples(example="uuid", value="0006faf6-7a61-426c-9034-579f2cfcfa83", summary="UUID value."),
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="category_id", type="string"),
     *              @OA\Property(property="description", type="string"),
     *              @OA\Property(property="type", type="string"),
     *              @OA\Property(property="value", type="double"),
     *        )
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="No Content"
     *     )
     * )
     */
    public function update(MovimentRequest $request, string $id)
    {
        return $this->moviment->updateMoviment(
            (array) $request->validated(),
            $id
        );
    }

    /**
     * @OA\Delete(
     *     tags={"Moviments"},
     *     path="/moviments/{id}",
     *     summary="Deletar recurso",
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="string", format="char32"),
     *         @OA\Examples(example="uuid", value="0006faf6-7a61-426c-9034-579f2cfcfa83", summary="UUID value."),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK"
     *     )
     * )
     */
    public function destroy(string $id)
    {
        return $this->moviment->deleteMoviment($id);
    }
}
