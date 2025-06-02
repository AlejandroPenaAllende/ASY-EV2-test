<?php
    include 'connection.php';

    $user_email = $_POST['user_email'];
    $user_pass = $_POST['user_pass'];

    
    $isValidLogin = mysqli_query($connection, "SELECT * FROM user WHERE user_email='$user_email' AND user_password='$user_pass'");
    /*Obtener datos del user*/
    $login = "SELECT * FROM user WHERE user_email='$user_email' AND user_password='$user_pass'";
    $query = mysqli_query($connection, $login);
    /*Validar credenciales ingresadas*/
    if(mysqli_num_rows($isValidLogin)>0){
        $data = mysqli_fetch_assoc($query);
        $da_name = $data['user_name'];
        $da_email = $data['user_email'];
        $da_type = $data['user_type'];
        $da_id = $data['id'];
        /*Guardar datos en un sessionstorage*/
        echo "<script>
                sessionStorage.setItem('user_name', '$da_name');
                sessionStorage.setItem('user_email', '$da_email');
                sessionStorage.setItem('user_type', '$da_type');
                sessionStorage.setItem('user_id', '$da_id');
                window.location = '../HTML/gallery.html';
              </script>";
    }else{
        echo '<script>
                alert("Las credenciales ingresadas no son invalidas");
                window.location = "../index.html";
              </script>';
    };
?>