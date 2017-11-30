<?php

include_once ROOT. '/components/Cart.php'; // підключення моделі
include_once ROOT. '/models/User.php'; // підключення моделі
include_once ROOT. '/models/Order.php'; // підключення моделі


class OrdersController{

   
    // public function actionDeleteDetail() { 
    //     // Удаляем заданный товар из корзины
    //     $data = $_POST;
    //     var_dump($data);
    //     $id = intval($data['idod']); //10
    //     Order::deleteDetail($id);
    //     // Возвращаем пользователя в корзину
    //     header("Location: /admin/orders/");
    // }

    public function actionDeleteDetail($id) { 
        // Удаляем заданный товар из корзины
        $id = intval($id); //10
        $get_id_order = Order::getIdOrderByOD($id);
        Order::deleteDetail($id);//38
        $sum = Order::getNewSum($get_id_order);
        Order::UpdateSumOrder($get_id_order,$sum);
        // Возвращаем пользователя в корзину
        header("Location: /admin/orders/");
        return true;   
    }

    public function actionDeleteOrder($id) { 
        // Удаляем заданный товар из корзины
        $id = intval($id); //10
        Order::deleteOrder($id);
        Order::deleteOrderDetail($id);//38 
        header("Location: /admin/orders/");
        return true;   
    }

    public function actionBuyOrder($id) { 
        // Удаляем заданный товар из корзины
        $id = intval($id); //10
        Order::BuyOrder($id);
        header("Location: /admin/orders/");
        return true;   
    }

}