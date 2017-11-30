<?php

include_once ROOT. '/components/Cart.php'; // підключення моделі
include_once ROOT. '/models/User.php'; // підключення моделі
include_once ROOT. '/models/Order.php'; // підключення моделі


class AdminController{

   
    public function actionOrders() { // для відображення корзини

        if($_SESSION['user']){ 
            $orders_all = Order::AllOrders();
            $admin=User::isAdmin($_SESSION['user']);
        }
        else{
            header("Location: /");
        }
        require_once(ROOT . '/views/admin_order/index.php');

        return true;
    }



}