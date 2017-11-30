<?php
class Courses{

    /* pagination */ 

    public static function  getCountCourses() {
        $db = Database::getConnection();
        $result = $db->query("SELECT SUM(total.count) AS sum_count FROM(SELECT COUNT(id_mc) as count FROM main_courses WHERE under=1 UNION SELECT  COUNT(id_c) as count FROM courses WHERE id_mc=0) AS total");
        $row = $result->fetch();// якшо не пусто то тру
        if($row['sum_count'])  return $row['sum_count'];
        else return false;
    }


    public static function  getCoursesInTop($page,$count) {
        $page = intval($page);
        $offset = $count*($page-1);
        $db = Database::getConnection();
        $result = $db->query("
            SELECT id_mc as id_mc,NULL as id_c,name_mc as name,url_mc as url, NULL as price FROM main_courses WHERE under=1 
                UNION 
            SELECT NULL,id_c,name,url,price FROM courses
            WHERE id_mc=0  LIMIT ".$count." OFFSET ".$offset);
        $i = 0;
        while ($row = $result->fetch()) {
            $course[$i] = $row;
            $i++;
        }
        return $course;
    }


    /* pagination */


    public static function 	getCourses() {
        $db = Database::getConnection();
        // треба лефт джойн з тічерсами!!
        $result = $db->query('SELECT * FROM  courses ');
        $i = 0;
		while ($row = $result->fetch()) {
            $course[$i] = $row;
            $i++;
		}
		return $course;
    }

	public static function getUnderCourses($id) {
		$db = Database::getConnection();
        $result = $db->prepare("SELECT * FROM courses WHERE id_mc = :id");
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
		$i = 0;
		while ($row = $result->fetch()) {
		 	$course[$i] = $row;
            $i++;
		}
		return $course;
	}

    public static function getCountOfUnderCourses($id) {
        $db = Database::getConnection();
        $result = $db->prepare("SELECT count(id_mc) as count,id_mc FROM courses WHERE id_mc=:id");
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
        $row = $result->fetch();// якшо не пусто то тру
        if($row['count'])  return $row;
        else return false;
    }

    public static function ifCountOfUnderCourses($id) {
        $db = Database::getConnection();
        $result = $db->prepare("SELECT count(id_mc) as count,id_mc FROM courses WHERE id_mc=:id");
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
        $row = $result->fetch();// якшо не пусто то тру
        if($row['count'])  return true;
        else return false;
    }


    public static function getCourseInfo($id) {
        $db = Database::getConnection();
        $result = $db->prepare("SELECT * FROM courses WHERE id_c = :id" );
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
        $i = 0;
        while ($row = $result->fetch()) {
            $user[$i] = $row;
            $i++;
        }
        return $user;
    }


    public static function checkNameExists($name) {
        $db = Database::getConnection();
        $result = $db->prepare("SELECT COUNT(name) AS count FROM courses WHERE name=:name");
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->execute();
        $row = $result->fetch();// якшо не пусто то тру
        if($row['count']) return true;
        else return false;
    }
    public static function countMCById($id) {
        $db = Database::getConnection();
        $result = $db->prepare("SELECT COUNT(name) AS count FROM courses WHERE id_mc=:id");
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
        $row = $result->fetch();// якшо не пусто то тру
        if($row['count']) return true;
        else return false;
    }



    public static function createCourse($name, $description, $video, $price, $id_t){
        $uk=array('А','Б','В','Г','Д','Е','І','Ж','З','И','Й','К','Л','М','Н','О','П','Р','С','Т','У','Ф','Х','Ц','Ч','Ш','Щ','Ъ','Ы','Ь','Э','Ю','Я','а','б','в','г','д','е','і','ж','з','и','й','к','л','м','н','о','п','р','с','т','у','ф','х','ц','ч','ш','щ','ъ','ы','ь','э','ю','я',' ', ',', '/','_');
        $en=array('a','b','v','g','d','e','i','zh','z','y','y','k','l','m','n','o','p','r','s','t','u','f','h','c','ch','sh','sch','y','y','y','e','yu','ya','a','b','v','g','d','e','i','gh','z','i','y','k','l','m','n','o','p','r','s','t','u','f','h','c','ch','sh','sch','y','y','y','e','yu','ya','-','-','-','-');
        $db = Database::getConnection();
        $result = $db->prepare("INSERT INTO courses (name,description, video, price, url, id_t) VALUES (:name,:description,:video,:price,'".mb_strtolower(str_replace($uk, $en, $name))."', :id_t)");
		$result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':description', $description, PDO::PARAM_STR);
        $result->bindParam(':video', $video, PDO::PARAM_STR);
        $result->bindParam(':price', $price, PDO::PARAM_INT);
        $result->bindParam(':id_t', $id_t, PDO::PARAM_INT);
        return $result->execute();
    }

    public static function createCourseTeacher($get_id,$teacher){
        $db = Database::getConnection();
        $result = $db->prepare("INSERT INTO courses_teachers (id_c,id_t) VALUES (:get_id,:teacher)");
        $result->bindParam(':get_id', $get_id, PDO::PARAM_INT);
        $result->bindParam(':teacher', $teacher, PDO::PARAM_INT);
        return $result->execute();
    }


    public static function getCourseId($name){
        $db = Database::getConnection();
        $result = $db->prepare("SELECT id_c FROM courses WHERE name=:name");
		$result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->execute();
        $row = $result->fetch();
        return $row['id_c'];
    }


    public static function createImage($id){
        $types = array('image/gif', 'image/png', 'image/jpeg');
        $size = 30024000;
        $path = 'images/courses/course'.$id.'.png';
        if(!in_array($_FILES['picture']['type'],$types)){// Проверяем тип файла
            echo "Запрещённый тип файла. Попробуйте снова";
        }
        else if ($_FILES['picture']['size'] > $size){  // Проверяем размер файла
            echo "Слишком большой размер файла. Попробуйте другой файл.";
        }
        else {// якшо помилок немає
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if (!@copy($_FILES['picture']['tmp_name'],$path))
                    echo 'Что-то пошло не так';
                else
                    echo 'Загрузка удачна';
            }
        }
    }

    public static function getImage($id){
       	$path = 'images/courses/course'.$id.'.png';
        $file = "/".$path;
        if (file_exists($_SERVER['DOCUMENT_ROOT'].$file)) {
            $file1 = $file;
            return $file1;
        }
        else {
            $file1 = '/images/courses/none.png';
            return $file1;
        }
    }



    public static function checkCourseNameExists($name,$name_old) {
        $db = Database::getConnection();
        $result = $db->prepare("SELECT * FROM courses WHERE name=:name");
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->execute();
        $row = $result->fetch();// якшо не пусто то тру
        if($row['name'] == $name_old ) return false;
        else if($row['name'] != $name ) return false;
        else return true;
    }


    public static function update($name, $description, $reccomend,  $video, $price, $teacher_id,$id_c) {
        $uk=array('А','Б','В','Г','Д','Е','І','Ж','З','И','Й','К','Л','М','Н','О','П','Р','С','Т','У','Ф','Х','Ц','Ч','Ш','Щ','Ъ','Ы','Ь','Э','Ю','Я','а','б','в','г','д','е','і','ж','з','и','й','к','л','м','н','о','п','р','с','т','у','ф','х','ц','ч','ш','щ','ъ','ы','ь','э','ю','я',' ', ',', '/','_');
        $en=array('a','b','v','g','d','e','i','zh','z','y','y','k','l','m','n','o','p','r','s','t','u','f','h','c','ch','sh','sch','y','y','y','e','yu','ya','a','b','v','g','d','e','i','gh','z','i','y','k','l','m','n','o','p','r','s','t','u','f','h','c','ch','sh','sch','y','y','y','e','yu','ya','-','-','-','-');
        $db = Database::getConnection();
        $result = $db->prepare("UPDATE courses SET name=:name, description=:description, is_recommended=:reccomend,  video=:video, price=:price, id_t=:teacher_id, url= '".mb_strtolower(str_replace($uk, $en, $name))."'  WHERE id_c =:id_c");
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':description', $description, PDO::PARAM_STR);
        $result->bindParam(':reccomend', $reccomend, PDO::PARAM_INT);
        $result->bindParam(':video', $video, PDO::PARAM_STR);
        $result->bindParam(':price', $price, PDO::PARAM_INT);
        $result->bindParam(':teacher_id', $teacher_id, PDO::PARAM_INT);
        $result->bindParam(':id_c', $id_c, PDO::PARAM_INT);
        $result->execute();
    }

    public static function deleteCourseById($id){
        $db = Database::getConnection();
        $result = $db->prepare("DELETE FROM courses WHERE id_c  = :id");
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
    }

    public static function deleteMC($id){
        $db = Database::getConnection();
        $result = $db->prepare("DELETE FROM main_courses WHERE id_mc  = :id");
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
    }

    public static function  getAllMainCourses() {
        $db = Database::getConnection();
        // треба лефт джойн з тічерсами!!
        $result = $db->query("SELECT * FROM  main_courses");
        $i = 0;
        while ($row = $result->fetch()) {
            $course[$i] = $row;
            $i++;
        }
        return $course;
    }


    public static function  getMainCourses() {
        $db = Database::getConnection();
        // треба лефт джойн з тічерсами!!
        $result = $db->query("SELECT DISTINCT url_mc,name_mc, courses.id_mc FROM  main_courses LEFT JOIN courses ON main_courses.id_mc = courses.id_mc WHERE courses.id_mc!=0");
        $i = 0;
        while ($row = $result->fetch()) {
            $course[$i] = $row;
            $i++;
        }
        return $course;
    }


    public static function getIdByName($name){
        $db = Database::getConnection();
        $result = $db->prepare("SELECT id_mc FROM main_courses WHERE name_mc=:name");
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->execute();
        $row = $result->fetch();
        return $row['id_mc'];
    }


    public static function getMainCourseInfo($id) {
        $db = Database::getConnection();
        $result = $db->prepare("SELECT * FROM main_courses WHERE id_mc = :id" );
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
        $i = 0;
        while ($row = $result->fetch()) {
            $user[$i] = $row;
            $i++;
        }
        return $user;
    }


    public static function checkNameMCExists($name) {
        $db = Database::getConnection();
        $result = $db->prepare("SELECT COUNT(name) AS count FROM main_courses WHERE name_mc=:name");
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->execute();
        $row = $result->fetch();// якшо не пусто то тру
        if($row['count']) return true;
        else return false;
    }

    public static function createMainCourse($name){
        $uk=array('А','Б','В','Г','Д','Е','І','Ж','З','И','Й','К','Л','М','Н','О','П','Р','С','Т','У','Ф','Х','Ц','Ч','Ш','Щ','Ъ','Ы','Ь','Э','Ю','Я','а','б','в','г','д','е','і','ж','з','и','й','к','л','м','н','о','п','р','с','т','у','ф','х','ц','ч','ш','щ','ъ','ы','ь','э','ю','я',' ', ',', '/','_');
        $en=array('a','b','v','g','d','e','i','zh','z','y','y','k','l','m','n','o','p','r','s','t','u','f','h','c','ch','sh','sch','y','y','y','e','yu','ya','a','b','v','g','d','e','i','gh','z','i','y','k','l','m','n','o','p','r','s','t','u','f','h','c','ch','sh','sch','y','y','y','e','yu','ya','-','-','-','-');
        $db = Database::getConnection();
        $result = $db->prepare("INSERT INTO main_courses (name_mc , url_mc) VALUES (:name,'".mb_strtolower(str_replace($uk, $en, $name))."')");
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        return $result->execute();
    }

    public static function updateMainCourseName($name_mc,$id_mc) {
        $uk=array('А','Б','В','Г','Д','Е','І','Ж','З','И','Й','К','Л','М','Н','О','П','Р','С','Т','У','Ф','Х','Ц','Ч','Ш','Щ','Ъ','Ы','Ь','Э','Ю','Я','а','б','в','г','д','е','і','ж','з','и','й','к','л','м','н','о','п','р','с','т','у','ф','х','ц','ч','ш','щ','ъ','ы','ь','э','ю','я',' ', ',', '/','_');
        $en=array('a','b','v','g','d','e','i','zh','z','y','y','k','l','m','n','o','p','r','s','t','u','f','h','c','ch','sh','sch','y','y','y','e','yu','ya','a','b','v','g','d','e','i','gh','z','i','y','k','l','m','n','o','p','r','s','t','u','f','h','c','ch','sh','sch','y','y','y','e','yu','ya','-','-','-','-');
        $db = Database::getConnection();
        $result = $db->prepare("UPDATE main_courses SET name_mc=:name_mc, url_mc= '".mb_strtolower(str_replace($uk, $en, $name_mc))."'  WHERE id_mc =:id_mc");
        $result->bindParam(':name_mc', $name_mc, PDO::PARAM_STR);
        $result->bindParam(':id_mc', $id_mc, PDO::PARAM_INT);
        $result->execute();
    }

    public static function updateMCUnder($id_mc,$under) {
        $db = Database::getConnection();
        $result = $db->prepare("UPDATE main_courses SET under=:under WHERE id_mc =:id_mc");
        $result->bindParam(':under', $under, PDO::PARAM_INT);
        $result->bindParam(':id_mc', $id_mc, PDO::PARAM_INT);
        $result->execute();
    }



    public static function getOldChecked($id_mc) {
        $db = Database::getConnection();
        $result = $db->prepare("SELECT id_c FROM courses LEFT JOIN main_courses ON courses.id_mc=main_courses.id_mc  WHERE main_courses.id_mc=:id_mc");
        $result->bindParam(':id_mc', $id_mc, PDO::PARAM_INT);
        $result->execute();
        $i = 0;
        while ($row = $result->fetch()) {
            $user[$i] = $row;
            $i++;
        }
        return $user;
    }

    public static function nullMCById($id_mc) {
        $db = Database::getConnection();
        $result = $db->prepare("UPDATE courses SET id_mc=0 WHERE id_mc =:id_mc");
        $result->bindParam(':id_mc', $id_mc, PDO::PARAM_INT);
        $result->execute();
    }

    public static function updateNullMainCourse($courses_checked_old, $id_mc ) {
        $db = Database::getConnection();
        for($i = 0; $i < count($courses_checked_old); $i++){ 
            $result = $db->prepare("UPDATE courses SET  id_mc=0  WHERE id_c =" .
                $courses_checked_old[$i]['id_c']);
            $result->execute();
        }
    }

    public static function updateIdMcInMainCourses($courses_checked, $id_mc ) {
        $db = Database::getConnection();
        for($i = 0; $i < count($courses_checked); $i++){
            $result = $db->prepare("UPDATE courses SET  id_mc=:id_mc  WHERE id_c =" . $courses_checked[$i]);
            $result->bindParam(':id_mc', $id_mc, PDO::PARAM_INT);
            $result->execute();
        }
    }


    public static function  getReccomendsCourses() {
        $db = Database::getConnection();
        // треба лефт джойн з тічерсами!!
        $result = $db->query('SELECT * FROM  courses WHERE is_recommended=1');
        $i = 0;
        while ($row = $result->fetch()) {
            $course[$i] = $row;
            $i++;
        }
        return $course;
    }


    public static function  getLatest() {
        $db = Database::getConnection();
        $result = $db->prepare("SELECT * FROM courses ORDER BY id_c LIMIT 6"); 
        $result->execute();      
        $i = 0;
        while ($row = $result->fetch()) {
            $user[$i] = $row;
            $i++;
        }
        return $user;
    }

    public static function deleteFromCart($id){
        $db = Database::getConnection();
        $result = $db->prepare("DELETE FROM cart WHERE id_c=:id");
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
    }


}