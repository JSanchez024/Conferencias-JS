<?php

namespace Controllers;

use Dotenv\Util\Regex;
use Model\Paquete;
use Model\Registro;
use Model\Usuario;
use MVC\Router;


class RegistroController {

    public static function crear(Router $router){

        if(!is_auth()){
            header('location: /');
        }

        //verifica si el usuario ya esta registrado
        $registro = Registro::where('usuario_id', $_SESSION['id']);
        if(isset($registro) && $registro->paquete_id === "3"){
            header('location: /boleto?id=' . urlencode($registro->token));
        }

        $router->render('registro/crear', [
            'titulo' => 'Finalizar Registro'
        ]);

    }

    public static function gratis(Router $router){

       if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if(!is_auth()){
                header('location: /login');
            }

             //verifica si el usuario ya esta registrado
            $registro = Registro::where('usuario_id', $_SESSION['id']);
            if(isset($registro) && $registro->paquete_id === "3"){
                header('location: /boleto?id=' . urlencode($registro->token));
            }

            $token = substr(md5(uniqid( rand(), true )), 0, 8);

            //Crear registro
            $datos = array(
                'paquete_id' => 3,
                'pago_id' => '',
                'token' => $token,
                'usuario_id' => $_SESSION['id']
            );

            $registro = new Registro($datos);
            //debuguear($registro);
            $resultado = $registro->guardar();

            if($resultado){
                header('location: /boleto?id=' . urlencode($registro->token));
            }
       }

    }

    public static function boleto(Router $router){

        //valida URL
         $id = $_GET['id'];

         if(!$id || !strlen($id) === 8){

         }

         $registro = Registro::where('token', $id);
         if(!$registro){
            header('location: /');
         }

         //llena las tablas de referencia
         $registro->usuario = Usuario::find($registro->usuario_id);
         $registro->paquete = Paquete::find($registro->paquete_id);


      
        $router->render('registro/boleto',[
            'titulo' => 'Asistencia a DebWebCamp',
            'registro' => $registro
        ]);
    }     

}