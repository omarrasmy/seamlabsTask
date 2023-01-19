<?php


namespace App\Services;

use App\Contracts\UserRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;

class RegisterService
{

    public function __construct(private UserRepository $userRepository)
    {
    }

    /**
     * Create a new user instance after a valid registration.
     */
    protected function create(array $data): Model
    {
        return $this->userRepository->store([
            'email'                       => $data['email'],
            'name'                        => $data['name'],
            'email_token_confirmation'    => Uuid::uuid4()->toString(),
            'email_token_disable_account' => Uuid::uuid4()->toString(),
            'password'                    => bcrypt($data['password']),
            'is_active'                   => 1,
            'email_verified_at'           => null,
            'locale'                      => $data['locale'] ?? 'en_US',
            'date_of_birth'               => $data['date_of_birth'],
            'phone'                       => $data['phone']
        ]);
    }
    /**
     * Handle a registration validate for the application.
     *
     * @param  \Illuminate\Http\Request  $validate
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function register($validate)
    {
        $user = $this->create($validate);
//        if(isset($validate['role']))
//            $user->assignRole($validate['role']);
        $this->guard()->login($user);
        return $user;
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }

}
