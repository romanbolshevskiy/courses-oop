<?php

class Cart{

    public static function allCart(){
        $db = Database::getConnection();
        $result = $db->prepare("SELECT * FROM cart ");
        $result->execute();
        $i = 0;
        while ($row = $result->fetch()) {
            $user[$i] = $row;
            $i++;
        }
        return $user;
    }

    public static function isItIdCU($idu,$idc){
        $db = Database::getConnection();
        $result = $db->prepare("SELECT COUNT(id_cart) as count FROM cart WHERE (id_c=:idc AND id_u=:idu)");
        $result->bindParam(':idu', $idu, PDO::PARAM_INT);
        $result->bindParam(':idc', $idc, PDO::PARAM_INT);
        $result->execute();
        $row = $result->fetch();// якшо не пусто то тру
        if($row['count'])  return true;
        else return false;
    }



   
    public static function addProduct($idu,$idc,$name,$url,$price){
        $db = Database::getConnection();
        $result = $db->prepare("INSERT INTO cart (id_u, id_c,name,url,price) VALUES (:idu,:idc,:name,:url,:price)");
        $result->bindParam(':idu', $idu, PDO::PARAM_INT);
        $result->bindParam(':idc', $idc, PDO::PARAM_INT);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':url', $url, PDO::PARAM_STR);
        $result->bindParam(':price', $price, PDO::PARAM_INT);
        return $result->execute();
    }




    public static function CartByUser($id) {
        $db = Database::getConnection();
        $result = $db->prepare("SELECT * FROM cart WHERE  id_u=:id");
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
        $i = 0;
        while ($row = $result->fetch()) {
            $course[$i] = $row;
            $i++;
        }
        return $course;
    }

    public static function SumCartByUser($id) {
        $db = Database::getConnection();
        $result = $db->prepare("SELECT SUM(price) as sum FROM cart WHERE  id_u=:id");
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
        $row = $result->fetch();// якшо не пусто то тру
        if($row['sum'])  return $row['sum'];
        else return false;
    }



    public static function CountCoursestByUser($id) {
        $db = Database::getConnection();
        $result = $db->prepare("SELECT COUNT(id_cart) as count FROM cart WHERE id_u=:id");
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
        $row = $result->fetch();// якшо не пусто то тру
        if($row['count'])  return $row['count'];
        else return false;
    }

     public static function getSum($id) {
        $db = Database::getConnection();
        $result = $db->prepare("SELECT SUM(price) as sum FROM courses LEFT JOIN cart ON courses.id_c = cart.id_c WHERE cart.id_c=:id");
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
        $row = $result->fetch();// якшо не пусто то тру
        if($row['sum'])  return $row['sum'];
        else return false;
    }


    public static function deleteProduct($id){
        $db = Database::getConnection();
        $result = $db->prepare("DELETE FROM cart WHERE id_cart=:id");
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
    }
    
  
    public static function deleteCartById($id){
        $db = Database::getConnection();
        $result = $db->prepare("DELETE FROM cart WHERE id_u=:id");
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
    }
}