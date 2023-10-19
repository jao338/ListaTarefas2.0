<?php

    //  Inclui autoload das classes usando composer
    require_once 'vendor/autoload.php';

    session_start();

    //  Verifica se a superglobal session contém login e nome
    if(isset($_SESSION['login'])):

        else:
        
    endif;

    //  Caso exista algo em 'btn-logout' destroí a session
    if(isset($_POST['btn-logout'])):
        session_unset();
        session_destroy();
    else:
        endif;

    if(isset($_POST['btn-send-photo'])){
        
        $formatos = array('jpg', 'png', 'jpeg');
        $extensao = pathinfo($_FILES['arquivo']['name'], PATHINFO_EXTENSION);

        if(in_array($extensao, $formatos)){
            $pasta = "./src/arquivos/images/";

            $temp = $_FILES['arquivo']['tmp_name'];

            $name = uniqid().".{$extensao}";

            if(move_uploaded_file($temp, $pasta.$name)){
                echo 'Upload feito com sucesso';
            }else{
                echo 'Não foi possível fazer o upload';
            }
        }else{
            echo 'Formato inválido';
        }

    }

?>

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
                    <a href="login.php" style="color: white;" class="text-decoration-none">Login</a>
                    <a href="signup.php" style="color: white;" class="text-decoration-none">Signup</a>
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

        <div class="content">
            <div class="container">
                
                <div class="row">

                    <div class="row col-md-4 d-flex flex-column">
                        <div class="col-md-6 w-100">
                            <img src="./src/assets/img/google.png"alt="" class="w-75 border rounded-circle mB-40">
                                  
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                                <div class="input-group d-flex justify-content-end w-100 pR-16">
                                    <label for="arquivo" class="btn btn-outline-primary rounded-pill pL-8 pR-8">Escolha um arquivo</label>
                                    <input type="file" class="form-control" id="arquivo" name="arquivo">
                                    <button type="submit" class="btn btn-primary border rounded-pill mL-8 pR-16 pL-16" name="btn-send-photo">Enviar</button>
                                </div>
                            </form>

                        </div>

                        <div class="col-md-6 pT-16">
                            <h5>Nome: 
                                <?php 
                                    if(isset($_SESSION['nome'])){
                                        echo $_SESSION['nome'];
                                    }else{
                                        echo '';
                                    }
                                ?>
                            </h5>
                            <div>Login: 
                                <?php 
                                    if(isset($_SESSION['login'])){
                                        echo $_SESSION['login'];
                                    }else{
                                        echo '';
                                    }
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div></div>
                    </div>

                </div>

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
                        <a href="#" class="mR-16"><img src="./src/assets/img/google.png" width="32" height="32" alt=""></a>
                        <a href="#"class="mL-16"><img src="./src/assets/img/google.png" width="32" height="32" alt=""></a>
                    </div>
                </div>
            </div>

        </footer>

    </main>

    <script src="./node_modules/jquery/dist/jquery.min.js"></script>
    <script src="./node_modules/@popperjs/core/dist/umd/popper.min.js"></script>
    <script src="./node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <!--<script src="./src/js/script.js"></script>-->

</body>
</html>