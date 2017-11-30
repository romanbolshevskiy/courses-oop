<?php

class Chat {

    public static function send_messages($name, $txt) {
        $db = Database::getConnection();
        $result = $db->prepare("INSERT INTO messages (name,message,date) VALUES (:name,:txt,'".date("y:m:d H:m:s")."')");       
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':txt', $txt, PDO::PARAM_STR);
        return $result->execute();

    }

    public static function all_messages(){
        $db = Database::getConnection();
        $result = $db->prepare("SELECT * FROM messages ORDER BY id DESC");
        //$result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
        $i=0;
        while ($row = $result->fetch()) {
            $course[$i] = $row;
            $i++;
        }
        return $course;
    }

    public static function count_messages() {
        $db = Database::getConnection();
        $result = $db->prepare("SELECT count(id) as count FROM messages");
        $result->execute();
        $row = $result->fetch();// якшо не пусто то тру
        var_dump($row);
        if($row['count'])  return $row['count'];
        else return false;
    }

    
}