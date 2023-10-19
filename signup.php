<?php

//  Inclui autoload das classes usando composer
require_once 'vendor/autoload.php';

session_start();

$user = new \Lista\Class\User;
$userDAO = new \Lista\Class\UserDAO;

//  Se existir algo em 'btn-send-signup' 
if(!isset($_POST['btn-send-signup'])):

    //  Se existir algo em 'nome', em 'login' e em 'senha' 
    if(isset($_POST['nome']) && isset($_POST['login']) && isset($_POST['senha'])):
        
        //  Atribui e filtra os resultados vindo a superglobal POST
        $nome = filter_input(INPUT_POST,'nome',FILTER_SANITIZE_SPECIAL_CHARS);
        $login = filter_input(INPUT_POST,'login',FILTER_SANITIZE_SPECIAL_CHARS);
        $senha = filter_input(INPUT_POST,'senha',FILTER_SANITIZE_SPECIAL_CHARS);

        //  Define uma variávl booleana.
        $bool = false;

        //  Percorre cada caractere da string $nome e verifica se é um número ou não. Caso seja um número, a variável $bool recebe true
        for ($i = 0; $i < strlen($nome); $i++) { 
            if(ctype_digit($nome[$i])){
                $bool = true;
                break;
            }
        }

        //  Verifca se entre $nome, $login e $senha existe algum vazio.
        if(empty($nome) || empty($login) || empty($senha)):

            //  Exibe uma mensagem de erro através da superglobal session
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

        //  Ocorre se $bool retornar true. Ou seja, caso dentro da string $nome exista algum número
        elseif( $bool ):

            //  Exibe uma mensagem de erro através da superglobal session
            $_SESSION['titulo'] = 'Nome inválido';
            $_SESSION['mensagem'] = 'Nome deve conter apenas letras';

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
                }

                ?>

                <script>
                    window.onload = function(){

                        //  Define um intervalo que redireciona para a index
                        setTimeout(() => {
                            
                            window.location.href = 'index.php';
                            
                        }, 1500);
                    }
                </script>
                
        <?php

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

    <script src="./node_modules/jquery/dist/jquery.min.js"></script>
    <script src="./node_modules/@popperjs/core/dist/umd/popper.min.js"></script>
    <script src="./node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="./src/js/script.js"></script>
    
</body>
</html>