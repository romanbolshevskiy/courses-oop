<?php

	include_once ROOT. '/models/Courses.php'; // підключення моделі	
	include_once ROOT. '/models/Teachers.php'; // підключення моделі
	include_once ROOT. '/models/User.php'; // підключення моделі
	
	class TeachersController {

		public function actionTeachers() {
			
			$teachers = Teachers::getTeachers();

			require_once(ROOT . '/views/content/teachers/teachers.php'); // підключаєм вюшку

			return true;
		}
		
		public function actionTeacher($id) {
			$id = intval($id); 

			if($_SESSION['user']){
		    	$admin=User::isAdmin($_SESSION['user']);
		    }

			$teacher = Teachers::getTeacherInfo($id);
			$his_courses = Teachers::getTeachersCourses($id);

			$path = 'images/users/user'.$id.'.png';
			$file = "/".$path;

		    if (file_exists($_SERVER['DOCUMENT_ROOT'].$file)) {
		        $file1 = $file;
		    }
		    else {  
		        $file1 = '/images/users/none.png';
		    }

			require_once(ROOT . '/views/content/teachers/one.php'); // підключаєм вюшку

			return true;
		}

		public function actionEdit($id) {

			$id = intval($id); //10

			 // операції з файлом
	        $types = array('image/gif', 'image/png', 'image/jpeg','');
	        $size = 30024000;
	        $path = 'images/users/user'.$id.'.png';
	        $file = "/".$path;
		

	        if (!in_array($_FILES['picture']['type'], $types)){  // Проверяем тип файла
	            echo "Запрещённый тип файла. Попробуйте снова";
	        }
	        else if ($_FILES['picture']['size'] > $size){  // Проверяем размер файла
	            echo "Слишком большой размер файла. Попробуйте другой файл.";
	        }
	        else {   // якшо помилок немає
	            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	                @copy($_FILES['picture']['tmp_name'],$path);      
	            }
	        }

		    if (file_exists($_SERVER['DOCUMENT_ROOT'].$file)) {
		        $file1 = $file;
		    }
		    else {  
		        $file1 = '/images/users/none.png';
		    }

			$teacher = Teachers::getTeacherInfo($id);
			$his_courses = Teachers::getTeachersCourses($id);
			
			$id_all = [];
			$courses_all = Courses::getCourses();
		
			$errors = false;

			if (isset($_POST['submit'])) {	
		        $name = $_POST['name'];
		        $surname = $_POST['surname'];
		       	$email = $_POST['email']; 
		       	$courses_checked = $_POST['courses'];

		        if (User::checkEmailExists2($teacher[0]['email'],$email)) { //якшо тру то помилка
		           $errors[] = 'There is already such email.Error!';
		        }
		        if ($errors == false) {//яккшо помилок нема
		        	Teachers::updateNullOldCourses($id);
		        	Teachers::updateIdtInCourses($courses_checked, $id);

		        	Teachers::updateInUsers($name, $surname,$email,$_POST['password'], $_POST['admin'] , $id);
		        	Teachers::updateInTeachers($_POST['best'],$_POST['degree'],$_POST['working'],$_POST['description'], $id);
		        	
		        	header('Location: /teacher/edit/' . $id);
		        }
           
        	}
			
			require_once(ROOT . '/views/content/teachers/edit.php');
			return true;
		}

		public function actionDelete($id) {
			$id = intval($id); //10

			Teachers::updateNullOldCourses($id);
			Teachers::deleteTeacherById($id);
			Teachers::deleteUserById($id);
			Teachers::deleteFromCart($id);
			header("Location: /teachers/ ");
		}

	}