<?php

//  Inclui autoload das classes usando composer
require_once 'vendor/autoload.php';

session_start();

$user = new \Lista\Class\User;
$userDAO = new \Lista\Class\UserDAO;

//  Se existir algo em 'btn-send-signup' 
if(isset($_POST['btn-send-reset'])):

    //  Se existir algo em 'nome', em 'login' e em 'senha' 
    if(isset($_POST['login']) && isset($_POST['senha']) && isset($_POST['novaSenha']) && isset($_POST['confirmaSenha'])):
        
        //  Atribui e filtra os resultados vindo a superglobal POST
        $login = $_POST['login'];
        $senha = $_POST['senha'];
        $novaSenha = $_POST['novaSenha'];
        $confirmaSenha = $_POST['confirmaSenha'];

        //  Verifca se entre $nome, $login e $senha existe algum vazio.
        if(empty($login) || empty($senha) || empty($novaSenha) || empty($confirmaSenha)):

            //  Exibe uma mensagem de erro através da superglobal session
            $_SESSION['titulo'] = 'Campos inválidos';
            $_SESSION['mensagem'] = 'Preencha todos os campos';

            ?>

            <script>
                window.onload = function(){
                    let modal = new bootstrap.Modal(document.getElementById('modalReset'), {
                        keyboard: false
                    })

                    modal.show();
                }
            </script>

        <?php

        //  
        elseif(!$userDAO->selectLogin($login)):

            //  Exibe uma mensagem de erro através da superglobal session
            $_SESSION['titulo'] = 'Usuário não encontrado';
            $_SESSION['mensagem'] = 'Usuário inexistente';

            ?>

            <script>
                window.onload = function(){
                    let modal = new bootstrap.Modal(document.getElementById('modalReset'), {
                        keyboard: false
                    })

                    modal.show();
                }
            </script>

        <?php

            else:

                //  Define um array com um índice chamado 'cost'.
                $options = [
                    'cost' => 10
                ];

                //  Criptografa $senha com criptografia do tipo bcrypt com custo 10 (o padrão também é 10) definido em $options
                $hash = password_hash($senha, PASSWORD_DEFAULT, $options);
                
                $_SESSION['login'] = $login;

                //  Define os atributos do usuário com os Gettters e Setters
                $user->setNome($nome);
                $user->setLogin($login);
                $user->setSenha($hash);

                //  Chama a função 'create' que recebe como parâmetro um objeto da classe User
                $userDAO->create($user);

                foreach($userDAO->selectUser($login) as $item){
                    $_SESSION['id'] = $item['Id'];
                    $_SESSION['nome'] = $item['Nome'];
                    $_SESSION['login'] = $item['Login'];
                    $_SESSION['img'] = $item['Img'];

                    header('Location: index.php');
                }

            endif;
    endif;
    
endif;


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de tarefas 2.0 - Signup</title>
    <link rel="stylesheet" href="src/css/style.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700;800&display=swap" rel="stylesheet">
</head>
<body>
    
    <main class="container-fluid">
            
        <div class="row d-flex">
            <div class="d-flex justify-content-center align-items-center col-md-6 left">
                <img src="src/assets/img/reset.svg" alt="" class="w-75">
            </div>
            <div class="d-flex justify-content-center align-items-center col-md-6 right">
                <form action="<?php echo $_SERVER['PHP_SELF'];?>", method="POST" class="form-signup d-flex flex-column">
                    <h2 class="mB-24">Sign up</h2>

                    <div class="input-group mB-16">
                        <span class="input-group-text border border-primary pL-8 pR-8 pT-8 pB-8">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-at" viewBox="0 0 16 16">
                                <path d="M13.106 7.222c0-2.967-2.249-5.032-5.482-5.032-3.35 0-5.646 2.318-5.646 5.702 0 3.493 2.235 5.708 5.762 5.708.862 0 1.689-.123 2.304-.335v-.862c-.43.199-1.354.328-2.29.328-2.926 0-4.813-1.88-4.813-4.798 0-2.844 1.921-4.881 4.594-4.881 2.735 0 4.608 1.688 4.608 4.156 0 1.682-.554 2.769-1.416 2.769-.492 0-.772-.28-.772-.76V5.206H8.923v.834h-.11c-.266-.595-.881-.964-1.6-.964-1.4 0-2.378 1.162-2.378 2.823 0 1.737.957 2.906 2.379 2.906.8 0 1.415-.39 1.709-1.087h.11c.081.67.703 1.148 1.503 1.148 1.572 0 2.57-1.415 2.57-3.643zm-7.177.704c0-1.197.54-1.907 1.456-1.907.93 0 1.524.738 1.524 1.907S8.308 9.84 7.371 9.84c-.895 0-1.442-.725-1.442-1.914z"/>
                            </svg>
                        </span>
                        <input type="text" name="login" id="login" class="pL-16 form-control border border-primary" placeholder="Login">
                    </div>

                    <div class="input-group mB-24">
                        <span class="input-group-text border border-primary pL-8 pR-8 pT-8 pB-8">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-lock" viewBox="0 0 16 16">
                                <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2zM5 8h6a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1z"/>
                            </svg>
                        </span>
                        <input type="password" name="senha" id="senha" class="pL-16 form-control border border-primary" placeholder="Password">
                    </div>

                    <div class="input-group mB-24">
                        <span class="input-group-text border border-primary pL-8 pR-8 pT-8 pB-8">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-lock" viewBox="0 0 16 16">
                                <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2zM5 8h6a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1z"/>
                            </svg>
                        </span>
                        <input type="password" name="novaSenha" id="novaSenha" class="pL-16 form-control border border-primary" placeholder="New Password">
                    </div>

                    <div class="input-group mB-24">
                        <span class="input-group-text border border-primary pL-8 pR-8 pT-8 pB-8">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-lock" viewBox="0 0 16 16">
                                <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2zM5 8h6a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1z"/>
                            </svg>
                        </span>
                        <input type="password" name="confirmaSenha" id="confirmaSenha" class="pL-16 form-control border border-primary" placeholder="Confirm Password">
                    </div>

                    <button type="submit" name="btn-send-reset" class="btn btn-primary rounded btn-send-signup">Change</button>

                </form>
            </div>
        </div>

        <a href="index.php" class="text-decoration-none arrow-prev-a border rounded-circle">
            <img src="src/assets/icons/arrow.png" width="32" height="32" class="arrow-prev-img">
        </a>

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <div class="modal" id="modalReset" tabindex="-1">
                <div class="modal-dialog pL-8 pR-8">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mx-0 pL-16 pR-16"><?php echo $_SESSION['titulo']; ?></h5>
                    </div>
                    <div class="modal-body">
                        <p class="pL-16 pR-16"><?php echo $_SESSION['mensagem']; ?></p>
                    </div>
                    <div class="modal-footer pR-8">
                        <button type="button" data-bs-dismiss="modal" class="btn btn-outline-primary pL-16 pR-16">Ok</button>
                    </div>
                    </div>
                </div>
            </div>
        </form>

    </main>

    <script src="./node_modules/jquery/dist/jquery.min.js"></script>
    <script src="./node_modules/@popperjs/core/dist/umd/popper.min.js"></script>
    <script src="./node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    
</body>
</html>