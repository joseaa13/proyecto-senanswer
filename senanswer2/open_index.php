<?php
    $bd_local="localhost";
    $bd_usuario="root";
    $bd_pass="";            //datos de conexion
    $bd_nombre="senanswer";
       //conexion a bd
    $conexion=mysqli_connect($bd_local,$bd_usuario,$bd_pass,$bd_nombre);
    mysqli_set_charset($conexion,"utf8");
    if(mysqli_connect_errno($conexion)){
        echo "no hay conexion  a la bd";
        exit();
    }/*else{
        echo "si hay conexion  a la bd";                  // probar la conexion   
    }*/

    $correo=$_POST["correo"];
    $pass=$_POST["pass"];

    $queryUser=mysqli_query($conexion,"SELECT nombre FROM aprendiz WHERE correo='$correo'");
    $nameUser=mysqli_fetch_array($queryUser);
    $name=$nameUser['nombre'];
    $comprobar_email=mysqli_query($conexion,"SELECT * FROM aprendiz WHERE correo='$correo'");
    $comprobar_pass=mysqli_query($conexion , "SELECT * FROM aprendiz WHERE pass='$pass'");
    $print=mysqli_num_rows($comprobar_email);
    $hola='hola';
    
    //if($comprobar_email==true && $comprobar_pass==true){
    if(mysqli_num_rows($comprobar_email) >0 && mysqli_num_rows($comprobar_pass) >0 ) {
        echo "" ;    
        header('location:index_proye.html');
       
        
        
        exit;
    }else{
        echo "<script> alert ('datos incorretos');window.history.go(-1); 
            </script>";
            
    }
   
   
?>