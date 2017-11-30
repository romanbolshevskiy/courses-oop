<?php

class Order{

    public static function saveOrder($userName, $userPhone, $userComment, $userEmail, $userId,$sum) {
        $userPhone=$userPhone; $userId = (int)$userId;     

        $db = Database::getConnection();
        $result = $db->prepare("INSERT INTO orders 
            (id_user,user, email, comment ,phone,total_price, date_creation) 
            VALUES 
            (:userId,:userName,:userEmail,:userComment ,:userPhone,:sum,'".date("y:m:d H:m:s")."')");       
        $result->bindParam(':userName', $userName, PDO::PARAM_STR);
        $result->bindParam(':userPhone', $userPhone, PDO::PARAM_STR);
        $result->bindParam(':userComment', $userComment, PDO::PARAM_STR);
        $result->bindParam(':userEmail', $userEmail, PDO::PARAM_STR);
        $result->bindParam(':userId', $userId, PDO::PARAM_INT); 
        $result->bindParam(':sum', $sum, PDO::PARAM_INT); 
     
        return $result->execute();

    }


    public static function saveOrderDetails($id_order, $name, $url, $price,$id_c) {
        $course_price = (int)$course_price;    $id_c = (int)$id_c;
        $db = Database::getConnection();
        $result = $db->prepare("INSERT INTO orders_details 
            (id_c, name, url, price , id_order) 
            VALUES 
            (:id_c, :name, :url, :price, :id_order)");       
        $result->bindParam(':id_order', $id_order, PDO::PARAM_INT); 
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':url', $url, PDO::PARAM_STR);
        $result->bindParam(':price', $price, PDO::PARAM_INT);
        $result->bindParam(':id_c', $id_c, PDO::PARAM_INT);
        return $result->execute();

    }


    public static function CartBoughtByUser($id) {
        $db = Database::getConnection();
        $result = $db->prepare("SELECT * FROM orders WHERE ((id_user=:id) AND (bought=1))");
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
        $i = 0;
        while ($row = $result->fetch()) {
            $course[$i] = $row;
            $i++;
        }
        return $course;
    }


    public static function CartProcessingByUser($id) {
        $db = Database::getConnection();
        $result = $db->prepare("SELECT * FROM orders WHERE ((id_user=:id) AND (bought=0 ))");
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
        $i = 0;
        while ($row = $result->fetch()) {
            $course[$i] = $row;
            $i++;
        }
        return $course;
    }


    public static function OrderInfo($id_order) {
        $db = Database::getConnection();
        $result = $db->prepare("SELECT * FROM orders_details WHERE  id_order=:id_order"); 
        $result->bindParam(':id_order', $id_order, PDO::PARAM_INT);
        $result->execute();
        $i = 0;
        while ($row = $result->fetch()) {
            $course[$i] = $row;
            $i++;
        }
        return $course;
    }



    public static function isItBought($idu,$idc,$buy){
        $db = Database::getConnection();
        $result = $db->prepare("SELECT COUNT(orders.id_order) as count FROM orders LEFT JOIN orders_details 
                    ON orders_details.id_order=orders.id_order 
                    WHERE  (orders_details.id_c=:idc AND orders.id_user=:idu) AND  orders.bought=:buy");
        $result->bindParam(':idu', $idu, PDO::PARAM_INT);
        $result->bindParam(':idc', $idc, PDO::PARAM_INT);
        $result->bindParam(':buy', $buy, PDO::PARAM_INT);
        $result->execute();
        $row = $result->fetch();// якшо не пусто то тру
        if($row['count']>0)  return true;
        else return false;
    }


    public static function studentsByCourse($idc){
        $db = Database::getConnection();
        $result = $db->prepare("SELECT orders.id_user,orders.user FROM orders LEFT JOIN orders_details 
                    ON orders_details.id_order=orders.id_order 
                    WHERE  (orders_details.id_c=:idc AND  orders.bought=1)");
        $result->bindParam(':idc', $idc, PDO::PARAM_INT);
        $result->execute();
        $i = 0;
        while ($row = $result->fetch()) {
            $course[$i] = $row;
            $i++;
        }
        return $course;
    }

    
    public static function getIdOrder($comment,$email,$id_u){
        $db = Database::getConnection();
        $result = $db->prepare("SELECT id_order FROM orders WHERE (id_user=:id_u AND email=:email AND comment=:comment ) ORDER BY date_creation DESC");
        $result->bindParam(':id_u', $id_u, PDO::PARAM_INT);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':comment', $comment, PDO::PARAM_STR);
        $result->execute();
        $row = $result->fetch();
        return $row['id_order'];
    }

    public static function AllOrders() {
        $db = Database::getConnection();
        $result = $db->prepare("SELECT * FROM orders WHERE bought=0 ORDER BY date_creation DESC");
        $result->execute();
        $i = 0;
        while ($row = $result->fetch()) {
            $course[$i] = $row;
            $i++;
        }
        return $course;
    }

    public static function OrdersDetail($id) {
        $db = Database::getConnection();
        $result = $db->prepare("SELECT * FROM orders_details  LEFT JOIN orders 
            ON orders_details.id_order = orders.id_order WHERE orders.id_order =:id");
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
        $i = 0;
        while ($row = $result->fetch()) {
            $course[$i] = $row;
            $i++;
        }
        return $course;
    }


    public static function deleteDetail($id){
        $db = Database::getConnection();
        $result = $db->prepare("DELETE FROM orders_details WHERE id_od=:id");
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
    }

    public static function deleteOrderDetail($id){
        $db = Database::getConnection();
        $result = $db->prepare("DELETE FROM orders_details WHERE id_order=:id");
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
    }

    public static function deleteOrder($id){
        $db = Database::getConnection();
        $result = $db->prepare("DELETE FROM orders WHERE id_order=:id");
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
    }

    public static function getIdOrderByOD($id){
        $db = Database::getConnection();
        $result = $db->prepare("SELECT id_order FROM orders_details WHERE id_od=:id");
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
        $row = $result->fetch();// якшо не пусто то тру
        if($row['id_order'])  return $row['id_order'];
        else return false;
    }

    public static function getNewSum($id){
        $db = Database::getConnection();
        $result = $db->prepare("SELECT SUM(price) as sum FROM orders_details  WHERE  id_order=:id");
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
        $row = $result->fetch();// якшо не пусто то тру
        if($row['sum'])  return $row['sum'];
        else return false;
    }


    public static function UpdateSumOrder($id,$sum){
        $db = Database::getConnection();
        $result = $db->prepare("UPDATE orders SET total_price='".$sum."' WHERE id_order=". $id);
        $result->execute();
    }


    public static function BuyOrder($id){
        $db = Database::getConnection();
        $result = $db->prepare("UPDATE orders SET bought=1 WHERE id_order=". $id);
        $result->execute();
    }
}