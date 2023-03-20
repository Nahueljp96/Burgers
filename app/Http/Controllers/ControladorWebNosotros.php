<?php

namespace App\Http\Controllers;
use App\Entidades\Sucursal;
use App\Entidades\Postulacion;
use Illuminate\Http\Request;



class ControladorWebNosotros extends Controller
{
    public function index()
    {
            $sucursal = new Sucursal();
            $aSucursales = $sucursal->obtenerTodos();
            return view("web.nosotros", compact("aSucursales"));
    }

    public function enviar(Request $request){

        $nombre = $request->input('txtNombre');
        $apellido = $request->input('txtApellido');
        $celular = $request->input('txtCelular');
        $correo = $request->input('txtCorreo');
        $mensaje = $request->input('txtMensaje');

        $postulacion = new Postulacion();
        if ($_FILES["archivo"]["error"] === UPLOAD_ERR_OK) { //Se adjunta imagen
            $extension = pathinfo($_FILES["archivo"]["name"], PATHINFO_EXTENSION);
             $nombreRandom = date("Ymdhmsi") . ".$extension"; //geenra un nombre random
             $archivo = $_FILES["archivo"]["tmp_name"];
             if ($extension =="pdf" || $extension =="doc" || $extension =="docx"){ //validación
             move_uploaded_file($archivo, env('APP_PATH') . "/public/files/$nombreRandom"); //guardaelarchivo
             $postulacion->curriculum = $nombreRandom;
             }
         }


        $postulacion->nombre = $nombre;
        $postulacion->apellido = $apellido;
        $postulacion->celular = $celular;
        $postulacion->correo = $correo;
        $postulacion->mensaje = $mensaje;
        $postulacion->insertar();

        return redirect("/gracias-postulacion");
    }
}
