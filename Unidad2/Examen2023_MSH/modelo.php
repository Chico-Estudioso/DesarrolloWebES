<?php
    require_once 'Jugador.php';

    class Modelo{
        private string $nombreFichero = "ficha_tecnica.txt";

        function __construct()
        {
        }
        function crearJugador(Jugador $j)
    {
        $fich = null;
        try {
            $fich = fopen($this->nombreFichero, "a+");
            fwrite(
                $fich,
                $j->getNJugador() . ";" . $j->getNombre() . ";" . $j->getFechaN() . ";" . $j->getCategoria() . ";" . $j->getTipoCategoria() . ";" . $j->getCompe() . ";" . $j->getExtras() . ";" . PHP_EOL
            );
            $resultado = true;
        } catch (\Throwable $th) {
            echo $th->getMessage();
        } finally {
            if ($fich != null) {
                fclose($fich);
            }
        }
        return $resultado;
    }

    public function obtenerJugadores()
    {
        $resultado = array();

        if (file_exists($this->nombreFichero)) {
            $archivos = file($this->nombreFichero);
            foreach ($archivos as $linea) {
                $pos = explode(';', $linea);
                $player = new Jugador($pos[0], $pos[1], $pos[2], $pos[3], $pos[4]);
                $player->setCompe($pos[5]);
                $player->setExtras($pos[6]);
                $resultado[] = $player;
            }
        }
        return $resultado;
    }
    }

?>