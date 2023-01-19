<?php

namespace App\Virtual;

use DateTime;
use Illuminate\Support\Facades\File;
use Psy\Util\Json;
/**
 * @OA\Schema(
 *      title="add EducationLevels request",
 *      description="add EducationLevels request body data",
 *      type="object",
 *     required={"numbers"}
 * )
 */
class PartOneTaskThree
{

    /**
     * @OA\Property(
     *      title="numbers",
     *      description="numbers of the news project",
     *     property="numbers",
     *
     *    type="array",
     *     @OA\Items(
     *     type="integer",
     *     example=1,
     *              )
     *         )
     * )
     *
     * @var Json
     */
    public $numbers;
}
