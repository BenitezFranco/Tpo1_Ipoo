<?php
include 'Viaje.php';
include 'Menu.php';


$viaje = viajeInicial();
$menu = new Menu();
do {
    $opcion = $menu->menuViaje();
    switch ($opcion) {
        case 1:
            $viaje = ingresoViaje($menu);
            break;
        case 2:
            $viaje = modificarViaje($viaje, $menu);
            break;
        case 3:
            echo " " . $viaje->__toString() . "\n";
            break;
        default:
            break;
    };
} while ($opcion != 4);
echo ("Fin del programa");

/**
 * Ingreso de un Viaje nuevo
 * @return Viaje
 */
function ingresoViaje($menu)
{
    echo "Ingrese un codigo\n";
    $codigo = trim(fgets(STDIN));
    echo "Ingrese el destino\n";
    $destino = trim(fgets(STDIN));
    do {
        $band = true;
        echo "Ingrese la cantidad maxima de pasajeros\n";
        $cantidad = trim(fgets(STDIN));
        if ($cantidad > 0) {
            $band = false;
        }
    } while ($band);
    echo "Ingrese el costo\n";
    $costo = trim(fgets(STDIN));
    $responsable = crearResponsable();
    $viaje = new Viaje($codigo, $destino, $cantidad, [], $responsable, $costo, 0);
    $pasajeros = crearPasajeros($cantidad,$menu);
    for ($i = 0; $i < $cantidad; $i++) {
        $viaje->venderPasaje($pasajeros[$i]);
    }
    return $viaje;
}

/**
 * Menu modificacion pasajero
 * @param Viaje
 * @return Viaje
 */

function modificarViaje($viaje, $menu)
{
    do {
        $opcion = $menu->menuModificacion();
        switch ($opcion) {
            case 1:
                echo "Ingrese un codigo\n";
                $codigo = trim(fgets(STDIN));
                $viaje->setCodigo($codigo);
                break;
            case 2:
                echo "Ingrese el destino\n";
                $destino = trim(fgets(STDIN));
                $viaje->setDestino($destino);
                break;
            case 3:
                $viaje = modificarCantidad($viaje);
                break;
            case 4:
                $viaje = modificarResponsable($viaje, $menu);
                break;
            case 5:
                $viaje = modificarPasajeros($viaje,$menu);
                break;
            default:
                break;
        };
    } while ($opcion != 6);

    return $viaje;
}

/**
 * Modifica la cantidad maxima de pasajeros
 * @param Viaje
 * @param Viaje
 */
function modificarCantidad($viaje)
{
    $min = count($viaje->getPasajeros());
    do {
        $band = true;
        echo "Ingrese la cantidad maxima de pasajeros\n";
        $cantidad = trim(fgets(STDIN));
        if ($cantidad > 0) {
            if ($cantidad >= $min) {
                $band = false;
            } else {
                echo "La cantidad debe ser mayor a $min\n";
            }
        } else {
            echo "Cantidad invalida\n";
        }
    } while ($band);

    $viaje->setCantidad($cantidad);

    return $viaje;
}

/**
 * Modifica el responsable
 * @param Viaje
 * @return Viaje
 */
function modificarResponsable($viaje, $menu)
{

    do {
        $opcion = $menu->menuResponsable();
        switch ($opcion) {
            case 1:
                $responsable = crearResponsable();
                $viaje->setResponsable($responsable);
                break;
            case 2:
                $viaje = modResponsable($viaje, $menu);
                break;
            case 3:
                $responsable = $viaje->getResponsable();
                echo $responsable->__toString() . "\n";
                break;
            default:
                break;
        };
    } while ($opcion != 4);

    return $viaje;
}

function modResponsable($viaje, $menu)
{
    do {
        $opcion = $menu->menuModificarResponsable();
        switch ($opcion) {
            case 1:
                $responsable = $viaje->getResponsable();
                echo "Ingrese el numero de licencia\n";
                $numero = trim(fgets(STDIN));
                $responsable->setLicencia($numero);
                $viaje->setResponsable($responsable);
                break;
            case 2:
                $responsable = $viaje->getResponsable();
                echo "Ingrese el nombre\n";
                $nombre = trim(fgets(STDIN));
                $responsable->setNombre($nombre);
                $viaje->setResponsable($responsable);
                break;
            case 3:
                $responsable = $viaje->getResponsable();
                echo "Ingrese el apellido\n";
                $apellido = trim(fgets(STDIN));
                $responsable->setApellido($apellido);
                $viaje->setResponsable($responsable);
                break;
            default:
                break;
        };
    } while ($opcion != 4);

    return $viaje;
}

/**
 * Metodo para elegir que modificar
 * @param Viaje
 * @return Viaje Retorna el viaje con los pasajeros modificados
 */
function modificarPasajeros($viaje, $menu)
{
    do {
        $opcion = $menu->menuPasajeros();
        switch ($opcion) {
            case 1:
                $viaje = agregarPasajero($viaje,$menu);
                break;
            case 2:
                $viaje = eliminarPasajero($viaje);
                break;
            case 3:
                $viaje = modificarPasajero($viaje,$menu);
                break;
            default:
                break;
        };
    } while ($opcion != 4);

    return $viaje;
}

/**
 * Agrega un pasajero
 * @param Viaje
 * @return Viaje Retorna un viaje con un pasajero mas
 */
function agregarPasajero($viaje,$menu)
{
    $pasajeros = $viaje->getPasajeros();
    $pasajero = crearPasajero($pasajeros,$menu);
    $importe =$viaje->venderPasaje($pasajero);
    if($importe >0){
        echo "El pasajero tiene que abonar: $".$importe."\n";
    }else{
        echo "No se pudo agregar el pasajero\n";
    }
    return $viaje;
}

/**
 * Elimina un pasajero usando el numero de documento
 * @param Viaje 
 * @return Viaje Retorna un viaje con un pasajero eliminado
 */
function eliminarPasajero($viaje)
{
    $pasajeros = $viaje->getPasajeros();
    do {
        $band = true;
        echo "Ingrese el numero de documento\n";
        $numero = trim(fgets(STDIN));
        if ($numero > 0) {
            $id = buscar($numero, $pasajeros);
            if ($id != -1) {
                $band = false;
            } else {
                echo "Numero de documento no encontrado\n";
            }
        } else {
            echo "Numero de documento invalido\n";
        }
    } while ($band);
    $viajeros = [];
    $lenght = count($pasajeros);
    $ind = 0;
    for ($i = 0; $i < $lenght; $i++) {
        if ($i != $id) {
            $viajeros[$ind] = $pasajeros[$i];
            $ind++;
        }
    }
    $viaje->setPasajeros($viajeros);
    return $viaje;
}

function modificarPasajero($viaje, $menu)
{

    $pasajeros = $viaje->getPasajeros();
    do {
        $band = true;
        echo "Ingrese el numero de documento del pasajero a modificar\n";
        $dni = trim(fgets(STDIN));
        $indice = buscar($dni, $pasajeros);
        if ($indice != -1 and $dni > 0) {
            $band = false;
        } else {
            echo "Numero de documento invalido\n";
        }
    } while ($band);
    $pasajero = $pasajeros[$indice];
    if ($pasajero->esVip()) {
        $opcion = $menu->menuModificarVIP();
        switch ($opcion) {
            case 1:
                $viaje = cambiarNombre($viaje, $indice);
                break;
            case 2:
                $viaje = cambiarApellido($viaje, $indice);
                break;
            case 3:
                $viaje = cambiarTelefono($viaje, $indice);
                break;
            case 4:
                $viaje = cambiarNroAsiento($viaje, $indice);
                break;
            case 5:
                $viaje = cambiarNroTicket($viaje, $indice);
                break;
            case 6:
                $viaje = cambiarPasFrecuente($viaje, $indice);
                break;
            case 7:
                $viaje = cambiarCantMillas($viaje, $indice);
                break;
            default:
                break;
        };
    } else {
        if ($pasajero->esConNecesidades()) {
            $opcion = $menu->menuModificarPasajeroConNecesidades();
            switch ($opcion) {
                case 1:
                    $viaje = cambiarNombre($viaje, $indice);
                    break;
                case 2:
                    $viaje = cambiarApellido($viaje, $indice);
                    break;
                case 3:
                    $viaje = cambiarTelefono($viaje, $indice);
                    break;
                case 4:
                    $viaje = cambiarNroAsiento($viaje, $indice);
                    break;
                case 5:
                    $viaje = cambiarNroTicket($viaje, $indice);
                    break;
                case 6:
                    $viaje = cambiarSilla($viaje, $indice);
                    break;
                case 7:
                    $viaje = cambiarComida($viaje, $indice);
                    break;
                case 8:
                    $viaje = cambiarAsistencia($viaje, $indice);
                    break;
                default:
                    break;
            }
        } else {
            $opcion = $menu->menuModificarPasajero();
            switch ($opcion) {
                case 1:
                    $viaje = cambiarNombre($viaje, $indice);
                    break;
                case 2:
                    $viaje = cambiarApellido($viaje, $indice);
                    break;
                case 3:
                    $viaje = cambiarTelefono($viaje, $indice);
                    break;
                case 4:
                    $viaje = cambiarNroAsiento($viaje, $indice);
                    break;
                case 5:
                    $viaje = cambiarNroTicket($viaje, $indice);
                    break;
                default:
                    break;
            }
        }

        return $viaje;
    }
}
/**
 * Cambia el nombre del pasajero en la posicion $indice
 * @param Viaje
 * @param int indice
 * @return Viaje 
 */
function cambiarNombre($viaje, $indice)
{

    $pasajeros = $viaje->getPasajeros();
    echo "Ingrese el nombre\n";
    $nombre = trim(fgets(STDIN));
    $pasajeros[$indice]->setNombre($nombre);
    $viaje->setPasajeros($pasajeros);
    return $viaje;
}

/**
 * Cambia el apellido del pasajero en la posicion $indice
 * @param Viaje
 * @param int indice
 * @return Viaje 
 */
function cambiarApellido($viaje, $indice)
{

    $pasajeros = $viaje->getPasajeros();
    echo "Ingrese el apellido\n";
    $apellido = trim(fgets(STDIN));
    $pasajeros[$indice]->setApellido($apellido);
    $viaje->setPasajeros($pasajeros);
    return $viaje;
}

/**
 * Cambia el telefono del pasajero en la posicion $indice
 * @param Viaje
 * @param int indice
 * @return Viaje 
 */
function cambiarTelefono($viaje, $indice)
{

    $pasajeros = $viaje->getPasajeros();
    do {
        $band = true;
        echo "Ingrese el numero de telefono\n";
        $telefono = trim(fgets(STDIN));
        if ($telefono > 0) {
            $band = false;
        } else {
            echo "Numero de telefono invalido";
        }
    } while ($band);
    $pasajeros[$indice]->setTelefono($telefono);
    $viaje->setPasajeros($pasajeros);
    return $viaje;
}

/**
 * Cambia el numero de asiento del pasajero en la posicion $indice
 * @param Viaje
 * @param int indice
 * @return Viaje 
 */
function cambiarNroAsiento($viaje, $indice)
{
    $pasajeros = $viaje->getPasajeros();
    echo "Ingrese el numero de asiento \n";
    $nroAsiento = trim(fgets(STDIN));
    $pasajeros[$indice]->setNroAsiento($nroAsiento);
    $viaje->setPasajeros($pasajeros);
    return $viaje;
}

function cambiarNroTicket($viaje, $indice)
{
    $pasajeros = $viaje->getPasajeros();
    echo "Ingrese el numero de ticket \n";
    $nroTicket = trim(fgets(STDIN));
    $pasajeros[$indice]->setNroTicket($nroTicket);
    $viaje->setPasajeros($pasajeros);
    return $viaje;
}

//Cambios Pasajero VIP

function cambiarCantMillas($viaje, $indice)
{
    $pasajeros = $viaje->getPasajeros();
    echo "Ingrese la cantidad de millas \n";
    $millas = trim(fgets(STDIN));
    $pasajeros[$indice]->setNroTicket($millas);
    $viaje->setPasajeros($pasajeros);
    return $viaje;
}

function cambiarPasFrecuente($viaje, $indice)
{
    $pasajeros = $viaje->getPasajeros();
    echo "Ingrese el numero de pasajero frecuente \n";
    $pasFrecuente = trim(fgets(STDIN));
    $pasajeros[$indice]->setNumeroViajeroFrecuente($pasFrecuente);
    $viaje->setPasajeros($pasajeros);
    return $viaje;
}

// Cambios Pasajeros con necesidades
function cambiarSilla($viaje, $indice)
{
    $pasajeros = $viaje->getPasajeros();
    $band = true;
    do {
        echo "Ingrese 1 si necesita silla de ruedas o 2 si no la necesita \n";
        $num = trim(fgets(STDIN));
        if ($num == 1 || $num == 2) {
            $pasajeros[$indice]->setSilla(($num == 1));
            $viaje->setPasajeros($pasajeros);
            $band = false;
        } else {
            echo "Opcion invalida \n";
        }
    } while ($band);
    return $viaje;
}

function cambiarComida($viaje, $indice)
{
    $pasajeros = $viaje->getPasajeros();
    $band = true;
    do {
        echo "Ingrese 1 si necesita comida especial o 2 si no la necesita \n";
        $num = trim(fgets(STDIN));
        if ($num == 1 || $num == 2) {
            $pasajeros[$indice]->setComida(($num == 1));
            $viaje->setPasajeros($pasajeros);
            $band = false;
        } else {
            echo "Opcion invalida \n";
        }
    } while ($band);
    return $viaje;
}

function cambiarAsistencia($viaje, $indice)
{
    $pasajeros = $viaje->getPasajeros();
    $band = true;
    do {
        echo "Ingrese 1 si necesita asistencia especial o 2 si no la necesita \n";
        $num = trim(fgets(STDIN));
        if ($num == 1 || $num == 2) {
            $pasajeros[$indice]->setAsistencia(($num == 1));
            $viaje->setPasajeros($pasajeros);
            $band = false;
        } else {
            echo "Opcion invalida \n";
        }
    } while ($band);
    return $viaje;
}


/**
 * Crea un arreglo de pasajeros
 * @param int Cantidad maxima de pasajeros
 * @return array Retorna un arreglo de pasajeros
 */
function crearPasajeros($cantidad, $menu)
{
    do {
        $band = true;
        echo "Ingrese la cantidad de pasajeros a cargar(0 para no agregar)\n";
        $indice = trim(fgets(STDIN));
        if ($indice >= 0) {
            if ($indice <= $cantidad) {
                $band = false;
            } else {
                echo "La cantidad debe ser menor a $cantidad";
            }
        } else {
            echo "Cantidad invalida";
        }
    } while ($band);
    $pasajeros = [];
    for ($i = 0; $i < $indice; $i++) {
        $pasajeros[$i] = crearPasajero($pasajeros, $menu);
    }

    return $pasajeros;
}

/**
 * Crea un pasajero
 * @param array Arreglo de pasajeros
 * @param Menu menu
 * @return Pasajero Retorna un pasajero
 */
function crearPasajero($pasajeros, $menu)
{

    $opcion = $menu->menuTipoPasajero();
    return crearPasajeroPorTipo($pasajeros, $opcion);
}

function crearPasajeroPorTipo($pasajeros, $num)
{
    echo "Ingrese el nombre\n";
    $nombre = trim(fgets(STDIN));
    echo "Ingrese el apellido\n";
    $apellido = trim(fgets(STDIN));
    do {
        $band = true;
        echo "Ingrese el numero de documento\n";
        $dni = trim(fgets(STDIN));
        if (buscar($dni, $pasajeros) == -1 and $dni > 0) {
            $band = false;
        } else {
            echo "Numero de documento invalido";
        }
    } while ($band);
    do {
        $band = true;
        echo "Ingrese el numero de telefono\n";
        $numero = trim(fgets(STDIN));
        if ($numero > 0) {
            $band = false;
        } else {
            echo "Numero de telefono invalido";
        }
    } while ($band);

    echo "Ingrese el numero de asiento \n";
    $nroAsiento = trim(fgets(STDIN));

    echo "Ingrese el numero de ticket \n";
    $nroTicket = trim(fgets(STDIN));
    if ($num == 1) {
        $pasajero = new Pasajero($nombre, $apellido, $dni, $numero, $nroAsiento, $nroTicket);
    }
    if ($num == 2) {
        echo "Ingrese la cantidad de millas \n";
        $millas = trim(fgets(STDIN));

        echo "Ingrese el numero de pasajero frecuente \n";
        $pasFrecuente = trim(fgets(STDIN));

        $pasajero = new PasajeroVIP($nombre, $apellido, $dni, $numero, $nroAsiento, $nroTicket, $pasFrecuente, $millas);
    }
    if ($num == 3) {
        do {
            echo "Ingrese 1 si necesita silla de ruedas o 2 si no la necesita \n";
            $silla = trim(fgets(STDIN));
            if ($silla == 1 || $silla == 2) {
                $band = false;
            } else {
                echo "Opcion invalida \n";
            }
        } while ($band);
        do {
            echo "Ingrese 1 si necesita comida especial o 2 si no la necesita \n";
            $comida = trim(fgets(STDIN));
            if ($comida == 1 || $comida == 2) {
                $band = false;
            } else {
                echo "Opcion invalida \n";
            }
        } while ($band);
        do {
            echo "Ingrese 1 si necesita asistencia especial o 2 si no la necesita \n";
            $asistencia = trim(fgets(STDIN));
            if ($asistencia == 1 || $asistencia == 2) {
                $band = false;
            } else {
                echo "Opcion invalida \n";
            }
        } while ($band);
        $pasajero = new PasajeroConNecesidades($nombre, $apellido, $dni, $numero, $nroAsiento, $nroTicket, $silla == 1, $comida == 1, $asistencia == 1);
    }

    return $pasajero;
}

/**
 * @return ResponsableV retorna el responsable del viaje
 */
function crearResponsable()
{
    echo "Ingrese el número de empleado\n";
    $numero = trim(fgets(STDIN));
    echo "Ingrese el número de licencia\n";
    $licencia = trim(fgets(STDIN));
    echo "Ingrese el nombre\n";
    $nombre = trim(fgets(STDIN));
    echo "Ingrese el apellido\n";
    $apellido = trim(fgets(STDIN));
    return new ResponsableV($numero, $licencia, $nombre, $apellido);
}

function viajeInicial()
{
    $pasajeros = [];
    $pasajeros[0] = new Pasajero("Franco", "Benitez", 1231241241, 2229292, "N24", 5);
    $pasajeros[1] = new PasajeroVip("Juan", "Perez", 30303000, 298219292, "a4", 6, 1231, 50);
    $pasajeros[2] = new PasajeroConNecesidades("Maria", "Garcia", 12121212, 222123329292, "b9", 7, true, false, false);
    return new Viaje(1, "Neuquen", 10, $pasajeros, new ResponsableV(1234, "ab2", "Juana", "Arco"), 10000, 30000);
}

/**
 * Busca $num en $arr siendo un arreglo de pasajeros y devuelve el indice del elemento donde esta $num
 * o -1 si no lo encuentra
 * @param double 
 * @param array Un arreglo de pasajeros
 * @return int Retorna un indice o -1
 */
function buscar($num, $arr)
{
    $band = true;
    $res = -1;
    $lenght = count($arr);
    $n = 0;
    while ($n < $lenght and $band) {
        if (($arr[$n])->getDni() == $num) {
            $band = false;
            $res = $n;
        }
        $n++;
    }
    return $res;
}
