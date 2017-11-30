<?php

  include_once ROOT. '/models/Teachers.php';
  include_once ROOT. '/models/Courses.php'; 
  include_once ROOT. '/models/Search.php'; 

  class FindController {

    public function actionIndex() {

      $coursesList = Courses::getReccomendsCourses(); 
      $teachersList = Teachers::getBestTeachers(); 
      $latest = Courses::getLatest();

      $coursesAll = Courses::getCourses();

      $data = $_POST;
      $found = Search::searchWord($data['search']);
  
      require_once(ROOT . '/views/site/find.php'); // підключаєм вюшку
      return true;
    }
  }