<?php
namespace App\Filters;

use App\Models\RolModel;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\API\ResponseTrait;
use Config\Services;
use Firebase\JWT\JWT;
use Firebase\JWT\ExpiredException;


class AuthFilter implements FilterInterface{
    use ResponseTrait;
    public function before(RequestInterface $request, $arguments = null){
        //Antes del controlador
        try {
            $key = Services::getSecretKey();
            $authHeader = $request->getServer('HTTP_AUTHORIZATION');

            if($authHeader == null)
                return Services::response()->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED,'No se ha enviado el JWT requerido');
            
            $arr = explode(' ',$authHeader);
            $jwt = $arr[1];

            JWT::decode($jwt,$key,['HS256']);

            $rolModel = new RolModel();
            $rol = $rolModel->find($jwt->data->rol);
            if($rol== null)
                return Services::response()->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED,'El rol del JWT es invalido');
            return true;
        } 
        catch (ExpiredException $ee ) {
            return Services::response()->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED,'Su JWT ha expirado');
        }
        catch (\Throwable $th) {
            return Services::response()->setStatusCode(ResponseInterface::HTTP_INTERNAL_SERVER_ERROR,'Ocurrio un error en el servidor');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null){

    }

}
