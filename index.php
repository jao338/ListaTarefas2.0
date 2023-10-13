<?php

require_once 'vendor/autoload.php';

/*
$user = new \Lista\Class\User;
$userDAO = new \Lista\Class\UserDAO;

$user->setNome("João Henrique");
$user->setLogin("jao338");
$user->setLogin("123456");

$userDAO->create($user);
*/
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de tarefas 2.0</title>
    <link rel="stylesheet" href="src/css/style.min.css">
</head>
<body>
    
    <main class="container-fluid">
        <nav class="navbar fixed-top navbar-expand-lg menu">

            <div class="container">

                <a href="#" class="navbar-brand">
                    <img src="./src/assets/img/google.png" width="64" height="64" alt="">
                </a>

                <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" class="navbar-brand d-flex align-items-center">
                    <input class="form-control me-2 text-center" type="search" placeholder="Search" aria-label="Search">
                    <a href="#"><img src="./src/assets/img/google.png" width="32" alt=""></a>
                </form>

                <div class="navbar-brand">
                    <a href="login.php" style="color: white; text-decoration: none;">Login</a>
                    <a href="signup.php" style="color: white; text-decoration: none;">Signup</a>
                </div>

                <div class="navbar-brand">
                    <a href="#"><img src="./src/assets/img/google.png" width="32" height="32" alt=""></a>
                    <a href="#"><img src="./src/assets/img/google.png" width="32" height="32" alt=""></a>
                </div>

            </div>
        </nav>

        <div class="content">
            <div class="container">
                
            </div>
        </div>

        <footer class="container-fluid d-flex flex-column justify-content-center">

            <div class="container">
                <div class="row">
                    <div class="col-md-4 d-flex justify-content-center">
                        <p>João Henrique</p>
                    </div>

                    <div class="col-md-4 d-flex justify-content-center">
                        <p>CRUD - Lista de tarefas com PDO</p>
                    </div>

                    <div class="col-md-4 d-flex justify-content-center">
                        <a href="#" style="margin-right: 16px;"><img src="./src/assets/img/google.png" width="32" height="32" alt=""></a>
                        <a href="#" style="margin-left: 16px;"><img src="./src/assets/img/google.png" width="32" height="32" alt=""></a>
                    </div>
                </div>
            </div>

        </footer>

    </main>

    <script src="./node_modules/bootstrap/dist/js/bootstrap.min.js"></script>

</body>
</html>