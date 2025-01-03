<?php

namespace Controllers;

use Model\Dia;
use Model\Hora;
use MVC\Router;
use Model\Evento;
use Model\Regalo;
use Model\Paquete;
use Model\Ponente;
use Model\Usuario;
use Model\Registro;
use Model\Categoria;
use Dotenv\Util\Regex;


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
    
    public static function pagar(Router $router){

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if(!is_auth()){
                header('location: /login');
            }

            //Validar Post no este vacio
            if(empty($_POST)){
                echo json_encode([]);
                return;
            }

            //Crear Registro
            $datos = $_POST;
            $datos['token'] = substr(md5(uniqid(rand(), true)), 0, 8);
            $datos['usuario_id'] = $_SESSION['id'];
            
            try {
                $registro = new Registro($datos);
                $resultado = $registro->guardar();
                echo json_encode($resultado);
            } catch (\Throwable $th) {
                echo json_encode([
                    'resultado' => 'error'
                ]);
            }
        }
     }

     public static function conferencias(Router $router){

        if(!is_auth()){
            header('location: /login');
        }
//
        //validar que el usuaario tenga el plan presencial
        $usuario_id = $_SESSION['id'];
        $registro = Registro::where('usuario_id', $usuario_id);
//
        if($registro->paquete_id !== "1"){
            header('location: /');
        }

        $eventos = Evento::ordenar('hora_id', 'ASC');

        $eventos_formateados = [];
        foreach($eventos as $evento){
            $evento->categoria = Categoria::find($evento->categoria_id);
            $evento->dia = Dia::find($evento->dia_id);
            $evento->hora = Hora::find($evento->hora_id);
            $evento->ponente = Ponente::find($evento->ponente_id);

            if($evento->dia_id === "5" && $evento->categoria_id === "5"){
                $eventos_formateados['conferencias_v'][] = $evento;
            }
            if($evento->dia_id === "6" && $evento->categoria_id === "5"){
                $eventos_formateados['conferencias_s'][] = $evento;
            }
            if($evento->dia_id === "5" && $evento->categoria_id === "6"){
                $eventos_formateados['workshops_v'][] = $evento;
            }
            if($evento->dia_id === "6" && $evento->categoria_id === "6"){
                $eventos_formateados['workshops_s'][] = $evento;
            }
        }

        $regalos = Regalo::all('ASC');

        //Manejando registro por POST
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            //Revisar usuario autenticado
            if(!is_auth()){
                header('location: /login');
            }

            $eventos = explode(',', $_POST['eventos']);
            if(empty($eventos)){
                echo json_encode(['resultado' => false]);
                return;
            }
            //debuguear($eventos);
            //debuguear($_POST);

            //Obtener registro de usuario
            $registro = Registro::where('usuario_id', $_SESSION['id']);
            debuguear($registro);

            if(!isset($registro) || $registro->pequete_id !== "1"){
                echo json_encode(['resultado' => false]);
                return;
            }
        }

        $router->render('registro/conferencias', [
            'titulo' => 'Elige Workshops y Conferencias',
            'eventos' => $eventos_formateados,
            'regalos' => $regalos
        ]);
    } 
}