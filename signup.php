<?php

require_once 'vendor/autoload.php';
session_start();

use Lista\Class\User;

if(!isset($_POST['btn-send-signup'])){

    if(isset($_POST['senha']) && isset($_POST['login']) && isset($_POST['senha'])){
        
        $nome = $_POST['nome'];
        $login = $_POST['login'];
        $senha = $_POST['senha'];

        if($nome = "" || $login == "" || $senha == ""){

            $_SESSION['mensagem'] = "Preencha todos os campos corretamente!";
            $_SESSION['titulo'] = "Campos inválidos";

            ?>

            <script>
                window.onload = function(){
                    let message = document.querySelector('.card-message');
                    message.style.display = 'block';
                }
            </script>

        <?php
        
        }else{

        }
    }
    
}else{
    
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de tarefas 2.0 - Signup</title>
    <link rel="stylesheet" href="src/css/style.min.css">
</head>
<body>
    
    <main class="container-fluid">
            
        <div class="row d-flex" style="height: 100vh;">
            <div class="d-flex justify-content-center align-items-center col-md-6">
                <img src="src/assets/img/signup.svg" alt="" class="w-75">
            </div>
            <div class="d-flex justify-content-center align-items-center col-md-6">
                <form action="<?php echo $_SERVER['PHP_SELF'];?>", method="POST" class="form-signup d-flex flex-column">
                    <h2 class="">Sign up</h2>

                    <label for="nome" class="label">Nome</label class="label">
                    <input type="text" name='nome' id='nome' class="input rounded border border-primary">

                    <label for="login" class="label">Login</label>
                    <input type="text" name='login' id='login' class="input rounded border border-primary">

                    <label for="senha" class="label">Senha</label class="label">
                    <input type="password" name='senha' id='senha' class="input rounded border border-primary">

                    <button type="submit" class="btn btn-primary rounded btn-send-signup">Sign up</button>
                </form>
            </div>
        </div>

        <a href="index.php" class="text-decoration-none arrow-prev-a border rounded-circle">
            <img src="src/assets/icons/arrow.png" width="32" height="32" class="arrow-prev-img">
        </a>

    </main>


<div class="card-message border">
    <div class="card-header-message d-flex justify-content-between align-item-center border">
        <div class="d-flex align-items-center paddingL-16">
            <?php echo $_SESSION['titulo']; ?>
        </div>
        <div class="closeModal d-flex align-items-center paddingR-8" style="cursor: pointer;">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/>
            </svg>
        </div>
    </div>

    <div class="card-body-message d-flex justify-content-center align-item-center text-center padding-16">
        <?php echo $_SESSION['mensagem']; ?>
    </div>
</div>

    <script src="./node_modules/jquery/dist/jquery.min.js"></script>
    <script src="./node_modules/@popperjs/core/dist/umd/popper.min.js"></script>
    <script src="./node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="./src/js/script.js"></script>
    
</body>
</html>