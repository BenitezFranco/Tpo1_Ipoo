<?php
    include 'Viaje.php';

    $viaje= viajeInicial();

    do{
        $opcion= menuViaje();
        switch($opcion){
            case 1: 
                $viaje= ingresoViaje();
                break;
            case 2: 
                $viaje= modificarViaje($viaje);
                break;
            case 3:
                echo " ".$viaje->__toString()."\n";
                break;
            default: 
                break;
        };
    }while($opcion!=4);
    echo("Fin del programa");

    /**
     * Ingreso de un Viaje nuevo
     * @return Viaje
     */
    function ingresoViaje(){
        echo"Ingrese un codigo\n";
        $codigo= trim(fgets(STDIN));
        echo"Ingrese el destino\n";
        $destino= trim(fgets(STDIN));
        do{
            $band=true;
            echo"Ingrese la cantidad maxima de pasajeros\n";
            $cantidad= trim(fgets(STDIN));
            if($cantidad>0){
                $band=false;
            }
        }while($band);
        $pasajeros=crearPasajeros($cantidad);

        $responsable= crearResponsable();

        return new Viaje($codigo, $destino, $cantidad, $pasajeros, $responsable);
    }

    /**
     * Menu modificacion pasajero
     * @param Viaje
     * @return Viaje
     */

    function modificarViaje($viaje){
        do{
            $opcion= menuModificacion();
            switch($opcion){
                case 1: 
                    echo"Ingrese un codigo\n";
                    $codigo= trim(fgets(STDIN));
                    $viaje->setCodigo($codigo);
                    break;
                case 2: 
                    echo"Ingrese el destino\n";
                    $destino= trim(fgets(STDIN));
                    $viaje-> setDestino($destino);
                    break;
                case 3:
                    $viaje= modificarCantidad($viaje);
                    break;
                case 4:
                    $viaje= modificarResponsable($viaje);
                    break;
                case 5:
                    $viaje= modificarPasajeros($viaje);
                    break;
                default: 
                    break;
                };
        }while($opcion!=6);

        return $viaje;
    }

    /**
     * Modifica la cantidad maxima de pasajeros
     * @param Viaje
     * @param Viaje
     */
    function modificarCantidad($viaje){
        $min= count($viaje->getPasajeros());
        do{
            $band=true;
            echo"Ingrese la cantidad maxima de pasajeros\n";
            $cantidad= trim(fgets(STDIN));
            if($cantidad>0){
                if($cantidad>= $min){
                    $band=false;
                }else{
                    echo "La cantidad debe ser mayor a $min\n";
                }
            }else{
                echo "Cantidad invalida\n";
            }
        }while($band);

        $viaje->setCantidad($cantidad);

        return $viaje;
    }

    /**
     * Modifica el responsable
     * @param Viaje
     * @return Viaje
     */
    function modificarResponsable($viaje){

        do{
            $opcion= menuResponsable();
            switch($opcion){
                case 1: 
                    $responsable=crearResponsable();
                    $viaje-> setResponsable($responsable);
                    break;
                case 2: 
                    $viaje= modResponsable($viaje);
                    break;
                case 3:
                    $responsable= $viaje->getResponsable();
                    echo $responsable-> __toString()."\n";
                    break;
                default: 
                    break;
                };
        }while($opcion!=4);

        return $viaje;

    }

    function modResponsable($viaje){
        do{
            $opcion= menuModificarResponsable();
            switch($opcion){
                case 1: 
                    $responsable= $viaje-> getResponsable();
                    echo"Ingrese el numero de licencia\n";
                    $numero= trim(fgets(STDIN));
                    $responsable->setLicencia($numero);
                    $viaje-> setResponsable($responsable);
                    break;
                case 2: 
                    $responsable= $viaje-> getResponsable();
                    echo"Ingrese el nombre\n";
                    $nombre= trim(fgets(STDIN));
                    $responsable->setNombre($nombre);
                    $viaje-> setResponsable($responsable);
                    break;
                case 3:
                $responsable= $viaje-> getResponsable();
                echo"Ingrese el apellido\n";
                $apellido= trim(fgets(STDIN));
                $responsable->setApellido($apellido);
                $viaje-> setResponsable($responsable);
                    break;
                default: 
                    break;
                };
        }while($opcion!=4);

        return $viaje;
    }

    /**
     * Metodo para elegir que modificar
     * @param Viaje
     * @return Viaje Retorna el viaje con los pasajeros modificados
     */
    function modificarPasajeros($viaje){
        do{
            $opcion= menuPasajeros();
            switch($opcion){
                case 1: 
                    $viaje= agregarPasajero($viaje);
                    break;
                case 2: 
                    $viaje= eliminarPasajero($viaje);
                    break;
                case 3:
                    $viaje= modificarPasajero($viaje);
                    break;
                default: 
                    break;
                };
        }while($opcion!=4);

        return $viaje;
    }

    /**
     * Agrega un pasajero
     * @param Viaje
     * @return Viaje Retorna un viaje con un pasajero mas
     */
    function agregarPasajero($viaje){
        $pasajeros=$viaje->getPasajeros();
        $cant= count($pasajeros);
        $cantidad= $viaje->getCantidad();
        if($cant<$cantidad){
            $pasajeros[$cant]= crearPasajero($pasajeros);
        }
        $viaje->setPasajeros($pasajeros);

        return $viaje;
    }

    /**
     * Elimina un pasajero usando el numero de documento
     * @param Viaje 
     * @return Viaje Retorna un viaje con un pasajero eliminado
     */
    function eliminarPasajero($viaje){
        $pasajeros= $viaje -> getPasajeros();
        do{
            $band=true;
            echo"Ingrese el numero de documento\n";
            $numero= trim(fgets(STDIN));
            if($numero>0){
                $id= buscar($numero,$pasajeros);
                if($id!=-1){
                    $band=false;
                }else{
                    echo"Numero de documento no encontrado\n";
                }
            }else{
                echo"Numero de documento invalido\n";
            }
        }while($band);
        $viajeros=[];
        $lenght= count($pasajeros);
        $ind=0;
        for($i=0; $i < $lenght;$i++){
            if($i!=$id){
                $viajeros[$ind]=$pasajeros[$i];
                $ind++;
            }
        }
        $viaje->setPasajeros($viajeros);
        return $viaje;
    }

    function modificarPasajero($viaje){

        $pasajeros= $viaje-> getPasajeros();
        do{
            $opcion= menuModificarPasajero();
            if($opcion!=4){
            do{
                $band=true;
                echo"Ingrese el numero de documento del pasajero a modificar\n";
                $dni= trim(fgets(STDIN));
                $indice=buscar($dni,$pasajeros);
                if($indice!=-1 and $dni>0){
                    $band=false;
                }else{
                    echo"Numero de documento invalido\n";
                }
            }while($band);

            switch($opcion){
                case 1: 
                    $viaje= cambiarNombre($viaje, $indice);
                    break;
                case 2: 
                    $viaje= cambiarApellido($viaje, $indice);
                    break;
                case 3:
                    $viaje= cambiarTelefono($viaje, $indice);
                    break;
                default: 
                    break;
                };
            }
        }while($opcion!=4);

        return $viaje;
    }
    /**
     * Cambia el nombre del pasajero en la posicion $indice
     * @param Viaje
     * @param int indice
     * @return Viaje 
     */
    function cambiarNombre($viaje, $indice){

        $pasajeros = $viaje-> getPasajeros();
        echo"Ingrese el nombre\n";
        $nombre= trim(fgets(STDIN));
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
    function cambiarApellido($viaje, $indice){

        $pasajeros = $viaje-> getPasajeros();
        echo"Ingrese el apellido\n";
        $apellido= trim(fgets(STDIN));
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
    function cambiarTelefono($viaje, $indice){

        $pasajeros = $viaje-> getPasajeros();
        do{
            $band=true;
            echo"Ingrese el numero de telefono\n";
            $telefono= trim(fgets(STDIN));
            if($telefono>0){
                $band=false;
            }else{
                echo"Numero de telefono invalido";
            }
        }while($band);
        $pasajeros[$indice]->setTelefono($telefono);
        $viaje->setPasajeros($pasajeros);
        return $viaje;
    }

    /**
     * Crea un arreglo de pasajeros
     * @param int Cantidad maxima de pasajeros
     * @return array Retorna un arreglo de pasajeros
     */
    function crearPasajeros($cantidad){
        do{
            $band=true;
            echo"Ingrese la cantidad de pasajeros a cargar(0 para no agregar)\n";
            $indice= trim(fgets(STDIN));
            if($indice>=0){
                if($indice <= $cantidad){
                    $band=false;
                }else{
                    echo"La cantidad debe ser menor a $cantidad";
                }
            }else{
                echo "Cantidad invalida";
            }
        }while($band);
        $pasajeros=[];
        for($i=0;$i<$indice;$i++){
            $pasajeros[$i]= crearPasajero($pasajeros);
        }

        return $pasajeros;
    }

    /**
     * Crea un pasajero
     * @param array Arreglo de pasajeros
     * @return Pasajero Retorna un pasajero
    */
    function crearPasajero($pasajeros){
        echo"Ingrese el nombre\n";
        $nombre= trim(fgets(STDIN));
        echo"Ingrese el apellido\n";
        $apellido= trim(fgets(STDIN));
        do{
            $band=true;
            echo"Ingrese el numero de documento\n";
            $dni= trim(fgets(STDIN));
            if(buscar($dni,$pasajeros)==-1 and $dni>0){
                $band=false;
            }else{
                echo"Numero de documento invalido";
            }
        }while($band);

        do{
            $band=true;
            echo"Ingrese el numero de telefono\n";
            $numero= trim(fgets(STDIN));
            if($numero>0){
                $band=false;
            }else{
                echo"Numero de telefono invalido";
            }
        }while($band);

        return new Pasajero($nombre, $apellido, $dni, $numero);

    }
    /**
     * @return ResponsableV retorna el responsable del viaje
     */
    function crearResponsable(){
        echo"Ingrese el número de empleado\n";
        $numero= trim(fgets(STDIN));
        echo"Ingrese el número de licencia\n";
        $licencia= trim(fgets(STDIN));
        echo"Ingrese el nombre\n";
        $nombre= trim(fgets(STDIN));
        echo"Ingrese el apellido\n";
        $apellido= trim(fgets(STDIN));
        return new ResponsableV($numero, $licencia, $nombre, $apellido);
    }

    //menu para el responsable
    function menuResponsable(){
        $band= true;
        do{
            echo 
            "Presione:  
            1 cambiar responsable
            2 modificar responsable
            3 ver informacion del responsable
            4 para salir\n";
            $opcion =  trim(fgets(STDIN));
            if($opcion>0 && $opcion<=4){
                $band=false;
            }else{
                echo "Opcion invalida\n";
            }
        }while($band);

        return $opcion;
    }

    //Menu para modificar al responsable
    function menuModificarResponsable(){
        $band= true;
        do{
            echo 
            "Presione:  
            1 cambiar número de licencia
            2 cambiar nombre
            3 cambiar apellido
            4 para salir\n";
            $opcion =  trim(fgets(STDIN));
            if($opcion>0 && $opcion<=4){
                $band=false;
            }else{
                echo "Opcion invalida\n";
            }
        }while($band);
        return $opcion;
    }

    //Menu para  Pasajeros
    function menuPasajeros(){
        $band =true;
        do{
            echo 
            "Presione:  
            1 agregar pasajero
            2 quitar pasajero
            3 modificar pasajero
            4 para salir\n";
            $opcion =  trim(fgets(STDIN));
            if($opcion>0 && $opcion<=4){
                $band=false;
            }else{
                echo "Opcion invalida\n";
            }
        }while($band);
        return $opcion;

    }

    //Menu para modificar un pasajero
    function menuModificarPasajero(){
        $band= true;
        do{
            echo 
            "Presione:  
            1 cambiar nombre
            2 cambiar apellido
            3 cambiar telefono
            4 para salir\n";
            $opcion =  trim(fgets(STDIN));
            if($opcion>0 && $opcion<=4){
                $band=false;
            }else{
                echo "Opcion invalida\n";
            }
        }while($band);
        return $opcion;
    }

    //Menu para modificar viajes
    function menuModificacion(){
        $band =true;
        do{
            echo 
            "Presione:  
            1 modificar codigo
            2 modificar destino 
            3 modificar cantidad
            4 modificar encargado de viaje
            5 modificar lista de pasajeros
            6 para salir\n";
            $opcion =  trim(fgets(STDIN));
            if($opcion>0 && $opcion<=6){
                $band=false;
            }else{
                echo "Opcion invalida\n";
            }
        }while($band);
        return $opcion;
    }

    //Menu para viaje
    function menuViaje(){
        $band =true;
        do{
            echo 
            "Presione:  
            1 para ingresar un viaje
            2 para modificar el viaje 
            3 para ver la informacion del viaje
            4 para salir\n";
            $opcion =  trim(fgets(STDIN));
            if($opcion>0 && $opcion<=4){
                $band=false;
            }else{
                echo "Opcion invalida\n";
            }
        }while($band);
        return $opcion;
    }

    function viajeInicial(){
        $pasajeros= [];
        $pasajeros[0]= new Pasajero("Franco", "Benitez", 1231241241, 2229292);
        $pasajeros[1]= new Pasajero("Juan", "Perez", 30303000, 298219292);
        $pasajeros[2]= new Pasajero("Maria", "Garcia", 12121212, 222123329292);
        return new Viaje(1, "Neuquen", 10, $pasajeros, new ResponsableV(1234,"ab2","Juana", "Arco") );
    }
    
    /**
     * Busca $num en $arr siendo un arreglo de pasajeros y devuelve el indice del elemento donde esta $num
     * o -1 si no lo encuentra
     * @param double 
     * @param array Un arreglo de pasajeros
     * @return int Retorna un indice o -1
    */
    function buscar($num, $arr){
        $band=true;
        $res=-1;
        $lenght= count($arr);
        $n=0;
        while($n<$lenght and $band){
            if(($arr[$n])->getDni() ==$num){
                $band=false;
                $res=$n;
            }
            $n++;
        }
        return $res;
    }
