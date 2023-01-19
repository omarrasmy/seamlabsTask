<?php

namespace App\Http\Controllers;

use App\Contracts\UserRepository;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

/**
 *   ,@OAS\SecurityScheme(
securityScheme="bearerAuth",
type="http",
scheme="bearer"
),
 */
class UserController extends Controller
{
    public function __construct(private UserRepository $userRepository)
    {
        $this->resourceItem = UserResource::class;
        $this->resourceCollection = UserCollection::class;
//        $this->authorizeResource(User::class);
    }
    /**
     * @OA\Get(
     *      path="/api/users",
     *      operationId="usersLists",
     *      tags={"Users"},
     *      summary="list Users",
     *      description="Returns Users data",
     *      security={{"bearerAuth":{}}},
     * @OA\Parameter(
     *         name="filter[query]",
     *         in="query",
     *         description="search Backoffic",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *@OA\Parameter(
     *         name="filter[date_of_birth]",
     *         in="query",
     *         description="search Backoffic",
     *         @OA\Schema(
     *             type="date"
     *         )
     *     ),
     *
     *      @OA\Parameter(
     *         name="sortDirection",
     *         in="query",
     *         description="sort asc or desc",
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *      @OA\Parameter(
     *         name="limit",
     *         in="query",
     *         description="number of returned property",
     *         @OA\Schema(
     *             type="integer",
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="page number of returned property",
     *         @OA\Schema(
     *             type="integer",
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/UsersListResponse"),
     *     ),
     *      @OA\Response(
     *          response=422,
     *          description="validation Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */
    public function index()
    {
        $users=$this->userRepository->findByFilters();
        return $users;
    }

    /**
     * @OA\Get(
     *      path="/api/me",
     *      operationId="usersShowMe",
     *      tags={"Users"},
     *      summary="list Users",
     *      description="Returns Users data",
     *      security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/UsersSingleResponse"),
     *     ),
     *      @OA\Response(
     *          response=422,
     *          description="validation Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */
    public function profile(Request $request)
    {
        $user = $request->user();
        return $this->show($request, $user);
    }

    /**
     * @OA\Get(
     *      path="/api/users/{id}",
     *      operationId="usersShow",
     *      tags={"Users"},
     *      summary="list Users",
     *      description="Returns Users data",
     *      security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="The id of User Must be UUID",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     * ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/UsersSingleResponse"),
     *     ),
     *      @OA\Response(
     *          response=422,
     *          description="validation Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */
    public function show(Request $request, User $user)
    {
        $org_admin=$request->user;
        $allowedIncludes = [
            'loginhistories',
            'authorizeddevices',
            'notifications',
            'unreadnotifications',
        ];

        if ($request->has('include')) {
            $with = array_intersect($allowedIncludes, explode(',', strtolower($request->get('include'))));

            $cacheTag = 'users';
            $cacheKey = implode($with) . $user->id;

            $user = Cache::tags($cacheTag)->remember($cacheKey, now()->addHour(), function () use ($with, $user) {
                return $user->load($with);
            });
        }
        return response($user,200);
    }
    /**
     * @OA\Put(
     *      path="/api/me",
     *      operationId="UpdateMe",
     *      tags={"Users"},
     *      summary="add Users",
     *      description="Returns Users data",
     *      security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *              ref="#/components/schemas/UsersUpdateRequest"
     *                 ),
     *
     *    ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/Users"),
     *     ),
     *      @OA\Response(
     *          response=422,
     *          description="validation Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * ),
     */
    public function updateMe(UserUpdateRequest $request): UserResource
    {
        $user = $request->user();
        return $this->update($request, $user);
    }

    /**
     * @OA\Put(
     *      path="/api/users/{id}",
     *      operationId="UpdateUser",
     *      tags={"Users"},
     *      summary="add Users",
     *      description="Returns Users data",
     *      security={{"bearerAuth":{}}},
     *      @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="The id of User Must be UUID",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     * ),
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *              ref="#/components/schemas/UsersUpdateRequest"
     *                 ),
     *
     *    ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/Users"),
     *     ),
     *      @OA\Response(
     *          response=422,
     *          description="validation Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * ),
     */
    public function update(UserUpdateRequest $request, User $user): UserResource
    {
        $data = $request->validated();
        $response = $this->userRepository->update($user, $data);

        return $this->respondWithItem($response);
    }

    /**
     * Update password of logged user.
     */
//    public function updatePassword(PasswordUpdateRequest $request): UserResource
//    {
//        $user = $request->user();
//        $data = $request->only(['password']);
//
//        $response = $this->userRepository->update($user, $data);
//
//        return $this->respondWithItem($response);
//    }


    /**
     * @OA\Delete(
     *      path="/api/users/{id}",
     *      operationId="deleteUsers",
     *      tags={"Users"},
     *      summary="delete Users",
     *      security={{"bearerAuth":{}}},
     *
     *    @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="The id of User Must be UUID",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     * ),
     *     @OA\Response(
     *         response=200,
     *         description="successful deleted",
     *         @OA\JsonContent(),
     *     ),
     *      @OA\Response(
     *          response=422,
     *          description="validation Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */

    public function destroy(Request $request,User $user){
        $user->delete();
        return response(["message"=>'user deleted successfully'],200);
    }
}
