<?php

declare(strict_types=1);

use App\Application\Actions\User\ListUsersAction;
use App\Application\Actions\User\ViewUserAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;

use Slim\Interfaces\RouteCollectorProxyInterface as Group;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler; //Para token 



return function (App $app) {
    $app->options('/{routes:.*}', function (Request $request, Response $response) {
        // CORS Pre-Flight OPTIONS Request Handler
        return $response;
    });

    $app->get('/', function (Request $request, Response $response) {
        $response->getBody()->write('Hello world!');
        return $response;
    });

    $app->group('/users', function (Group $group) {
        $group->get('', ListUsersAction::class);
        $group->get('/{id}', ViewUserAction::class);
    });

    //token

    $authMiddleware=function(Request $request, RequestHandler $handler):Response{

    $token= $request->getHeaderLine('Authorization');
        //Token que espera mi backend
         $expected='Baerer Token ecotec';
            if($token !== $expected)
                {

                $response=new \Slim\Psr7\Response();
                $response->getBody()->write(json_encode(

                [

                'error'=> 'No Autorizado',
                'tip'=>'Envía el token correcto'
                ]
                ));
                return $response
                ->withHeader('Content-Type','application/json')
                ->withStatus(401);
            }
            return $handler->handle($request);
    };



    //Get
    // $app->get('/saludo',function( Request $request,  Response $response){
    //     $data=[
    //         'mensaje'=>'Hola Estudiantes',
    //         'materia'=>'Sistemas Web'

    //     ];

    //     $response->getBody()->write(json_encode($data));
    //     return $response->withHeader('Content-Type','application/json');


    // });


    //Get con Parametros
    //   $app->get('/saludo/{nombre}',function( Request $request,  Response $response,$argm){
    //   $nombre=$argm['nombre'] ; 
    //   $data=[
    //         'mensaje'=>"Hola $nombre",
    //         'materia'=>'Sistemas Web'

    //     ];

    //     $response->getBody()->write(json_encode($data));
    //     return $response->withHeader('Content-Type','application/json');


    // });


    //Get con QueryParms
      $app->get('/saludo',function( Request $request,  Response $response){
      $params=$request->getQueryParams();
      $nombre=$params['nombre'] ?? 'Invitado'; 
      $data=[
            'mensaje'=>"Hola $nombre",
            'materia'=>'Sistemas Web'

        ];

        $response->getBody()->write(json_encode($data));
        return $response->withHeader('Content-Type','application/json');


    })->add($authMiddleware);



};
