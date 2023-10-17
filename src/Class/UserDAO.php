<?php

namespace Lista\Class;

class UserDAO{

    public function create(User $u){

        //  Testar
        //$sql = "INSERT INTO `Users` (`Id`, `Nome`, `Login`, `Senha`) VALUES (NULL, '?', '?', '?');";
        $sql = "INSERT INTO Users (Nome, Login, Senha) VALUES (?,?,?)";

        $stmt = Connect::Connect()->prepare($sql);

        $stmt->bindValue(1, $u->getNome());
        $stmt->bindValue(2, $u->getLogin());
        $stmt->bindValue(3, $u->getSenha());

        $stmt->execute();
    }

    public function update(User $u){

    }

    public function readLines(){

    }

    public function readLine($id){

    }

    public function delete($id){

    } 
}

?>