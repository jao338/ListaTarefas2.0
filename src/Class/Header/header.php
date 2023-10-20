
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de tarefas 2.0 - Index</title>
    <link rel="stylesheet" href="src/css/style.min.css">
</head>
<body>
    
    <main class="container-fluid">
        <nav class="navbar fixed-top navbar-expand-lg menu">

            <div class="container d-flex align-items-center">

                <a href="#" class="navbar-brand">
                    <img src="./src/assets/img/google.png" width="64" height="64" alt="">
                </a>

                <div class="navbar-brand d-flex align-items-center">
                    <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" class="d-flex">
                        <input class="form-control me-2 text-center" type="search" placeholder="Search" aria-label="Search">
                        <button type="submit" class="btn btn-primary btn-search rounded-circle" name="btn-search">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                            </svg>
                        </button>
                    </form>
                </div>

                <div class="navbar-brand log">

                <?php
                
                    if(!isset($_SESSION['login'])):
                        
                        ?>

                        <a href="login.php" class="text-decoration-none" style="color: white;">Login</a>
                        <a href="signup.php" class="text-decoration-none" style="color: white;">Signup</a>

                    <?php
                    else:

                        ?>

                        <a href="profile.php" class="text-decoration-none" style="color: white;">Meu perfil</a>

                        <?php
                    endif;
                ?>

                </div>

                <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" class="d-flex">
                    <button type="submit" class="btn btn-primary btn-logout rounded-circle" name="btn-logout">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-box-arrow-in-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0v-2z"/>
                        <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                    </svg>
                    </button>
                </form>    

            </div>
        </nav>