<?php

include_once ROOT. '/components/Cart.php'; // підключення моделі
include_once ROOT. '/models/User.php'; // підключення моделі
include_once ROOT. '/models/Order.php'; // підключення моделі


class CartController{

   
    public function actionIndex() { // для відображення корзини

        if($_SESSION['user']){ 
            $user_cart = Cart::CartByUser($_SESSION['user']);
            $sum = Cart::SumCartByUser($_SESSION['user']);
            $admin=User::isAdmin($_SESSION['user']);
        }
        else{
            header("Location: /");
        }
        require_once(ROOT . '/views/cart/index.php');

        return true;
    }


    public function actionBought() { // для відображення корзини

        if($_SESSION['user']){
            // Получим данные из корзины
            $user_cart = Order::CartBoughtByUser($_SESSION['user']);
            $admin=User::isAdmin($_SESSION['user']);
        }
        else{
            header("Location: /");
        }
        $type = "bought";
        require_once(ROOT . '/views/cart/bought.php');
        return true;
    }


    public function actionProcessing() { // для відображення корзини

        if($_SESSION['user']){
            // Получим данные из корзины
            $user_cart = Order::CartProcessingByUser($_SESSION['user']);
            $admin=User::isAdmin($_SESSION['user']);
        }
        else{
            header("Location: /");
        }
        $type = "processing";
        require_once(ROOT . '/views/cart/bought.php');
        return true;
    }



    public function actionAddCart(){
        // Добавляем товар в корзину
        $data = $_POST;
        $idu=$data['idu'];
        $idc=$data['idc'];
        $name =$data['name'];
        $url =$data['url'];
        $price =$data['price']; 

        $all = Cart::allCart();
        $is_id_cu = Cart::isItIdCU($idu,$idc);

        if(!$is_id_cu){
            Cart::addProduct($idu,$idc,$name,$url,$price);
        }    
        return true;
        $referrer = $_SERVER['HTTP_REFERER']; //повертає сторінку з якої прийшов
        header("Location: $referrer");
    }

    public function actionCheckout() { // сторінка замовлення товара


        // // Статус успешного оформления заказа
        $result = false;

        if($_SESSION['user']){ 
            $user_cart = Cart::CartByUser($_SESSION['user']);
            $sum = Cart::SumCartByUser($_SESSION['user']);
            $user= User::getUserById($_SESSION['user']);
            $admin=User::isAdmin($_SESSION['user']);
            $count =  Cart::CountCoursestByUser($_SESSION['user']);
        }
        else{
            header("Location: /");
        }

        // // Форма отправлена?
        if (isset($_POST['submit'])) {
            // Форма отправлена? - Да
            // Считываем данные формы
            $userName = $_POST['userName'];
            $userPhone = $_POST['userPhone'];
            $userComment = $_POST['userComment'];
            $userEmail = $_POST['userEmail'];


            // Валидация полей
            $errors = false;
            if (!User::checkName($userName)) $errors[] = 'Error name';
            if (!User::checkPhone($userPhone)) $errors[] = 'Неправильный телефон';

            // Форма заполнена корректно?
            if ($errors == false) {
                if(!$user_cart){}
                else{
                    Order::saveOrder($userName, $userPhone, $userComment, $userEmail, $_SESSION['user'],$sum);
                    $get_id_order = Order::getIdOrder($userComment,$userEmail,$_SESSION['user']);
                    foreach ($user_cart as $course){
                        Order::saveOrderDetails($get_id_order, $course['name'], $course['url'], $course['price'], $course['id_c']);
                    }
                    Cart::deleteCartById($_SESSION['user']);
                }
                $result = true;
                header("Location: /cart/");
                // Сохраняем заказ в БД
           
                if ($result) { //якшо зберешло всі дані
                    // Оповещаем администратора о новом заказе
                    $adminEmail = 'php.start@mail.ru';
                    $message = 'http://courses-oop/admin/orders';
                    $subject = 'Новый заказ!';
                    mail($adminEmail, $subject, $message);
                }
            }
            else { }
        } else { }

        require_once(ROOT . '/views/cart/checkout.php');

        return true;
    }



    public function actionDeleteAll() { 
        // Удаляем заданный товар из корзины
        Cart::deleteCartById($_SESSION['user']);

        // Возвращаем пользователя в корзину
        header("Location: /cart/");
    }


    public function actionDelete($id) { 
        // Удаляем заданный товар из корзины
        $id = intval($id); //10
        Cart::deleteProduct($id);

        // Возвращаем пользователя в корзину
        header("Location: /cart/");
    }


}