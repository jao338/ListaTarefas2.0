<?php

    //  Inclui autoload das classes usando composer

use Lista\Class\TaskDAO;

    require_once 'vendor/autoload.php';

    session_start();

    $user = new \Lista\Class\User;
    $userDAO = new \Lista\Class\UserDAO;
    $taskDAO = new \Lista\Class\TaskDAO;

    //  Caso exista algo em 'btn-send-photo' realiza o upload da imagem para o projeto
    if(isset($_POST['btn-send-photo'])):
        
        if(isset($_SESSION['login'])):
        
        //  Define quais formatos aceitáveis
        $formatos = array('jpg', 'png', 'jpeg');
        
        //  Recebe qual a extensão do arquivo temporário da superglobal $_FILES
        $extensao = pathinfo($_FILES['arquivo']['name'], PATHINFO_EXTENSION);

        //  Verifica se a extensão do arquivo temporário é aceitável
        if(in_array($extensao, $formatos)):

            //  Define qual o diretório será salvo o arquivo
            $pasta = "./src/arquivos/images/";

            //  Pega o nome do arquivo temporário
            $temp = $_FILES['arquivo']['tmp_name'];

            //  Define um novo nome ao arquivo
            // $name = $_SESSION['login'].".{$extensao}";
            $name = uniqid().".{$extensao}";

            //  Move o arquivo para a pasta correspondente
            if(move_uploaded_file($temp, $pasta.$name)):
                $_SESSION['upload'] = 'Upload feito com sucesso';

                $userDAO->insertPhoto($_SESSION['login'], $pasta.$name);

                $_SESSION['img'] = $pasta.$name;

            else:
                $_SESSION['upload'] = 'Não foi possível fazer o upload';
            endif;
        else:
            $_SESSION['upload'] = 'Formato inválido';
        endif;
        
        else:
            $_SESSION['upload'] = 'Faça login primeiro';

            header('Location: login.php');
        endif;

    endif;

    //  Caso exista algo em 'btn-logout' destroí a session e recarrega a página
    if(isset($_POST['btn-logout'])):
        
        session_unset();
        session_destroy();

        header('Location: index.php');
        else:
    endif;

    if(isset($_POST['btn-send-update'])):

        if(empty($_POST['loginProfile']) || empty($_POST['nomeProfile'])):
            
            //  Caso algum campo esteja vazio
            $_SESSION['titulo'] = 'Campos inválidos';
            $_SESSION['mensagem'] = 'Preencha todos os campos';

            ?>

            <script>
                
                window.onload = function(){
                    let modal = new bootstrap.Modal(document.getElementById('modalEdit'), {
                        keyboard: false
                    })

                    modal.show();
                }

            </script>

            <?php
            
        else:

            $nome = $_POST['nomeProfile'];
            $login = $_POST['loginProfile'];
            $id = $_POST['idProfile'];

            $user->setNome($nome);
            $user->setLogin($login);
            $user->setId($_SESSION['id']);

            $userDAO->update($user);

            session_unset();

            $_SESSION['login'] = $login;
            $_SESSION['nome'] = $nome;
            $_SESSION['id'] = $id;

            header("Location: profile.php");

        endif;

    else:
        
    endif;

    if(isset($_POST['btn-send-delete'])):

        if($taskDAO->selectTasks($_SESSION['id'])):
            $taskDAO->deleteTasks($_SESSION['id']);

            $userDAO->delete($_SESSION['id']);
            
            session_unset();
            session_destroy();

            header('Location: index.php');
        endif;

        else:
    endif;

    if(isset($_POST['btn-search'])):
        
        if(empty($_POST['input-search'])):

        else:

            if($taskDAO->select($_POST['input-search'], $_SESSION['id']) !== NULL){
                
                $titulo = $_POST['input-search'];
                $id = $_SESSION['id'];
                    
                header("Location: search.php?Titulo=$titulo&Id=$id");

            }else{
                header('Location: index.php');
            }
            
        endif;

    endif;

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de tarefas 2.0 - Perfil</title>
    <link rel="stylesheet" href="src/css/style.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700;800&display=swap" rel="stylesheet">
</head>
<body>
    
    <main class="container-fluid">

        <nav class="navbar fixed-top navbar-expand-lg menu">

            <div class="container d-flex align-items-center">

                <a href="index.php" class="navbar-brand">
                    <img src="./src/assets/img/google.png" width="64" height="64" alt="">
                </a>

                <div class="navbar-brand d-flex align-items-center">
                    <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" class="d-flex">
                        <input class="form-control me-2 text-center" type="search" placeholder="Search" aria-label="Search" name="input-search">
                        <button type="submit" class="btn btn-light btn-search rounded-circle" name="btn-search">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="black" class="bi bi-search" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                            </svg>
                        </button>
                    </form>
                </div>

                <div class="navbar-brand log">

                <?php
                
                    if(!isset($_SESSION['login'])):
                        
                        ?>

                        <a href="login.php" class="text-decoration-none btn btn-primary">Login</a>
                        <a href="signup.php" class="text-decoration-none btn btn-primary">Signup</a>

                    <?php
                    else:

                        ?>

                        <a href="index.php" class="text-decoration-none btn btn-light rounded-pill pR-16 pL-16">Home</a>

                        <?php
                    endif;
                ?>

                </div>

                <form action="index.php" method="POST" class="d-flex">
                    <button type="submit" class="btn btn-light btn-logout rounded-circle" name="btn-logout">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="black" class="bi bi-box-arrow-in-right" viewBox="0 0 16 16">
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

                <div class="col-md-4 d-flex flex-column justify-content-center" style="height: 72vh;">
                <div style="overflow: hidden; width: 300px !important; height: 300px !important;" class="col-md-6 d-flex justify-content-center align-items-center border rounded-circle">

                    <img src="<?php echo $_SESSION['img']; ?>" class="mB-16 border" alt="" style="transform: scale(.5);">

                </div>

                    <div class="col-md-6 pT-32 w-100" style="height: auto;">
                        <h5>Nome: 
                            <?php 
                                if(isset($_SESSION['nome'])){
                                    echo $_SESSION['nome'];
                                }else{
                                    
                                }
                            ?>
                        </h5>
                        <div>Login: 
                            <?php 
                                if(isset($_SESSION['login'])){
                                    echo $_SESSION['login'];
                                }else{
                                    
                                }
                            ?>
                        </div>

                    </div>
                </div>

                <div class="d-flex justify-content-center align-items-center flex-column col-md-8 ">

                    <h2 class="w-50 mB-32 title-pages">Meu perfil</h2>

                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" class="d-flex flex-column w-50" method="POST">
                        
                        <input type="hidden" name="idProfile" id="idProfile"  class="input border border-primary rounded mB-16 pL-16" value="<?php echo $_SESSION['id']; ?>">

                        <label for="nomeProfile" class="label">Nome: </label>
                        <input type="text" name="nomeProfile" id="nomeProfile" class="input border border-primary rounded mB-16 pL-16" value="<?php echo $_SESSION['nome']; ?>">
                        
                        <label for="loginProfile" class="label">Login: </label>
                        <input type="text" name="loginProfile" id="loginProfile" class="input border border-primary rounded mB-32 pL-16" value="<?php echo $_SESSION['login']; ?>">

                        <div class="d-flex justify-content-end">
                                
                            <div>
                                <button type="button" data-bs-toggle="modal" data-bs-target="#modalDelete" class="btn-send-update btn btn-outline-danger pR-16 pL-16 rounded-pill">Excluir</button>
                                <button type="submit" name="btn-send-update" class="btn-send-update btn btn-primary mL-16 pR-16 pL-16 rounded-pill">Salvar</button>
                            </div>
                        </div>
                    </form>
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
                        <a href="https://www.instagram.com/jao_338/" class="mR-16" target="_blank">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="white" class="bi bi-instagram" viewBox="0 0 16 16">
                                <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"/>
                            </svg>
                        </a>
                        <a href="https://github.com/jao338/" class="mL-16" target="_blank">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="white" class="bi bi-github" viewBox="0 0 16 16">
                                <path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.012 8.012 0 0 0 16 8c0-4.42-3.58-8-8-8z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

        </footer>

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <div class="modal" id="modalEdit" tabindex="-1">
                <div class="modal-dialog modal-sm pL-8 pR-8">
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

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <div class="modal" id="modalDelete" tabindex="-1">
                <div class="modal-dialog modal-lg pL-8 pR-8" >
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mx-0 pL-16">Deseja mesmo excluir o perfil?</h5>
                    </div>
                    <div class="modal-body">
                        <p class="pL-16"><?php echo $_SESSION['nome']; ?>, caso você delete seu perfil todas as suas tarefas serão deletadas.</p>
                        <p class="pL-16">Você tem certeza quer deletar o seu perfil?</p>
                    </div>
                    <div class="modal-footer pR-8">
                        <button type="button" class="btn btn-outline-primary pL-16 pR-16" data-bs-dismiss="modal">Não</button>
                        <button type="submit" name="btn-send-delete" class="btn btn-danger pL-16 pR-16" data-bs-dismiss="modal">Sim</button>
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