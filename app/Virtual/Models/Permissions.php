<?php

namespace App\Virtual\Models;

use Psy\Util\Json;

/**
 * @OA\Schema(
 *     title="Permission",
 *     description="Permission model",
 *     @OA\Xml(
 *         name="Permission"
 *     )
 * )
 */
class Permissions
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
     *      description="name of the permission",
     *      example="addPermission.participants.create",
     *     property="name"
     *
     * )
     *
     * @var Json
     */
    public $name;
    /**
     * @OA\Property(
     *      title="guard_name",
     *      description="guard_name of the permission",
     *      example="api",
     *     property="guard_name"
     *
     * )
     *
     * @var Json
     */
    public $guard_name;


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
