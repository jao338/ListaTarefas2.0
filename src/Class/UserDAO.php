<?php

namespace Lista\Class;


class UserDAO{

    public function create(User $u){

        //  Testar
        $sql = "INSERT INTO `Users` (`Id`, `Nome`, `Login`, `Senha`) VALUES (NULL, '?', '?', '?');";

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