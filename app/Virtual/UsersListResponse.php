<?php

namespace App\Virtual;

use DateTime;
use Illuminate\Support\Facades\File;
use Psy\Util\Json;
/**
 * @OA\Schema(
 *      title="get user response",
 *      description="get user ",
 *      type="object",
 * )
 */
class UsersListResponse
{

    /**
     *
     *
     * @OA\Property(
     *      title="data",
     *      description="data of the categories ",
     *     type="array",
     *     property="data",
     *   @OA\Items(type="object",format="object",example={"id":1,"name":"omarrasmy","date_of_birth":"12-2-2023","phone":"013213123","email":"omarrasmy@gmail.com"}),
     * )
     *
     * @var array
     */
    public $data;

}
