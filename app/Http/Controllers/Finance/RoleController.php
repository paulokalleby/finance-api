<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Http\Resources\RoleResource;
use App\Services\RoleService;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    protected $role;

    public function __construct(RoleService $role)
    {
        $this->role = $role;
    }

    /**
     * @OA\Get(
     *     tags={"Roles"},
     *     path="/roles",
     *     summary="Obter todos os papéis",
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *          name="paginate", in="query", description="Quantidade de dados por página",
     *          @OA\Schema(type="int")
     *     ),
     *     @OA\Parameter(
     *          name="name", in="query", description="Filtrar papel pelo nome",
     *          @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *          name="active", in="query", description="Filtrar papels ativos ou inativos",
     *          @OA\Schema(type="bool")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *     )
     * )
     */
    public function index(Request $request)
    {
        return RoleResource::collection(
            $this->role->getAllRoles(
                (array) $request->all()
            )
        );
    }

    /**
     * @OA\Post(
     *     tags={"Roles"},
     *     path="/roles",
     *     summary="Armazenar novo recurso no banco de dados",
     *     security={{"bearerAuth": {}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="name", type="string"),
     *              @OA\Property(property="active", type="bool"),
     *              @OA\Property(
     *                  property="permissions",
     *                  type="array",
     *                  @OA\Items(type="string", format="uuid")
     *              ),
     *        )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Created"
     *     )
     * )
     */
    public function store(RoleRequest $request)
    {
        return new RoleResource(
            $this->role->createRole(
                (array) $request->validated()
            )
        );
    }

    /**
     * @OA\Get(
     *     tags={"Roles"},
     *     path="/roles/{id}",
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
        return new RoleResource(
            $this->role->findRoleById($id)
        );
    }

    /**
     * @OA\Put(
     *     tags={"Roles"},
     *     path="/roles/{id}",
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
     *              @OA\Property(property="name", type="string"),
     *              @OA\Property(property="active", type="bool"),
     *              @OA\Property(
     *                  property="permissions",
     *                  type="array",
     *                  @OA\Items(type="string", format="uuid")
     *              ),
     *        )
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="No Content"
     *     )
     * )
     */
    public function update(RoleRequest $request, string $id)
    {
        return $this->role->updateRole(
            (array) $request->validated(),
            $id
        );
    }

    /**
     * @OA\Delete(
     *     tags={"Roles"},
     *     path="/roles/{id}",
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
        return $this->role->deleteRole($id);
    }
}
