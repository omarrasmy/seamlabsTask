<?php

namespace App\Virtual;

use DateTime;
use Illuminate\Support\Facades\File;
use Psy\Util\Json;
/**
 * @OA\Schema(
 *      title="get EducationLevels response",
 *      description="get EducationLevels ",
 *      type="object",
 * )
 */
class PartThree
{

    /**
     *
     *
     * @OA\Property(
     *      title="data",
     *      description="data of the categories ",
     *     type="array",
     *     property="steps",
     *   @OA\Items(type="integer",example=10),
     * )
     *
     * @var array
     */
    public $steps;

}
