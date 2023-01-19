<?php

namespace App\Virtual;
use Psy\Util\Json;

/**
 * @OA\Schema(
 *      title="single users response",
 *      description="single users response",
 *      type="object",
 * )
 */
class UsersSingleResponse
{

    /**
     * @OA\Property(
     *     title="ID",
     *     description="ID",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
    private $id;

    /**
     * @OA\Property(
     *      title="name",
     *      description="email of the user",
     *      example="omarrasmy",
     *     property="name"
     *
     * )
     *
     * @var Json
     */
    public $name;
    /**
     * @OA\Property(
     *      title="email",
     *      description="email of the user",
     *      example="omarrasmy@gmail.com",
     *     property="email"
     *
     * )
     *
     * @var Json
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


    /**
     * @OA\Property(
     *     title="Created at",
     *     description="Created at",
     *     example="2020-01-27 17:50:45",
     *     format="datetime",
     *     type="string",
     *     property="created_at"
     * )
     *
     * @var \DateTime
     */
    private $created_at;

    /**
     * @OA\Property(
     *     title="Updated at",
     *     description="Updated at",
     *     example="2020-01-27 17:50:45",
     *     format="datetime",
     *     type="string",
     *     property="updated_at"
     * )
     *
     * @var \DateTime
     */
    private $updated_at;

}
