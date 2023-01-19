<?php

namespace App\Virtual\Models;

use Psy\Util\Json;

/**
 * @OA\Schema(
 *     title="User",
 *     description="User model",
 *     @OA\Xml(
 *         name="User"
 *     )
 * )
 */
class Users
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
     *     property="date_of_birth"
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
     *      example="012321312",
     *     property="phone"
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
