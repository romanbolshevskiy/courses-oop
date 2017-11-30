<?php

include_once ROOT. '/models/User.php'; // підключення моделі


class UserController {

    public function actionRegister() {
        $result = false;

        if (isset($_POST['submit'])) {

            $name = $_POST['name'];
            $surname = $_POST['surname'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $type = $_POST['type'];
            $description = $_POST['description'];
            $degree = $_POST['degree'];
            $working_place = $_POST['working_place'];


            $errors = false;

            if (!User::checkName($name)) { //якшо фолс
                $errors[] = 'Имя не должно быть короче 5-х символов';
            }

            if (!User::checkEmail($email)) { //якшо фолс
                $errors[] = 'Неправильный email';
            }

            if (!User::checkPassword($password)) { //якшо фолс
                $errors[] = 'Пароль не должен быть короче 6-ти символов';
            }

            //$total = User::checkEmailExists($email);
            if (User::checkEmailExists($email)) { //якшо тру то помилка
               $errors[] = 'Такой email уже используется';
            }

            if ($errors == false) {//яккшо помилок нема
                
                $hesh = md5($name.$email);
                $result = User::register($name, $surname, $email, $password, $type,  $hesh);

                // АКТИВАЦІЯ реєстрації юзера
                $subject=" =?utf-8?B?".base64_encode($subject)."?=";
                $headers="From:'Site videocourss'\r\n Reply-to: 'from'\r\n Content-type: text/plain;     
                                           charset=utf-8\r\n"; 
                $message = "Hello '".$name . " ".$surname ."', you registered in our site, if you want to finish registration, go out to " . 
                "http://courses-oop/activation/". $hesh;
                //text/plain означає простий текст , text/html можна користуватись html текгами
                mail($email,$subject,$message,$headers);

                $id_search = User::search_id($email);
                if($type == 'student'){
                    $result = User::register_s($id_search);
                }
                if($type == 'teacher'){
                    $result = User::register_t($id_search,$description, $degree, $working_place);
                }

                echo "зареєстровані";
            }

        }

        require_once(ROOT . '/views/user/register.php');

        return true;
    }

    public function actionActivation() {
        
        $url= $_SERVER['REQUEST_URI']; //http://courses-oop/activation/55290d2c78f76b69c3db7df97d263143
        $exp = explode("/", $url); // 
        $hesh = end($exp); //55290d2c78f76b69c3db7df97d263143

        if (isset($_POST['submit'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            
            $errors = false;
                        
            // Валидация полей
            if (!User::checkEmail($email)) {
                $errors[] = 'Неправильный email';
            }            
            if (!User::checkPassword($password)) {
                $errors[] = 'Пароль не должен быть короче 6-ти символов';
            }
            
            // Проверяем существует ли пользователь
            $userId = User::checkUserDataActivation($email, $password , $hesh );
            if ($userId == false) {
                // Если данные неправильные - показываем ошибку
                $errors[] = 'Неправильные данные для входа на сайт';
            } else {
                // Если данные правильные, запоминаем пользователя (сессия)
                User::auth($userId);
                $result = User::activation($hesh);
                header("Location: /cabinet/ ");
            }

        }

        require_once(ROOT . '/views/user/activation.php');

        return true;
    }

    public function actionLogin() {
        $email = '';
        $password = '';
        
        if (isset($_POST['submit'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            
            $errors = false;
                        
            // Проверяем существует ли пользователь
            $userId = User::checkUserData($email, $password);
            $active = User::checkActiveStatus($email);
           
            if ($userId == false) {
                // Если данные неправильные - показываем ошибку
                $errors[] = 'Неправильные данные для входа на сайт';
            } else {
                // Если данные правильные, запоминаем пользователя (сессия)
                // якшо неактивне то помилка
                if($active==0){
                    $errors[] = 'Необходимо активировать акаунт через емейл';
                }
                else if($active==1){
                    User::auth($userId);
                    header("Location: /cabinet/ ");
                    //Перенаправляем пользователя в закрытую часть - кабинет    
                }
                 
            }
        }
        require_once(ROOT . '/views/user/login.php');

        return true;
    }
    

    /** Удаляем данные о пользователе из сессии */
     
    public function actionLogout() {
        session_start();
        unset($_SESSION["user"]);
        header("Location: /user/login/");
    }
    
}