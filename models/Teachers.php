<?php
class Teachers  {

	public static function 	getTeachers() {
        $db = Database::getConnection();
        // треба лефт джойн з тічерсами!!
        $result = $db->query('SELECT * FROM  users LEFT JOIN teachers ON teachers.id_t = users.id_u WHERE user_type = "teacher" ');       
      	$i = 0;
		while ($row = $result->fetch()) {
		 	$user[$i] = $row;
	        $i++;
		}
		return $user;
    }


    public static function 	getTeacherInfo($id) {
        $db = Database::getConnection();
        // треба лефт джойн з тічерсами!!
        $result = $db->prepare("SELECT * FROM  users LEFT JOIN teachers ON teachers.id_t = users.id_u WHERE id_t = :id"); 
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();      
      	$i = 0;
		while ($row = $result->fetch()) {
		 	$user[$i] = $row;
	        $i++;
		}
		return $user;
    }

    public static function  getTeachersCourses($id) {
        $db = Database::getConnection();
        $result = $db->prepare("SELECT * FROM  users LEFT JOIN courses ON courses.id_t = users.id_u WHERE id_t = :id"); 
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();      
        $i = 0;
        while ($row = $result->fetch()) {
            $user[$i] = $row;
            $i++;
        }
        return $user;
    }

    public static function updateNullOldCourses($id) {
        $db = Database::getConnection();
        $result = $db->prepare("UPDATE courses SET  id_t=0  WHERE id_t =:id" );
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
    }


    public static function updateIdtInCourses($courses_checked, $id) {
        $db = Database::getConnection();
        for($i = 0; $i < count($courses_checked); $i++){
            $result = $db->prepare("UPDATE courses SET id_t=:id  WHERE id_c =" . $courses_checked[$i]);
            $result->bindParam(':id', $id, PDO::PARAM_INT);
            $result->execute();
        }
    }

    public static function deleteTeacherById($id){
        $db = Database::getConnection();
        $result = $db->prepare("DELETE FROM teachers WHERE id_t  = :id");
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
    }

    public static function deleteUserById($id){
        $db = Database::getConnection();
        $result = $db->prepare("DELETE FROM users WHERE id_u  = :id");
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
    }


    public static function deleteFromCart($id){
        $db = Database::getConnection();
        $result = $db->prepare("DELETE FROM cart WHERE id_u  = :id");
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
    }

    public static function  getBestTeachers() {
        $db = Database::getConnection();
        // треба лефт джойн з тічерсами!!
        $result = $db->query("SELECT * FROM  users LEFT JOIN teachers ON teachers.id_t = users.id_u WHERE teachers.best=1 ");
        $i = 0;
        while ($row = $result->fetch()) {
            $course[$i] = $row;
            $i++;
        }
        return $course;
    }


  public static function  teacherById($id) {
        $db = Database::getConnection();
        $result = $db->prepare("SELECT * FROM  users  WHERE id_u = :id"); 
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();      
        $i = 0;
        while ($row = $result->fetch()) {
            $user[$i] = $row;
            $i++;
        }
        return $user;
    }

    public static function updateInUsers($name, $surname,$email,
        $password, $admin , $id) {
        $db = Database::getConnection();
        $result = $db->prepare("UPDATE users SET name=:name, surname=:surname, email=:email,  password=:password, is_admin=:admin WHERE id_u = :id");
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':surname', $surname, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        $result->bindParam(':admin', $admin, PDO::PARAM_INT);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
    }


    public static function updateInTeachers($best,$degree,$working,$description, $id) {
        $db = Database::getConnection();
        $result = $db->prepare("UPDATE teachers SET best=:best, degree=:degree, working_place=:working, description=:description WHERE id_t = :id");
        $result->bindParam(':best', $best, PDO::PARAM_INT);
        $result->bindParam(':degree', $degree, PDO::PARAM_STR);
        $result->bindParam(':working', $working, PDO::PARAM_STR);
        $result->bindParam(':description', $description, PDO::PARAM_STR);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
    }
}

?>
