<?php
require_once 'Empleado.php';
require_once 'Departamento.php';
require_once 'Mensaje.php';
class Modelo
{
    private string $url = 'mysql:host=localhost;port=3306;dbname=mensajes';
    private string $us = 'root';
    private string $ps = '';

    private $conexion = null;

    function __construct()
    {
        try {
            $this->conexion = new PDO($this->url, $this->us, $this->ps);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    function obtenerEmpleado(int $us)
    {
        $resultado = null;
        try {
            $consulta = $this->conexion->prepare(
                'SELECT * from empleado e join departamento d on e.departamento=d.idDep where idEmp = ?'
            );
            $params = array($us);
            if ($consulta->execute($params)) {
                if ($fila = $consulta->fetch()) {
                    $resultado = new Empleado(
                        $fila['idEmp'],
                        $fila['dni'],
                        $fila['nombreEmp'],
                        $fila['fechaNac'],
                        new Departamento(
                            $fila['idDep'],
                            $fila['nombre']
                        ),
                        $fila['cambiarPs']
                    );
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;
    }

    function enviarMensaje($m, $destinatarios)
    {
        $resultado = 0;
        try {
            $this->conexion->beginTransaction();
            $consulta = $this->conexion->prepare('INSERT into mensaje values(default,?,?,?,curdate(),?');
            $params = array($m->getDeEmpleado(), $m->getParaDepartamento(), $m->getAsunto(), $m->getMensaje());
        if ($consulta->execute($params)) {
            $idMensaje=$this->conexion->lastInsertId();
            //Hacer un Insert en para, para cada destinatario
            foreach ($destinatarios as $d) {
                $consulta = $this->conexion->prepare('INSERT into para values(?,?,false');
                $params=array($idMensaje,$d->getIdEmp());
                if ($consulta->execute($params)) {
                    if ($consulta->rowCount()!=1) {
                        $this->conexion->rollBack();
                    }
                }
            }
            $this->conexion->commit();
            $resultado=$idMensaje;
            $m->setIdMen($idMensaje);
        }
        } catch (PDOException $e) {
            $this->conexion->rollBack();
            $e->getMessage();
        }

        return $resultado;
    }

    function obtenerMensajes($empleado){
        $resultado=false;
        try {
            $consulta=$this->conexion->prepare('SELECT * from mensaje
                                                inner join departamento on paraDepartamento = idDep
                                                where deEmpleado=?');
            $params=array($empleado);
            if ($consulta->execute($params)) {
                while ($fila=$consulta->fetch()) {
                    $m= new Mensaje($fila['idMen'], $empleado,
                     new Departamento($fila['paraDepartamento'], 
                     $fila['nombre']),$fila['asunto'], $fila['fechaEnvio'],$fila['mensaje']);
                    $resultado[]=$m;
                }

            }
            
        } catch (PDOException $e) {
            $e->getMessage();
        }
        return $resultado;
    }

    function obtenerEmpleadosDepartamento($idDep)
    {
        $resultado = array();
        try {
            $consulta = $this->conexion->prepare('SELECT * from empleado where departamento=?');
            $params = array($idDep);
            if ($consulta->execute($params)) {
                while ($fila = $consulta->fetch()) {
                    $resultado[] = new Empleado(
                        $fila['idEmp'],
                        $fila['dni'],
                        $fila['nombre'],
                        $fila['fechaNac'],
                        $fila['departamento'],
                        $fila['cambiarPs']
                    );
                }
            }
        } catch (PDOException $e) {
            $e->getMessage();
        }
        return $resultado;
    }

    function obtenerDepartamentos()
    {
        $resultado = array();
        try {
            $consulta = $this->conexion->query('SELECT * from departamento order by nombre');
            if ($consulta->execute()) {
                while ($fila = $consulta->fetch()) {
                    $resultado[] = new Departamento(($fila['idDep']), $fila['nombre']);
                }
            }
        } catch (\PDOException $e) {
            $e->getMessage();
        }
        return $resultado;
    }
    function login(int $us, string $ps)
    {
        $resultado = 0;
        try {
            //Ejecutar fucnión almacenada en bd
            $consulta = $this->conexion->prepare('select login(?,?)');
            $params = array($us, $ps);
            if ($consulta->execute($params)) {
                if ($fila = $consulta->fetch()) {
                    //devolver lo que devuelve login
                    return $fila[0];
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;
    }


    /**
     * Get the value of conexion
     */
    public function getConexion()
    {
        return $this->conexion;
    }

    /**
     * Set the value of conexion
     */
    public function setConexion($conexion): self
    {
        $this->conexion = $conexion;

        return $this;
    }
}
?>