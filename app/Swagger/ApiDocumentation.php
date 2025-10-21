<?php

namespace App\Swagger;

/**
 * @OA\Info(
 *     title="Minha API",
 *     version="1.0.0",
 *     description="Documentação da API"
 * )
 *
 * @OA\Server(
 *     url="http://localhost:8080/"
 * )
 * 
 * @OA\SecurityScheme(
 *     securityScheme="bearerAuth",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="JWT"
 * )
 *
 * @OA\Schema(
 *     schema="LoginRequest",
 *     type="object",
 *     required={"username", "password"},
 *     @OA\Property(property="username", type="string"),
 *     @OA\Property(property="password", type="string")
 * )
 *
 * @OA\Schema(
 *     schema="Produto",
 *     type="object",
 *     required={"nome", "preco", "quantidade_estoque"},
 *     @OA\Property(property="nome", type="string"),
 *     @OA\Property(property="descricao", type="string"),
 *     @OA\Property(property="preco", type="number", format="float"),
 *     @OA\Property(property="quantidade_estoque", type="integer")
 * )
 *
 * @OA\Post(
 *     path="/api/login",
 *     summary="Autenticação do usuário",
 *     tags={"Autenticação"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/LoginRequest")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Autenticação realizada com sucesso, retorna token JWT",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="token", type="string", description="Token JWT gerado")
 *         )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Credenciais inválidas"
 *     )
 * )
 * 
 * @OA\Get(
 *     path="/api/produtos",
 *     summary="Lista produtos",
 *     tags={"Produtos"},
 *     security={{"bearerAuth":{}}},
 *     @OA\Parameter(
 *         name="Accept",
 *         in="header",
 *         description="Formato esperado da resposta",
 *         required=true,
 *         @OA\Schema(type="string", default="application/json")
 *     ),
 *     @OA\Parameter(
 *         name="Authorization",
 *         in="header",
 *         description="Token JWT no formato 'Bearer {token}'",
 *         required=true,
 *         @OA\Schema(type="string", default="Bearer <token>")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Lista de produtos",
 *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Produto"))
 *     )
 * )
 *
 * @OA\Post(
 *     path="/api/produtos",
 *     summary="Cria um novo produto",
 *     tags={"Produtos"},
 *     security={{"bearerAuth":{}}},
 *     @OA\Parameter(
 *         name="Accept",
 *         in="header",
 *         description="Formato esperado da resposta",
 *         required=true,
 *         @OA\Schema(type="string", default="application/json")
 *     ),
 *     @OA\Parameter(
 *         name="Authorization",
 *         in="header",
 *         description="Token JWT no formato 'Bearer {token}'",
 *         required=true,
 *         @OA\Schema(type="string", default="Bearer <token>")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/Produto")
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Produto criado com sucesso",
 *         @OA\JsonContent(ref="#/components/schemas/Produto")
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Validação falhou"
 *     )
 * )
 *
 * @OA\Get(
 *     path="/api/produtos/{id}",
 *     summary="Mostra um produto específico",
 *     tags={"Produtos"},
 *     security={{"bearerAuth":{}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID do produto",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Parameter(
 *         name="Accept",
 *         in="header",
 *         description="Formato esperado da resposta",
 *         required=true,
 *         @OA\Schema(type="string", default="application/json")
 *     ),
 *     @OA\Parameter(
 *         name="Authorization",
 *         in="header",
 *         description="Token JWT no formato 'Bearer {token}'",
 *         required=true,
 *         @OA\Schema(type="string", default="Bearer <token>")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Detalhes do produto",
 *         @OA\JsonContent(ref="#/components/schemas/Produto")
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Produto não encontrado"
 *     )
 * )
 *
 * @OA\Put(
 *     path="/api/produtos/{id}",
 *     summary="Atualiza um produto existente",
 *     tags={"Produtos"},
 *     security={{"bearerAuth":{}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID do produto",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Parameter(
 *         name="Accept",
 *         in="header",
 *         description="Formato esperado da resposta",
 *         required=true,
 *         @OA\Schema(type="string", default="application/json")
 *     ),
 *     @OA\Parameter(
 *         name="Authorization",
 *         in="header",
 *         description="Token JWT no formato 'Bearer {token}'",
 *         required=true,
 *         @OA\Schema(type="string", default="Bearer <token>")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/Produto")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Produto atualizado com sucesso",
 *         @OA\JsonContent(ref="#/components/schemas/Produto")
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Produto não encontrado"
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Validação falhou"
 *     )
 * )
 *
 * @OA\Delete(
 *     path="/api/produtos/{id}",
 *     summary="Deleta um produto",
 *     tags={"Produtos"},
 *     security={{"bearerAuth":{}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID do produto",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Parameter(
 *         name="Accept",
 *         in="header",
 *         description="Formato esperado da resposta",
 *         required=true,
 *         @OA\Schema(type="string", default="application/json")
 *     ),
 *     @OA\Parameter(
 *         name="Authorization",
 *         in="header",
 *         description="Token JWT no formato 'Bearer {token}'",
 *         required=true,
 *         @OA\Schema(type="string", default="Bearer <token>")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Produto deletado com sucesso"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Produto não encontrado"
 *     )
 * )
 */
class ApiDocumentation
{
    // Só para agrupar as anotações, não precisa de código aqui
}
