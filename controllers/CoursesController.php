<?php
	include_once ROOT.'/models/Courses.php';
	include_once ROOT.'/models/Teachers.php';
	include_once ROOT.'/models/User.php';
	include_once ROOT.'/models/Order.php';
	include_once ROOT.'/components/Pagination.php';


	class CoursesController {

		public function actionCourses($page=1) {
			
			//$main_courses_list = Courses::getMainCourses();//витягуєм всі головні курси
			$main_courses_list_all = Courses::getAllMainCourses();
			$courses_list_menu = Courses::getCoursesInTop($page,3); //прості курси незалежні від головних
			$courses_list_all = Courses::getCourses(); //витягуєм всі прості курси
			
			//var_dump($main_courses_list_all);
			foreach ($main_courses_list_all as $mc) {
                if(!Courses::getCountOfUnderCourses($mc['id_mc'])){
                    Courses::updateMCUnder($mc['id_mc'],$under=0);
                }
			}

			if($_SESSION['user']){
		    	$admin=User::isAdmin($_SESSION['user']);
		    }
			$url = explode("/", $_SERVER['REQUEST_URI']);
			
			$total = Courses::getCountCourses();//кількість товарів 
			$pagination = new Pagination($total, $page, $count=3,'page-');

			require_once(ROOT . '/views/content/courses/courses.php'); // підключаєм вюшку
			return true;
		}


		public function actionOne($name) {
			$main_courses_list_all = Courses::getAllMainCourses();
			$courses_list_all = Courses::getCourses(); //витягуєм всі прості курси
			
			if($_SESSION['user']){
		    	$admin=User::isAdmin($_SESSION['user']);
		    }

			$url = explode("/", $_SERVER['REQUEST_URI']);
			$arr_main_courses = [];	$arr_courses = [];  $arr_courses_in = [];
			
			foreach ($main_courses_list_all as  $course){ //прохожусь по масиву
				if($url[2] == $course['url_mc'] ){
					array_push($arr_main_courses,  $course['url_mc'] , $course['name_mc'] , (int) $course['id_mc']);
				}
			}
			foreach ($courses_list_all as  $course){ //прохожусь по масиву
				if($url[2] == $course['url'] ){
					array_push($arr_courses, $course['url'], $course['name'] , (int) $course['id_c']) ; //закиую змінену назву в новий масив
				}
				else if($url[3] == $course['url'] ){ 
					array_push($arr_courses_in,$course['url'], $course['name'] , (int) $course['id_c']) ; //закиую змінену назву в новий масив
				}
			}
			
			if (in_array($url[2], $arr_main_courses)) { //якшо юрл є в масиві головномих курсів
				if(!$url[3]){ 
					$id = $arr_main_courses[2];
					$courses = Courses::getUnderCourses($id);
					if(!$courses){$type='non_information';}
					$type = "simple";
				}
				else{// якшо адреса з головним і підрядним курсом  - courses/qa-qc/html-css 
					if (in_array($url[3], $arr_courses_in)){// то проходим дивимся чи html-css є другорядним , якшо та то виводим його індивідуально
						$id = $arr_courses_in[2];
						$type = "view";
						$course_info = Courses::getCourseInfo($id);//витягуєм всі прості курси
						$teacher_info= Teachers::getTeacherInfo($course_info[0]['id_t']);
						$filename = Courses::getImage($course_info['id_c']);
					}
					else if (!in_array($url[3], $arr_courses_in)) {// якшо другорядного в юрл нема в таблиці то помилка
						$type = "false";
					}
				}
			}
			else if (in_array($url[2], $arr_courses)) {// якшо дані з юрл є в масиві назв простих постів
				$id = $arr_courses[2];
				$type = "view";
				$course_info = Courses::getCourseInfo($id);//витягуєм всі прості курси
				$teacher_info= Teachers::getTeacherInfo($course_info[0]['id_t']);
				$bought = Order::isItBought($_SESSION['user'],$id,$buy=1);
				$course_students = Order::studentsByCourse($course_info[0]['id_c']);
				$filename = Courses::getImage($id );
			}
			
			else{}
		
			require_once(ROOT . '/views/content/courses/one.php'); // підключаєм вюшку
			return true;
		}

		public function actionMyCourses() {

		 	$user_cart = Order::CartBoughtByUser($_SESSION['user']);

			require_once(ROOT . '/views/content/courses/mycourses.php'); // підключаєм вюшку
			return true;
		}



		public function actionCreate() {

			$teachers= Teachers::getTeachers();

			if($_SESSION['user']){
		    	$admin=User::isAdmin($_SESSION['user']);
		    }
			if (isset($_POST['submit'])) {

				$name = $_POST['name'];
				$description = $_POST['description'];
				$video = $_POST['video'];
				$price = $_POST['price'];
				$teacher = $_POST['teacher'];

				$errors = false;

				if (Courses::checkNameExists($name)) { //якшо тру то помилка
					$errors[] = 'Така назва вже є';
				}

				if ($errors == false) {//яккшо помилок нема    
					$result = Courses::createCourse($name, $description, $video, $price, $teacher);
					$get_id = Courses::getCourseId($name);
					$result = Courses::createCourseTeacher($get_id,$teacher);
					Courses::createImage($get_id);
					//якшо є  картинка то картинка курса якшо нема то загальна картинка
				}
			}

			require_once(ROOT . '/views/content/courses/create.php');
			return true;
		}

		public function actionEdit($id) { ///course/edit/2 id=2
			$id = intval($id); //10

			if($_SESSION['user']){
		    	$admin=User::isAdmin($_SESSION['user']);
		    }
			
			$id_all = [];
			$courses = Courses::getCourses();
			
			$courses = Courses::getCourses();
			$course = Courses::getCourseInfo($id);
			$teachers= Teachers::getTeachers();
			$get_teacher_info = Teachers::getTeacherInfo($course[0]['id_t']);
			$name_surname =  $get_teacher_info[0]['name'] .  ' '. $get_teacher_info[0]['surname'];

			foreach ($courses as  $cours) {
				array_push($id_all, $cours['id_c']);
			}
			if (!in_array($id, $id_all)) { $type="bad"; }
			$errors = false;

			if (isset($_POST['submit'])) {

				$name = $_POST['name'];
				$description = $_POST['description'];
				$reccomend = $_POST['reccomend'];
				$video = $_POST['video'];
				$price = $_POST['price'];
				$teacher_id = $_POST['teacher'];

				if (Courses::checkCourseNameExists($name,$course[0]['name'])) { //якшо тру то помилка
					$errors[] = 'Така назва вже є';
				}
				if ($errors == false) {//яккшо помилок нема
					Courses::update($name, $description, $reccomend,  $video, $price, $teacher_id, $id);
					Courses::createImage($id);
					$course = Courses::getCourseInfo($id);
				}
			}
			require_once(ROOT . '/views/content/courses/edit.php');
			return true;
		}

		public function actionDelete($id) {	
			$id = intval($id);
			Courses::deleteCourseById($id);
			Courses::deleteFromCart($id);

			$file = "/images/courses/course".$id.".png";
			if (file_exists($_SERVER['DOCUMENT_ROOT'].$file)) {
				unlink($_SERVER['DOCUMENT_ROOT'].$file);
			}
			header("Location: /courses/");
		}
}