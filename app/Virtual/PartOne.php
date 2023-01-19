<?php

namespace App\Virtual;
use Psy\Util\Json;

/**
 * @OA\Schema(
 *      title="single partners response",
 *      description="single partners response",
 *      type="object",
 * )
 */
class PartOne
{
    /**
     * @OA\Property(
     *      title="count",
     *      description="count of items",
     *      example=100,
     *     property="count"
     *
     * )
     *
     * @var Json
     */
    public $count;



}
