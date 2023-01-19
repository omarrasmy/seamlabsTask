<?php

namespace App\Virtual;

use Illuminate\Support\Facades\File;
use Psy\Util\Json;
/**
 * @OA\Schema(
 *      title="Update EducationLevels request",
 *      description="EducationLevels request body data",
 *      type="object",
 * )
 */
class PartTwo
{

    /**
     * @OA\Property(
     *      title="description",
     *      description="description of the news project",
     *      example=100,
     *     property="total"
     *
     * )
     *
     * @var Json
     */
    public $total;

}
