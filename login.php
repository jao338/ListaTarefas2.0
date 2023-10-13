<?php

require 'vendor/autoload.php';

use Lista\Class\User;


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de tarefas 2.0 - Login</title>
    <link rel="stylesheet" href="src/css/style.min.css">
</head>
<body>
    
    <main class="container-fluid">
            
        <div class="row d-flex" style="height: 100vh;">
            <div class="d-flex justify-content-center align-items-center col-md-6">
                <img src="src/assets/img/login.svg" alt="" class="w-75">
            </div>
            <div class="d-flex justify-content-center align-items-center col-md-6">
                <form action="<?php echo $_SERVER['PHP_SELF'];?>"method="POST" class="form-signup d-flex flex-column">

                    <h2 class="">Log in</h2>

                    <label for="nome" class="label">Nome</label class="label">
                    <input type="text" name='nome' id='nome' class="input rounded border border-primary">

                    <label for="login" class="label">Login</label>
                    <input type="text" name='login' id='login' class="input rounded border border-primary">

                    <div class="d-flex justify-content-between">
                        
                        <a href="#" class="text-decoration-none">Esqueci minha senha</a>

                        <div>
                            <input type="checkbox" name="remember-flag" id="remember-flag">
                            <label for="remember-flag">Lembrar de mim</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary rounded btn-send-login">Log in</button>
                </form>
            </div>
        </div>

        <a href="index.php" class="text-decoration-none arrow-prev-a border rounded-circle">
            <img src="src/assets/icons/arrow.png" width="32" height="32" class="arrow-prev-img">
        </a>

    </main>

    <script src="./node_modules/bootstrap/dist/js/bootstrap.min.js"></script>

</body>
</html>