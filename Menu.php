<?php

class Menu{

    public function __construct()
    {
        
    }

    //Menu viaje
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

    //Menu para tipo pasajero

    function menuTipoPasajero(){
        $band =true;
        do{
            echo 
            "Presione:  
            1 agregar pasajero estandar
            2 agregar pasajero VIP
            3 agregar pasajero con necesidades\n";
            $opcion =  trim(fgets(STDIN));
            if($opcion>0 && $opcion<=3){
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
            4 cambiar nroAsiento
            5 cambiar nroTicket
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
    //Menu para modificar un pasajero VIP
    function menuModificarVIP(){
        $band= true;
        do{
            echo 
            "Presione:  
            1 cambiar nombre
            2 cambiar apellido
            3 cambiar telefono
            4 cambiar nroAsiento
            5 cambiar nroTicket
            6 cambiar numero pasajero frecuente
            7 cambiar millas
            8 para salir\n";
            $opcion =  trim(fgets(STDIN));
            if($opcion>0 && $opcion<=8){
                $band=false;
            }else{
                echo "Opcion invalida\n";
            }
        }while($band);
        return $opcion;
    }
    //Menu para modificar un pasajero con necesidades
    function menuModificarPasajeroConNecesidades(){
        $band= true;
        do{
            echo 
            "Presione:  
            1 cambiar nombre
            2 cambiar apellido
            3 cambiar telefono
            4 cambiar nroAsiento
            5 cambiar nroTicket
            6 cambiar si necesita silla
            7 cambiar si necesita comida
            8 cambiar si necesita asistencia
            9 para salir\n";
            $opcion =  trim(fgets(STDIN));
            if($opcion>0 && $opcion<=9){
                $band=false;
            }else{
                echo "Opcion invalida\n";
            }
        }while($band);
        return $opcion;
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


}