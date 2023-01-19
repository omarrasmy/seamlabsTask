<?php

namespace App\Http\Controllers;

use App\Http\ResponseTrait;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller as BaseController;
/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="seamLabs OpenAPI Documentation",
 *      description="This is auto generated documentation documentation",
 *      @OA\Contact(
 *          email="omarrasmy99@gmail.com"
 *      ),
 *      @OA\License(
 *          name="'Apache' 2.0",
 *          url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *      )
 * )
 *
 * @OA\Server(
 *      url=L5_SWAGGER_CONST_HOST,
 *      description="Development API Server"
 * )
 *
 * @OA\PathItem(path="/docs")
 *
 * @OA\Tag(
 *     name="Auth",
 *     description="API Endpoints of Authentication"
 * )
 */


abstract class Controller extends BaseController
{
    use AuthorizesRequests;
    use ResponseTrait;

    /**
     * Get the map of resource methods to ability names.
     *
     * @return array
     */
    protected function resourceAbilityMap()
    {
        return [
            'index'   => 'viewAny',
            'show'    => 'view',
            'create'  => 'create',
            'store'   => 'create',
            'edit'    => 'update',
            'update'  => 'update',
            'destroy' => 'delete',
        ];
    }
}
