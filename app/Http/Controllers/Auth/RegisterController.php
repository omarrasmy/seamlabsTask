<?php

namespace App\Http\Controllers\Auth;

use App\Contracts\UserRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRequest;
use App\Models\User;
use App\Rules\WeakPasswordRule;
use App\Services\RegisterService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(private RegisterService $registerService)
    {
        $this->middleware('guest');
    }

    /**
     * The user has been registered.
     *
     * @param Request $request
     * @param User    $user
     * @return mixed
     */
    protected function registered(Request $request, User $user)
    {

        $message = __(
            'thank you for register.',
            ['email' => $user->email]
        );

        return $this->respondWithCustomData(['message' => $message], Response::HTTP_CREATED);
    }



    /**
     * @OA\Post(
     *      path="/api/auth/register",
     *      operationId="Register User",
     *      tags={"Auth"},
     *      summary="Register User",
     *      description="Returns Users data",
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *              ref="#/components/schemas/UsersAddRequest"
     *                 ),
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
    public function register(UserCreateRequest $request)
    {
        $validate=$request->validated();
        $user = $this->registerService->register($validate);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 201)
            : redirect($this->redirectPath());
    }

}
