<?php

namespace App\Virtual;

use Illuminate\Support\Facades\File;
use Psy\Util\Json;
use Symfony\Component\Mime\Email;

/**
 * @OA\Schema(
 *      title="Update users request",
 *      description="users request body data",
 *      type="object",
 * )
 */
class UsersUpdateRequest
{

    /**
     *
     * @OA\Property(
     *      title="name",
     *      description="name of the user",
     *      example="omar",
     *     type="string",
     *     property="name"

     * )
     *
     * @var string
     */
    public $name;


    /**
     * @OA\Property(
     *   property="password",
     *   type="string",
     *     example="Omar@123"
     *           )
     *
     * @var string
     */
    public $password;

    /**
     * @OA\Property(
     *   property="password_confirmation",
     *   type="string",
     *     example="Omar@123"
     *           )
     *
     * @var string
     */
    public $password_confirmation;

    /**
     * @OA\Property(
     *      title="email",
     *      description="email of the user",
     *      example="omar@gmail.com",
     *     property="email"
     * )
     *
     * @var Email
     */
    public $email;
    /**
     * @OA\Property(
     *      title="date_of_birth",
     *      description="date_of_birth of the user",
     *      example="12-10-2023",
     *     property="date_of_birth",
     *     type="date"
     *
     * )
     *
     * @var Json
     */
    public $date_of_birth;

    /**
     * @OA\Property(
     *      title="phone",
     *      description="phone of the user",
     *      example="01123213123",
     *     property="phone",
     *     type="string"
     *
     * )
     *
     * @var Json
     */
    public $phone;


}
