<?php

namespace App\Virtual;

use DateTime;
use Illuminate\Support\Facades\File;
use Psy\Util\Json;
use Symfony\Component\Mime\Email;

/**
 * @OA\Schema(
 *      title="login Users response",
 *      description="login Users response body data",
 *      type="object",
 * )
 */
class UsersLoginResponse
{
    /**
     *
     *
     * @OA\Property(
     *      title="data",
     *      description="data of the user login ",
     *     type="array",
     *     property="data",
     *   @OA\Items(type="object",format="object",example={"token":"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0L2FwaS9hdXRoL2xvZ2luIiwiaWF0IjoxNjYxMzc4MzAxLCJleHAiOjE2NjEzODkxMDEsIm5iZiI6MTY2MTM3ODMwMSwianRpIjoiQkpzMFpKZGRqOGY2cWRmTCIsInN1YiI6ImEzYWIxYmE2LTM3ZDctNDc0MC05YjkzLTI5YzQxMDMyMWFmMCIsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.etg7ntNM2aLLuGcwstUb49wFHMY7OEytmhbD5x07s6Y","tokenType":"Bearer","expiresIn":10800,"user":"omar"}),
     * )
     *
     * @var array
     */

    public $data;
}
