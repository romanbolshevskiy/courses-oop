<?php
include_once ROOT. '/models/User.php'; // підключення моделі

class CabinetController {

    public function actionIndex() {
        // Получаем идентификатор пользователя из сессии
        $userId = $_SESSION['user']; 
        // Получаем информацию о пользователе из БД
        $user = User::getUserById($userId);
        
        // операції з файлом
        $types = array('image/gif', 'image/png', 'image/jpeg');
        $size = 30024000;
        $path = 'images/users/user'.$userId.'.png';

        if (!in_array($_FILES['picture']['type'], $types)){  // Проверяем тип файла
            echo "Запрещённый тип файла. Попробуйте снова";
        }
        else if ($_FILES['picture']['size'] > $size){  // Проверяем размер файла
            echo "Слишком большой размер файла. Попробуйте другой файл.";
        }
        else {   // якшо помилок немає
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if (!@copy($_FILES['picture']['tmp_name'],$path))
                    echo 'Что-то пошло не так';
                else
                    echo 'Загрузка удачна';
            }
        }
        $file = "/".$path;

        if (file_exists($_SERVER['DOCUMENT_ROOT'].$file)) {
            $file1 = $file;
        }
        else {  
            $file1 = '/images/users/none.png';
        }
       
        require_once(ROOT . '/views/cabinet/index.php');
        return true;
    }  
    
    public function actionEdit() {
        // Получаем идентификатор пользователя из сессии
        $userId = $_SESSION['user'];    
        // Получаем информацию о пользователе из БД
        $user = User::getUserById($userId);   
        $result = false;     

        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $password = $_POST['password'];
            $surname = $_POST['surname'];
            $email = $_POST['email'];
            $errors = false;
            
            if(!User::checkName($name)){
                $errors[] = 'Имя не должно быть короче 2-х символов';
            } 
            if(!User::checkPassword($password)){
                $errors[] = 'Пароль не должен быть короче 6-ти символов';
            }
            if(User::checkEmailExists2($user['email'],$email)){ //якшо тру то помилка
               $errors[] = 'Такой email уже используется';
            }
            if($errors == false){
                $result = User::edit($userId, $name,  $surname, $email, $password);
                if($user['user_type'] == 'teacher'){
                    User::edit_teachers($userId, $_POST['degree'],  $_POST['working_place'], $_POST['description']);
                }
                $result = true;
                //echo "Зроблено!";
                header("Location: /cabinet/");
            }
        }
        require_once(ROOT . '/views/cabinet/edit.php');
        return true;
    }

    public function actionDelete() {
        //Получаем идентификатор пользователя из сессии
        $userId = $_SESSION['user'];
        $user_info = User::getUserById($userId);
        //видалення картинки юзера при видаленні самого юзера
        $file = "/images/users/user".$userId.".png"; 
        if (file_exists($_SERVER['DOCUMENT_ROOT'].$file)) {
            unlink($_SERVER['DOCUMENT_ROOT'].$file);
        }
        User::delete($userId);
        if($user_info['user_type'] == 'teacher'){
            User::delete_from_teachers($userId);
        }
        else if($user_info['user_type'] == 'student'){
            User::delete_from_students($userId);
        }
        unset($_SESSION["user"]);
        header("Location: /");
    }
}
?>