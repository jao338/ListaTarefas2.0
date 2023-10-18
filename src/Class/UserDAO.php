<?php

namespace Lista\Class;

class UserDAO{

    public function create(User $u){

        $sql = "INSERT INTO Users (Nome, Login, Senha) VALUES (?,?,?)";

        $stmt = Connect::Connect()->prepare($sql);

        $stmt->bindValue(1, $u->getNome());
        $stmt->bindValue(2, $u->getLogin());
        $stmt->bindValue(3, $u->getSenha());

        $stmt->execute();
    }

    public function update(User $u){

    }

    public function read(){

    }

    public function delete($id){

    }
    
    public function selectLogin($login){

        $sql = "SELECT * FROM Users WHERE Login = '$login'";

        $stmt = Connect::Connect()->prepare($sql);

        $stmt->execute();

        if($stmt->rowCount() > 0){
            return true;
        }else{
            return false;
        }

    }

    public function selectUser($login){

        $sql = "SELECT Senha FROM Users WHERE Login = '$login'";

        $stmt = Connect::Connect()->prepare($sql);

        $stmt->execute();

        if($stmt->rowCount() > 0){

            return $stmt;
        }else{
            return NULL;
        }

    }
}

?>