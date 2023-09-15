<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *    title="Desafio Desenvolvedor Senior",
 *    version="1.0.0",
 * )
 *
 * @OA\SecurityScheme(
 *     type="http",
 *     securityScheme="bearerAuth",
 *     scheme="bearer",
 *     bearerFormat="JWT"
 * )
 *
 * @OA\Get(
 *     path="/api/health",
 *     summary="Verificar status de saúde",
 *     tags={"Health"},
 *     @OA\Response(
 *         response=200,
 *         description="OK - A aplicação está saudável"
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Erro - A aplicação está com problemas de saúde"
 *     ),
 * )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
