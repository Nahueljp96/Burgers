<?php
// completar luego de insertar!!!
namespace App\Entidades;

use DB;
use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
protected $table = 'carritos';
      public $timestamps = false;

      protected $fillable = [
            'idcarrito',
            'fk_idcarrito'
          
      ];
      protected $hidden = [

      ];

      public function cargarDesdeRequest($request) {
        $this->idcarrito = $request->input('id') != "0" ? $request->input('id') : $this->idcarrito;
        $this->fk_idcarrito = $request->input('lstCarrito');
        $this->apellido = $request->input('txtApellido');
        $this->correo = $request->input('txtCorreo');
        $this->dni = $request->input('txtDni');
        $this->celular = $request->input('txtCelular');
        $this->clave = $request->input('txtClave');
      }


      public function insertar()
      {
          $sql = "INSERT INTO $this->table (
                  fk_idcliente
                  
              ) VALUES (?);";
          $result = DB::insert($sql, [
              $this->fk_idcliente,
             
          ]);
          return $this->idcarrito = DB::getPdo()->lastInsertId();
      } 

      public function guardar() {
        $sql = "UPDATE $this->table SET
            fk_idcliente=$this->fk_idcliente,
           
            
            WHERE idcarrito=?";
        $affected = DB::update($sql, [$this->idcarrito]);
    }
    
    public function eliminar()
    {
        $sql = "DELETE FROM $this->table WHERE idcarrito=?";         
        $affected = DB::delete($sql, [$this->idcarrito]);
    }

    public function obtenerPorId($idcarrito)
    {
        $sql = "SELECT
                idcarrito,
                fk_idcliente
                FROM $this->table WHERE idcarrito = $idcarrito";
        $lstRetorno = DB::select($sql);

        if (count($lstRetorno) > 0) {
            $this->idcarrito = $lstRetorno[0]->idcarrito;
            $this->fk_idcliente = $lstRetorno[0]->fk_idcliente;
            
            return $this;
        }
        return null;
    }

    public function obtenerTodos()
    {
        $sql = "SELECT
                A.idcarrito,
                A.fk_idcarrito
               
                FROM $this->table A ORDER BY A.nombre";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    } 

}
?>