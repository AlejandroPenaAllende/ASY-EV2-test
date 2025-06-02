<?php
    include 'connection.php';

    $user_name = $_POST['user_name'];
    $user_email = $_POST['user_email'];
    $user_pass = $_POST['user_pass'];

    $insert_user = "INSERT INTO user(user_name, user_email, user_password, user_type)
                    VALUES ('$user_name', '$user_email', '$user_pass', 'customer')";


    /*Verificar si el correo ya esta registrado*/
    $isRegistered = mysqli_query($connection, "SELECT * FROM user WHERE user_email='$user_email'");
    if(mysqli_num_rows($isRegistered)>0){
        echo '<script>
                alert("El correo ingresado ya se encuentra registrado");
                window.location = "../HTML/register.html"
             </script>';

        exit();
    }

    /*Ingresar usuario y redireccionar al portal virutal*/
    $register_user = mysqli_query($connection, $insert_user);
    /*Obtener datos del user*/
    $login = "SELECT * FROM user WHERE user_email='$user_email' AND user_password='$user_pass'";
    $query = mysqli_query($connection, $login);

    if($register_user){
        $data = mysqli_fetch_assoc($query);
        $da_name = $data['user_name'];
        $da_email = $data['user_email'];
        $da_type = $data['user_type'];
        $da_id = $data['id'];
        
        $salute = "!Hola ";
        $account = ", tu cuenta fue registrada con exito!";
        $mensaje = $salute . $user_name . $account;
        echo "<script>
                sessionStorage.setItem('user_name', '$da_name');
                sessionStorage.setItem('user_email', '$da_email');
                sessionStorage.setItem('user_type', '$da_type');
                sessionStorage.setItem('user_id', '$da_id');
                alert('$mensaje');
                window.location = '../HTML/gallery.html';
              </script>";
    }

?>