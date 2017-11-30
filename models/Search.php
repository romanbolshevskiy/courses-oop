<?php
class Search{

	public static function searchWord($word) {
		$db = Database::getConnection();
        $result = $db->prepare("SELECT * FROM courses WHERE name LIKE '%".$word."%'") /*ESCAPE '|'*/;
        $result->execute();
		$i = 0;
		while ($row = $result->fetch()) {
		 	$course[$i] = $row;
            $i++;
		}
		return $course;
	}

}