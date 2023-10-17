<?php

namespace Lista\Class;

class Connect{

    private static $instance;

    public static function Connect(){

        //  Verifica se existe uma instancia, se não houver uma instância é criada. Usa-se o "self", pois trata-se de um método estático. Retorna o atributo $instance.
        if(!isset(self::$instance)){
            self::$instance = new \PDO('mysql:host=localhost;dbname=TAREFAS;charset=utf8','root','');
        }

        return self::$instance;

    }

}

?>