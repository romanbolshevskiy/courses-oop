<?php

	include_once ROOT. '/models/Teachers.php'; // підключення моделі
  include_once ROOT. '/models/Courses.php'; // підключення моделі
  include_once ROOT. '/models/Site.php'; // підключення моделі
	include_once ROOT. '/models/User.php'; // підключення моделі
  include_once ROOT. '/models/Chat.php'; // підключення моделі

  include_once ROOT. '/models/Order.php'; // підключення моделі

	class SiteController {

		public function actionIndex() {

      if($_SESSION['user']){
        $admin=User::isAdmin($_SESSION['user']);
      }
			$coursesList = Courses::getReccomendsCourses(); // беерм метод з моделі
      $teachersList = Teachers::getBestTeachers(); // беерм метод з моделі
			$latest = Courses::getLatest();

      $coursesAll=Courses::getCourses();
      //$messages = Chat::all_messages();
    
      if($_SESSION['user']){
        $user= User::getUserById($_SESSION['user']);
        $user = $user['name'];// . " ". $user['name'];
      }
      else{
        $user = "none";
      }

  
			require_once(ROOT . '/views/site/index.php'); // підключаєм вюшку
			return true;
		}

  	public function actionContact() {

      $userEmail = '';
      $userText = '';
      $result = false;

      if($_SESSION['user']){
        $user= User::getUserById($_SESSION['user']);
        $name = $user['name'];
        $email = $user['email'];
      }
      else{
        $user = "none";
      }

    	if (isset($_POST['submit'])) {

        $userName = $_POST['userName'];
        $userEmail = $_POST['userEmail'];
        $userText = $_POST['userText'];

        $errors = false;

        // Валидация полей
        if (!User::checkEmail($userEmail)) {
            $errors[] = 'Error email';
        }

        if ($errors == false) {
           $adminEmail = 'admin@meta.ua';
           $message = "Text: {$userText}. Email: {$userEmail}";
           $subject = "Subject of message from {$userName}";
           $result = mail($adminEmail, $subject, $message);
           header("Location: /contact/");
        }

    	}

      require_once(ROOT . '/views/site/contact.php');

      return true;
  	}

	}