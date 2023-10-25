<?php

namespace Lista\Class;

class TaskDAO{

    public function create(Task $t){

        $sql = "INSERT INTO Tarefas (Titulo, Descricao, Status, Id_Usuario) VALUES (?,?,?,?)";

        $stmt = Connect::Connect()->prepare($sql);

        $stmt->bindValue(1, $t->getTitulo());
        $stmt->bindValue(2, $t->getDescricao());
        $stmt->bindValue(3, $t->getStatus());
        $stmt->bindValue(4, $t->getIdUsuario());

        $stmt->execute();

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

        $sql = "UPDATE Tarefas SET Titulo = ?, Descricao = ?, Status = ? WHERE Id = ?";

        $stmt = Connect::Connect()->prepare($sql);

        $stmt->bindValue(1, $t->getTitulo());
        $stmt->bindValue(2, $t->getDescricao());
        $stmt->bindValue(3, $t->getStatus());
        $stmt->bindValue(4, $t->getId());

        $stmt->execute();

    }

    public function delete($id){

        $sql = "DELETE FROM Tarefas WHERE Id = ?";

        $stmt = Connect::Connect()->prepare($sql);

        $stmt->bindValue(1, $id);

        $stmt->execute();
    }

}

?>