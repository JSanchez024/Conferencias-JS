<?php

namespace Controllers;

use Classes\Paginacion;
use MVC\Router;
use Model\Ponente;
use Intervention\Image\ImageManagerStatic as Image;

class PonentesController {

    public static function index(Router $router){
        //Proteger Panel
        if(!is_admin()){
           header('location: /login');
        }

        $pagina_actual = $_GET['page'];
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);

        if(!$pagina_actual || $pagina_actual < 1){
            header('location: /admin/ponentes?page=1');
        }

        $registros_por_pagina = 7;
        $total = Ponente::total();
        $paginacion = new Paginacion($pagina_actual, $registros_por_pagina, $total);

        if($paginacion->total_paginas() < $pagina_actual){
            header('location: /admin/ponentes?page=1');
        }
        
        $ponentes = Ponente::paginar($registros_por_pagina, $paginacion->offset());

       

        $router->render('admin/ponentes/index',[
            'titulo' => 'Ponentes / Conferencistas',
            'ponentes' => $ponentes,
            'paginacion' => $paginacion->paginacion()
        ]);
    }
    public static function crear(Router $router){
        //Proteger Panel
        if(!is_admin()){
            header('location: /login');
        }

        $alertas = [];
        $ponente = new Ponente;

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            //Proteger Panel
            if(!is_admin()){
                header('location: /login');
            }
            //leer imagen
            if(!empty($_FILES['imagen']['tmp_name'])){
                
                $carpeta_imagenes = '../public/img/speakers';

                //Crear la carpeta si no existe
                if(!is_dir($carpeta_imagenes)){
                    mkdir($carpeta_imagenes, 0777, true);
                }

                $imagen_png = Image::make($_FILES['imagen']['tmp_name'])->fit(800, 800)->encode('png', 80);
                $imagen_webp = Image::make($_FILES['imagen']['tmp_name'])->fit(800, 800)->encode('webp', 80);

                $nombre_imagen = md5( uniqid( rand(), true) );

                $_POST['imagen'] = $nombre_imagen;

            }

            $_POST['redes'] = json_encode($_POST['redes'], JSON_UNESCAPED_SLASHES);
        
            $ponente->sincronizar($_POST);

            //validar
            $alertas = $ponente->validar();

            //Guardar el registro
            if(empty($alertas)){
                //Guardar las imagenes
                $imagen_png->save($carpeta_imagenes . '/' . $nombre_imagen . ".png");
                $imagen_webp->save($carpeta_imagenes . '/' . $nombre_imagen . ".webp");

                //Guardar en la BD
                $resultado = $ponente->guardar();

                if($resultado){
                    header('location: /admin/ponentes');
                }
            }
        }

        $router->render('admin/ponentes/crear',[
            'titulo' => 'Registrar Ponente',
            'alertas' => $alertas,
            'ponente' => $ponente,
            'redes' => json_decode($ponente->redes)
        ]);
    }

    public static function editar(Router $router){
        if(!is_admin()){
            header('location: /admin/ponentes');
        }
        $alertas = [];
        //Validar id
        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        //Proteger Panel
        if(!is_admin()){
            header('location: /login');
        }

        //Obtener ponente a editar
        $ponente = Ponente::find($id);

        if(!$ponente){
            header('location: /admin/ponentes');
        }

        $ponente->imagen_actual = $ponente->imagen;

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            //Proteger Panel
            if(!is_admin()){
                header('location: /login');
            }
            if(!empty($_FILES['imagen']['tmp_name'])){
                
                $carpeta_imagenes = '../public/img/speakers';

                //Eliminar imagen previa
                unlink($carpeta_imagenes . '/' . $ponente->imagen_actual . ".png");
                unlink($carpeta_imagenes . '/' . $ponente->imagen_actual . ".webp");

                //Crear la carpeta si no existe
                if(!is_dir($carpeta_imagenes)){
                    mkdir($carpeta_imagenes, 0777, true);
                }

                $imagen_png = Image::make($_FILES['imagen']['tmp_name'])->fit(800, 800)->encode('png', 80);
                $imagen_webp = Image::make($_FILES['imagen']['tmp_name'])->fit(800, 800)->encode('webp', 80);

                $nombre_imagen = md5( uniqid( rand(), true) );

                $_POST['imagen'] = $nombre_imagen; 
            }else{
                $_POST['imagen'] = $ponente->image_actual;
            }

            $_POST['redes'] = json_encode($_POST['redes'], JSON_UNESCAPED_SLASHES);
            $ponente->sincronizar($_POST);

            $alertas = $ponente->validar();

            if(empty($alertas)){
                if(isset($nombre_imagen)){
                      //Guardar las imagenes
                $imagen_png->save($carpeta_imagenes . '/' . $nombre_imagen . ".png");
                $imagen_webp->save($carpeta_imagenes . '/' . $nombre_imagen . ".webp");
                }
                $resultado = $ponente->guardar();
                if($resultado){
                    header('location: /admin/ponentes');
                }
            }
        }

        $router->render('admin/ponentes/editar',[
            'titulo' => 'Actualizar Ponente',
            'alertas' => $alertas,
            'ponente' => $ponente,
            'redes' => json_decode($ponente->redes)
        ]);
    }

    public static function eliminar(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            //Proteger Panel
            if(!is_admin()){
                header('location: /login');
            }

            $carpeta_imagenes = '../public/img/speakers';

            $id = $_POST['id'];
            $ponente = Ponente::find($id);

            if(!isset($ponente)){
                header('location: /admin/ponentes');
            }
            //Eliminar imagen en el servidor
            if ($ponente->imagen) {
                unlink($carpeta_imagenes . '/' . $ponente->imagen . ".png");
                unlink($carpeta_imagenes . '/' . $ponente->imagen . ".webp");
            }

            $resultado = $ponente->eliminar();

            if($resultado){
                header('location: /admin/ponentes');
            }

        }
    }

   
}