<?php

//  Inclui autoload das classes usando composer
require 'vendor/autoload.php';

//$user = new \Lista\Class\User;
$userDAO = new \Lista\Class\UserDAO;

session_start();

    if(isset($_POST['btn-send-login'])):

        if(isset($_POST['login']) && isset($_POST['senha'])):
    
            $login = filter_input(INPUT_POST,'login',FILTER_SANITIZE_SPECIAL_CHARS);
            $senha = $_POST['senha'];
            
            if(empty($login) || empty($senha)):

                $_SESSION['titulo'] = 'Campos inválidos';
                $_SESSION['mensagem'] = 'Preencha todos os campos';

            ?>

            <script>
                window.onload = function(){
                    let modal = document.querySelector('#modalLogin');

                    modal.style.display = 'flex';

                }
            </script>

            <?php

                else:

                    if($userDAO->selectLogin($login)):

                        $hashBD = implode($userDAO->selectPass($login));
                        
                        if(!password_verify($senha, $hashBD)):
                            
                            $_SESSION['titulo'] = 'Campos inválidos';
                            $_SESSION['mensagem'] = 'Login ou senha incorretos';

                        ?>

                        <script>
                            window.onload = function(){
                                let modal = document.querySelector('#modalLogin');

                                modal.style.display = 'flex';
                            }
                        </script>

                        <?php

                            else:

                                foreach($userDAO->selectUser($login) as $item){

                                    session_unset();

                                    $_SESSION['id'] = $item['Id'];
                                    $_SESSION['nome'] = $item['Nome'];
                                    $_SESSION['login'] = $item['Login'];
                                    $_SESSION['img'] = $item['Img'];
                                }

                                header('Location: index.php');

                        endif;
                        
                    else:

                        $_SESSION['titulo'] = 'Campos inválidos';
                        $_SESSION['mensagem'] = 'Login ou senha incorretos';

                        ?>

                        <script>
                            window.onload = function(){
                                let modal = document.querySelector('#modalLogin');

                                modal.style.display = 'flex';
                            }
                        </script>

                        <?php
                        
                    endif;

            endif;

        endif;

    endif;


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de tarefas 2.0 - Login</title>
    <link rel="stylesheet" href="src/css/style.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700;800&display=swap" rel="stylesheet">

</head>
<body>
    
    <main class="container-fluid">
            
        <div class="row d-flex">
            <div class="d-flex justify-content-center align-items-center col-md-6 left">
                <img src="src/assets/img/login.svg" alt="" class="w-75">
            </div>
            <div class="d-flex justify-content-center align-items-center col-md-6 right">
                <form action="<?php echo $_SERVER['PHP_SELF'];?>"method="POST" class="form-signup d-flex flex-column">

                    <h2 class="mB-16">Log in</h2>

                    <div class="input-group mB-16">
                        <span class="input-group-text border border-primary pL-8 pR-8 pT-8 pB-8">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-at" viewBox="0 0 16 16">
                                <path d="M13.106 7.222c0-2.967-2.249-5.032-5.482-5.032-3.35 0-5.646 2.318-5.646 5.702 0 3.493 2.235 5.708 5.762 5.708.862 0 1.689-.123 2.304-.335v-.862c-.43.199-1.354.328-2.29.328-2.926 0-4.813-1.88-4.813-4.798 0-2.844 1.921-4.881 4.594-4.881 2.735 0 4.608 1.688 4.608 4.156 0 1.682-.554 2.769-1.416 2.769-.492 0-.772-.28-.772-.76V5.206H8.923v.834h-.11c-.266-.595-.881-.964-1.6-.964-1.4 0-2.378 1.162-2.378 2.823 0 1.737.957 2.906 2.379 2.906.8 0 1.415-.39 1.709-1.087h.11c.081.67.703 1.148 1.503 1.148 1.572 0 2.57-1.415 2.57-3.643zm-7.177.704c0-1.197.54-1.907 1.456-1.907.93 0 1.524.738 1.524 1.907S8.308 9.84 7.371 9.84c-.895 0-1.442-.725-1.442-1.914z"/>
                            </svg>
                        </span>
                        <input type="text" name="login" id="login" class="pL-16 form-control border border-primary" placeholder="Login">
                    </div>

                    <div class="input-group mB-16">
                        <span class="input-group-text border border-primary pL-8 pR-8 pT-8 pB-8">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-lock" viewBox="0 0 16 16">
                                <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2zM5 8h6a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1z"/>
                            </svg>
                        </span>
                        <input type="password" name="senha" id="senha" class="pL-16 form-control border border-primary" placeholder="Password">
                    </div>

                    <div class="d-flex justify-content-between">
                        
                        <a href="resetpass.php" class="link-login text-decoration-none" >Esqueci minha senha</a>
                        <a href="signup.php" class="link-login text-decoration-none" >Não tem cadastro?</a>
                         
                    </div>
                    <button type="submit" name="btn-send-login" class="btn btn-primary rounded btn-send-login">Log in</button>
                    <!-- <button type="button" data-bs-toggle="modal" data-bs-target="#modalLogin" class="btn btn-primary pR-16 pL-16 rounded-pill">Login</button> -->
                </form>
            </div>
        </div>

        <a href="index.php" class="text-decoration-none arrow-prev-a border rounded-circle">
            <img src="src/assets/icons/arrow.png" width="32" height="32" class="arrow-prev-img">
        </a>

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <div class="modal" id="modalLogin" tabindex="-1">
                <div class="modal-dialog pL-8 pR-8">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mx-0 pL-16 pR-16 modal-login-title"><?php echo $_SESSION['titulo']; ?></h5>
                    </div>
                    <div class="modal-body">
                        <p class="pL-16 pR-16 modal-login-body"><?php echo $_SESSION['mensagem']; ?></p>
                    </div>
                    <div class="modal-footer pR-8">
                        <button type="button" class="btn btn-outline-primary pL-16 pR-16 close-modal-login">Ok</button>
                    </div>
                    </div>
                </div>
            </div>
        </form>
    </main>

    <script src="./node_modules/jquery/dist/jquery.min.js"></script>
    <script src="./node_modules/@popperjs/core/dist/umd/popper.min.js"></script>
    <script src="./node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="./src/js/script.js"></script>

    <script>

        document.querySelector('.close-modal-login').addEventListener('click', () => {

        let modalMessage = document.querySelector('#modalLogin');

        modalMessage.style.opacity = '0';    
        modalMessage.style.display = "none";

        });

    </script>

</body>
</html>