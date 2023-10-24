<?php

namespace Lista\Class;

class TaskDAO{

    public function create(Task $t){

    }

    public function read($idUsuario){

        $sql = "SELECT * FROM Tarefas WHERE Id_Usuario = ?";

        $stmt = Connect::Connect()->prepare($sql);

        $stmt->bindValue(1, $idUsuario);

        $stmt->execute();

        if($stmt->rowCount() > 0){
            
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }else{
            return NULL;
        }

    }

    public function update(Task $t){

    }

    public function delete($id){

    }

}

?>