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
                    //  Seleciona o elemento 'card-message'
                    let message = document.querySelector('.card-message');

                    //  Define o display para 'block' (por padrão está definido como 'none')
                    message.style.display = 'block';

                    //  Determina um intervalo de 5 segundos que o elemento ficará visível.
                    setTimeout(() => {
                        message.style.display = 'none';
                        
                    }, 5000);
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
                                //  Seleciona o elemento 'card-message'
                                let message = document.querySelector('.card-message');

                                //  Define o display para 'block' (por padrão está definido como 'none')
                                message.style.display = 'block';

                                //  Determina um intervalo de 5 segundos que o elemento ficará visível.
                                setTimeout(() => {
                                    message.style.display = 'none';
                                    
                                }, 5000);
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

                        $_SESSION['titulo'] = 'Usuário inexistente';
                        $_SESSION['mensagem'] = 'Usuário não encontrado';

                        ?>

                        <script>
                            window.onload = function(){
                                //  Seleciona o elemento 'card-message'
                                let message = document.querySelector('.card-message');

                                //  Define o display para 'block' (por padrão está definido como 'none')
                                message.style.display = 'block';

                                //  Determina um intervalo de 5 segundos que o elemento ficará visível.
                                setTimeout(() => {
                                    message.style.display = 'none';
                                    
                                }, 5000);
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

                    <label for="login" class="label">Login</label class="label">
                    <input type="text" name='login' id='login' class="input rounded border border-primary">

                    <label for="senha" class="label">Senha</label>
                    <input type="password" name='senha' id='senha' class="input rounded border border-primary">

                    <div class="d-flex justify-content-between">
                        
                        <a href="#" class="text-decoration-none">Esqueci minha senha</a>

                        <div>
                            <input type="checkbox" name="remember-flag" id="remember-flag">
                            <label for="remember-flag">Lembrar de mim</label>
                        </div>
                    </div>
                    <button type="submit" name="btn-send-login" class="btn btn-primary rounded btn-send-login">Log in</button>
                </form>
            </div>
        </div>

        <a href="index.php" class="text-decoration-none arrow-prev-a border rounded-circle">
            <img src="src/assets/icons/arrow.png" width="32" height="32" class="arrow-prev-img">
        </a>

        <div class="card-message border">
        <div class="card-header-message d-flex justify-content-between align-item-center border">
            <div class="d-flex align-items-center pL-16">
                <?php echo $_SESSION['titulo']; ?>
            </div>
            <div class="closeModal d-flex align-items-center pR-8" style="cursor: pointer;">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                    <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/>
                </svg>
            </div>
        </div>

        <div class="card-body-message d-flex justify-content-center align-item-center text-center p-16">
            <?php echo $_SESSION['mensagem']; ?>
        </div>
    </div>


    </main>

    <script src="./node_modules/jquery/dist/jquery.min.js"></script>
    <script src="./node_modules/@popperjs/core/dist/umd/popper.min.js"></script>
    <script src="./node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="./src/js/script.js"></script>

</body>
</html>