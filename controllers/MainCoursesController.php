<?php
	include_once ROOT.'/models/Courses.php';
	include_once ROOT.'/models/Teachers.php';
	include_once ROOT.'/models/User.php';
	
	class MainCoursesController {


	// main_courses
	public function actionCreate_main_course() {

		$courses = Courses::getCourses();

		$errors = false;

		if (isset($_POST['submit'])) {
        	
        	$name = $_POST['name'];
        	$courses_checked = $_POST['courses'];
           	// var_dump($courses_checked);

           	if (Courses::checkNameMCExists($name)) { //якшо тру то помилка
               $errors[] = 'Така назва вже є';
            }
            if ($errors == false) {//яккшо помилок нема
	            Courses::createMainCourse($name);
	            $id_mc = Courses::getIdByName($name);
	            Courses::updateIdMcInMainCourses($courses_checked, $id_mc);
	        }
        }

		require_once(ROOT . '/views/content/main_courses/create.php'); // підключаєм вюшку
		return true;
	}


	// main_courses
	public function actionEdit_main_course($id) { // /main-course/edit/3  id=3
		$id_mc = intval($id);
		if($_SESSION['user']){
	    	$admin=User::isAdmin($_SESSION['user']);
	    }
		$id_all = [];
		$courses = Courses::getUnderCourses($id_mc);
		$courses_all = Courses::getCourses();
		$main_course = Courses::getMainCourseInfo($id_mc);
		$main_courses_all = Courses::getAllMainCourses();
		$courses_checked_old = Courses::getOldChecked($id_mc);

		foreach ($main_courses_all as  $mcours) {
          array_push($id_all, $mcours['id_mc']); 
        }
        if (!in_array($id_mc, $id_all)) { $type="bad"; }


		$errors = false;
		if (isset($_POST['submit'])) {
        	
            $name = $_POST['name'];
           	$courses_checked = $_POST['courses']; 

            if (Courses::checkCourseNameExists($name,$main_course[0]['name'])) { //якшо тру то помилка
               $errors[] = 'Така назва вже є';
            }
            if ($errors == false) {//яккшо помилок нема
            	if($courses_checked){
            		Courses::updateMCUnder($id_mc,$under=1);
            	}
            	else{
            		Courses::updateMCUnder($id_mc,$under=0);	
            	}
                Courses::updateNullMainCourse($courses_checked_old,$id_mc);
                Courses::updateMainCourseName($name,$id_mc);
                Courses::updateIdMcInMainCourses($courses_checked, $id_mc);
                header('Location: /main-course/edit/' . $id_mc);
            }
           
        }

		require_once(ROOT . '/views/content/main_courses/edit.php'); // підключаєм вюшку
		return true;
	}


	public function actionMain_courses() {
		$main_courses_count = [];
		$main_courses_list = Courses::getAllMainCourses(); //витягуєм всі головні курси

		require_once(ROOT . '/views/content/main_courses/courses.php'); // підключаєм вюшку
		return true;
	}

	public function actionDelete($id) {
		$id_mc = intval($id); 
		$count =Courses::countMCById($id_mc);
		if($count){
			Courses::nullMCById($id_mc);
		};
		Courses::deleteMC($id_mc);
		header("Location: /main-courses/ ");
	}

}