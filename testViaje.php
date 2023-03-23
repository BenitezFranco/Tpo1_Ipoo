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
                $viaje= modificarPasajero($viaje);
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

        return new Viaje($codigo, $destino, $cantidad, $pasajeros);
    }

    /**
     * Menu modificacion pasajero
     * @param Viaje
     * @return Viaje
     */

    function modificarPasajero($viaje){
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
                    $viaje= modificarPasajeros($viaje);
                    break;
                default: 
                    break;
                };
        }while($opcion!=5);

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
     * Metodo para elegir que modificar
     * @param Viaje
     * @return Viaje Retorna el viaje con los pasajeros 
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
                default: 
                    break;
                };
        }while($opcion!=3);

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
     * @return array Retorna un pasajero
    */
    function crearPasajero($pasajeros){
        echo"Ingrese el nombre\n";
        $nombre= trim(fgets(STDIN));
        echo"Ingrese el apellido\n";
        $apellido= trim(fgets(STDIN));
        do{
            $band=true;
            echo"Ingrese el numero de documento\n";
            $numero= trim(fgets(STDIN));
            if(buscar($numero,$pasajeros)==-1){
                $band=false;
            }else{
                echo"Numero de documento invalido";
            }
        }while($band);
        return ["nombre"=> $nombre,"apellido"=>$apellido,"numero de documento"=> $numero];

    }

    //Menu para modificar Pasajeros
    function menuPasajeros(){
        $band =true;
        do{
            echo 
            "Presione:  
            1 agregar pasajero
            2 quitar pasajero
            3 para salir\n";
            $opcion =  trim(fgets(STDIN));
            if($opcion>0 && $opcion<=3){
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
            4 modificar lista de pasajeros
            5 para salir\n";
            $opcion =  trim(fgets(STDIN));
            if($opcion>0 && $opcion<=5){
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
        $pasajeros[0]= ["nombre"=> "Franco","apellido"=>"Benitez","numero de documento"=> 12345678];
        $pasajeros[1]= ["nombre"=> "Juan","apellido"=>"Perez","numero de documento"=> 12312378];
        $pasajeros[2]= ["nombre"=> "Maria","apellido"=>"Gonzales","numero de documento"=> 87654321];
        return new Viaje(1, "Neuquen", 10, $pasajeros );
    }
    
    /**
     * Busca $num en $arr siendo un arreglo de arreglos asociativos y devuelve el indice del elemento donde esta $num
     * o -1 si no lo encuentra
     * @param double 
     * @param array Un arreglo de arreglos asociativos
     * @return int Retorna un indice o -1
    */
    function buscar($num, $arr){
        $band=true;
        $res=-1;
        $lenght= count($arr);
        $n=0;
        while($n<$lenght and $band){
            if(($arr[$n])["numero de documento"] ==$num){
                $band=false;
                $res=$n;
            }
            $n++;
        }
        return $res;
    }
?>