<?php

    $bd_local="localhost";
    $bd_usuario="root";
    $bd_pass="";            //datos de para poderse conectar a la base de datos mysql 
    $bd_nombre="senanswer";
//conexion a bd
    $conexion=mysqli_connect($bd_local,$bd_usuario,$bd_pass,$bd_nombre); //aqui le mando conexion con las variables de arriba
    mysqli_set_charset($conexion,"utf8");             //para que la base de datos sea de caracter utf8
    if(mysqli_connect_errno($conexion)){         //este if se cumplira si la conexion falla y mostrara un mensaje
        echo "no hay conexion  a la bd";
        exit();
    }/*else{
        echo "si hay conexion  a la bd";                   probar la conexion   
    }*/
$nombre=$_POST["nombre"];
$apellido=$_POST["apellido"];         //creo unas variables y con el metodo $_post capturo los valores del formulario mediante el name=""
$correo=$_POST["correo"];
$pass=$_POST["pass"];


 //  este if me validad que el correo introducido sea letras o numeros o caracteres@caracteres.caracteres 
if(filter_var($correo, FILTER_VALIDATE_EMAIL)==false ){        
    echo'<script> alert ("correo incorrecto example@hotmail.com") ; 
    window.history.go(-1);
    </script>';
    exit;
    }
   //echo "llego el dato $apellido"                   para probar valor
   
   //aqui hago la consultas de insertar con las variables de arriba que habia capturado del formulario
   //consulta a realizar
   $consulta="INSERT INTO  aprendiz (nombre,apellido,correo,pass) VALUES ('$nombre','$apellido','$correo','$pass')";   
    //aqui abajo consulta si hay mas usuarios para no crear mas 
   $validar_correo=mysqli_query($conexion,"SELECT * FROM aprendiz where correo ='$correo' ") ;                 
   //echo"aqui llega";
 
    
       
   //echo"aqui pasa";
   //si entra a este if es por que van a registrar un correo que ya existe entonces con echo lo devuelvo una pagina atras y queda ne el formulario 
   if(mysqli_num_rows($validar_correo) >0){             //si ya hay otro con el mismo correo da el echo
        echo'<script> alert ("correo existente") ;     
             window.history.go(-1);
             </script>';
       exit;
    }
    
    //y aqui se hace el registro ya en la base de datos    si el registro es bueno me sale un mensaje registr correto y 
   $resultado=mysqli_query($conexion,$consulta);
   if($resultado==true){
        echo'<script> alert ("registro correcto") ;
            window.history.go(-1);
        </script>';
    }

    mysqli_close($conexion);    //aqui cierro la conexion a la base de datos
    
?>