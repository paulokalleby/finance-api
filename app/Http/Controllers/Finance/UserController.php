<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $user;

    public function __construct(UserService $user)
    {
        $this->user = $user;
    }

    /**
     * @OA\Get(
     *     tags={"Users"},
     *     path="/users",
     *     summary="Obter todos os usuários",
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *          name="paginate", in="query", description="Quantidade de dados por página",
     *          @OA\Schema(type="int")
     *     ),
     *     @OA\Parameter(
     *          name="name", in="query", description="Filtrar usuário pelo nome",
     *          @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *          name="email", in="query", description="Filtrar usuário pelo email",
     *          @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *          name="active", in="query", description="Filtrar usuários ativos ou inativos",
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
        return UserResource::collection(
            $this->user->getAllUsers(
                (array) $request->all()
            )
        );
    }

    /**
     * @OA\Post(
     *     tags={"Users"},
     *     path="/users",
     *     summary="Armazenar novo recurso no banco de dados",
     *     security={{"bearerAuth": {}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="name", type="string"),
     *              @OA\Property(property="email", type="string"),
     *              @OA\Property(property="password", type="string"),
     *              @OA\Property(property="active", type="bool"),
     *              @OA\Property(
     *                  property="roles",
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
    public function store(UserRequest $request)
    {
        return new UserResource(
            $this->user->createUser(
                (array) $request->validated()
            )
        );
    }

    /**
     * @OA\Get(
     *     tags={"Users"},
     *     path="/users/{id}",
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
        return new UserResource(
            $this->user->findUserById($id)
        );
    }

    /**
     * @OA\Put(
     *     tags={"Users"},
     *     path="/users/{id}",
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
     *              @OA\Property(property="email", type="string"),
     *              @OA\Property(property="active", type="bool"),
     *              @OA\Property(
     *                  property="roles",
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
    public function update(UserRequest $request, string $id)
    {
        return $this->user->updateUser(
            (array) $request->validated(),
            $id
        );
    }

    /**
     * @OA\Delete(
     *     tags={"Users"},
     *     path="/users/{id}",
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
        return $this->user->deleteUser($id);
    }
}
