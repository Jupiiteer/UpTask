<?php


namespace Controllers;

use Model\Usuario;
use MVC\Router;
use Model\Proyecto;

class DashboardController
{
    public static function index(Router $router)
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        isAuth();

        $id = $_SESSION['id'];
        $proyectos = Proyecto::belongsTo('propietarioId', $id);
        $router->render('dashboard/index', [
            'titulo' => 'Proyectos',
            'proyectos' => $proyectos
        ]);
    }
    public static function crear_proyecto(Router $router)
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        isAuth();
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $proyecto = new Proyecto($_POST);
            # Validacion
            $alertas = $proyecto->validarProyecto();
            if (empty($alertas)) {
                # Generar una URL Unica
                $proyecto->url = md5(uniqid());

                # Almacenar el creador del proyecto
                $proyecto->propietarioid = $_SESSION['id'];

                # Guardar Proyecto
                $proyecto->guardar();

                # Redireccionar
                header('Location: /proyecto?id=' . $proyecto->url);
            }
        }
        $router->render('dashboard/crear-proyecto', [
            'titulo' => 'Crear Proyecto',
            'alertas' => $alertas
        ]);
    }
    public static function proyecto(Router $router)
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        isAuth();

        $token = $_GET['id'];
        if (!$token)
            header('Location: /dashboard');
        # Revisar que la persona visitante sea quien lo creo
        $proyecto = Proyecto::where('url', $token);
        if ($proyecto->propietarioId !== $_SESSION['id'])
            header('Location: /dashboard');


        $router->render('dashboard/proyecto', [
            'titulo' => $proyecto->proyecto
        ]);
    }
    public static function perfil(Router $router)
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        isAuth();
        $alertas = [];

        $usuario = Usuario::find($_SESSION['id']);

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validar_perfil();
        }

        if(empty($alertas)){
            $existeUsuario = Usuario::where('email', $usuario->email);

            if($existeUsuario && $existeUsuario->id !== $usuario->id){
                // Mensaje de error
                Usuario::setAlerta('error', 'Email no válido, cuenta ya registrada');
                $alertas = $usuario->getAlertas();
            }else{
                // Guardar el usuario
                $usuario->guardar();

                Usuario::setAlerta('exito', 'Guardado Correctamente');
                $alertas = $usuario->getAlertas();

                $_SESSION['nombre'] = $usuario->nombre;
            }
        }

        $router->render('dashboard/perfil', [
            'titulo' => 'Perfil',
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }

    public static function cambiar_password(Router $router){
        if (!isset($_SESSION)) {
            session_start();
        }
        isAuth();
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $usuario = Usuario::find($_SESSION['id']);

            // Sincronizar con los datos del usuario
            $usuario->sincronizar($_POST);

            $alertas = $usuario->nuevo_password();

            if(empty($alertas)){
                $resultado = $usuario->comprobarPassword();

                if($resultado){
                    // Asignar el nuevo password
                    $usuario->password = $usuario->password_nuevo;

                    // Eliminar propiedades no necesarias
                    unset($usuario->password_actual);
                    unset($usuario->password_nuevo);

                    // Hashear el nuevo password
                    $usuario->hashPassword();

                    // Actualizar
                    $resultado = $usuario->guardar();
                    if($resultado){
                        Usuario::setAlerta('exito', 'Contraseña Guardada Correctamente');
                        $alertas = $usuario->getAlertas();
                    }
                }else{
                    Usuario::setAlerta('error', 'Contraseña Incorrecta');
                    $alertas = $usuario->getAlertas();
                }
            }
        }

        $router->render('dashboard/cambiar-password', [
            'titulo' => 'Cambiar contraseña',
            'alertas' => $alertas
        ]);
    }
}
