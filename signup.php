<?php

require 'vendor/autoload.php';

use Lista\Class\User;

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

    </main>

    <script src="./node_modules/bootstrap/dist/js/bootstrap.min.js"></script>

</body>
</html>