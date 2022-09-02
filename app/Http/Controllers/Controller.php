<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="COMMENT API Documentation",
 *      description="Laravel API Documentation",
 *      @OA\Contact(
 *          email="patrickbijampola@gmail.com"
 *     ),
 *     @OA\License(
 *         name="MIT",
 *        url="https://opensource.org/licenses/MIT"
 *    )
 * )
 *  @OA\Server(
 *     url=L5_SWAGGER_CONST_HOST,
 *    description="Laravel API Server"
 * )
 * @OA\Tag(
 *    name="comment",
 *   description="API Endpoints of Comment"
 * )
 * @OA\SecurityScheme(
 *    securityScheme="bearerAuth",
 *   type="http",
 *  scheme="bearer",
 * bearerFormat="JWT"
 * )
 */


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
