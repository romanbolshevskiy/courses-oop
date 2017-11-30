<?php


class Site  {


	public static function getLatest($count) {

		$db = Database::getConnection();
		
		$c = (int) $count;
		//echo  $c;
		$result = $db->query('SELECT * FROM product WHERE status = "1" ORDER BY id DESC LIMIT ' . $c );

		$i = 0;
		while ($row = $result->fetch()) {
		 	$latest[$i]['id'] = $row['id'];
	        $latest[$i]['name'] = $row['name'];
	        $latest[$i]['image'] = $row['image'];
	        $latest[$i]['price'] = $row['price'];
	        $latest[$i]['is_new'] = $row['is_new'];
	        $i++;
		}

		return $latest;

	}

	// продукти по категорії //
	public static function getCatProducts($cat_id, $page , $count) {

		$db = Database::getConnection();
		
		$c = (int) $count;
		$categoryProducts = [];
		if($page != 1){
			$page1 = explode('-', $page); // news  view  12
			$p = $page1[1];

			$offset = ($p - 1) * $c; // шоб з другої сторінки починався офсет -відступ
			$offset = (int)($offset) ; //для пагінації
			//echo "offset: $offset";

			//echo  $c;
			$result = $db->query('SELECT * FROM product WHERE status = 1 AND category_id = ' .$cat_id . ' ORDER BY id  LIMIT ' . $c . ' OFFSET '. $offset);
		}
		else{

			$result = $db->query('SELECT * FROM product WHERE status = 1 AND category_id = ' .$cat_id . ' ORDER BY id  LIMIT ' . $c );
		}



		$i = 0;
		while ($row = $result->fetch()) {
		 	$categoryProducts[$i]['id'] = $row['id'];
	        $categoryProducts[$i]['name'] = $row['name'];
	        $categoryProducts[$i]['image'] = $row['image'];
	        $categoryProducts[$i]['price'] = $row['price'];
	        $categoryProducts[$i]['is_new'] = $row['is_new'];
	        $i++;
		}

		return $categoryProducts;

	}


	public static function getProductById($id) {


		$db = Database::getConnection();
		$result = $db->query('SELECT * FROM product WHERE id =' . $id );
		$product = [];
		$i = 0;
		while ($row = $result->fetch()) {
		 	$product[$i]['id'] = $row['id'];
	      $product[$i]['name'] = $row['name'];
	      $product[$i]['code'] = $row['code'];
	      $product[$i]['price'] = $row['price'];
	      $product[$i]['is_new'] = $row['is_new'];
	      $product[$i]['description'] = $row['description'];

	      $product[$i]['brand'] = $row['brand'];
			$product[$i]['category_id'] = $row['category_id'];
			$product[$i]['availability'] = $row['availability'];
			$product[$i]['is_recommended'] = $row['is_recommended'];
			$product[$i]['status'] = $row['status'];


	        $i++;
		}

		return $product;

	}

    /**
     * Возвращает список рекомендуемых товаров
     * @return array <p>Массив с товарами</p>
     */
   public static function getRecommendedProducts() {
     // Соединение с БД
   		$db = Database::getConnection();
		$result = $db->query('SELECT * FROM courses WHERE  is_recommended = "1" ORDER BY id_c DESC');
     	$i = 0;
     	while ($row = $result->fetch()) {
		   $productsList[$i] = $row;
		  
		   $i++;
		}
     return $productsList;
   }


   //  для адміна //

    /**   * Возвращает список товаров   * @return array <p>Массив с товарами</p>  */
    public static function getProductsList() {
        // Соединение с БД
      $db = Database::getConnection();
	$result = $db->query('SELECT * FROM product ORDER BY id ASC');

      $productsList = array();
      $i = 0;
     	while ($row = $result->fetch()) {
            $productsList[$i]['id'] = $row['id'];
            $productsList[$i]['name'] = $row['name'];
            $productsList[$i]['code'] = $row['code'];
            $productsList[$i]['price'] = $row['price'];
            $i++;
     	}
     	return $productsList;
    }





  	/**    * Добавляет новый товар * @param array $options <p>Массив с информацией о товаре</p>  * @return integer <p>id добавленной в таблицу записи</p>  */

   public static function createProduct($options)  {
   	$db = Database::getConnection();
		$result = $db->query("INSERT INTO product
                (name, code, price, category_id, brand, availability,description, is_new, is_recommended, status)
		        VALUES ('".$options['name']."','".$options['code']."',
		        '".$options['price']."','".$options['category_id']."',
		        '".$options['brand']."','".$options['availability']."',
		        '".$options['description']."','".$options['is_new']."',
		        '".$options['is_recommended']."','".$options['status']."')");
		//$result = true;
      // Получение и возврат результатов. Используется подготовленный запрос

   }

	public static function lastInsertId() {
        // Соединение с БД
    	$db = Database::getConnection();
		$result = $db->query('SELECT id FROM product ORDER BY id DESC LIMIT 1');

		$row = $row = $result->fetch();
		return $row['id'];
   }



   /**
     * Редактирует товар с заданным id
     * @param integer $id <p>id товара</p>
     * @param array $options <p>Массив с информацей о товаре</p>
     * @return boolean <p>Результат выполнения метода</p>
   */
   public static function updateProductById($id, $options) {
      // Соединение с БД
	   $db = Database::getConnection();
		$result = $db->query("UPDATE product  SET
            name = '". $options['name'] ."',
            code = '". $options['code'] ."' ,
            price ='". $options['price'] ."',
            category_id ='". $options['category_id'] ."',
            brand ='". $options['brand'] ."',
            availability ='". $options['availability'] ."',
            description ='". $options['description'] ."',
            is_new ='". $options['is_new'] ."',
            is_recommended ='". $options['is_recommended'] ."',
            status ='". $options['status'] ."' WHERE id ='" . $id ."' ");
   }

    /**
     * Возвращает путь к изображению
     * @param integer $id
     * @return string <p>Путь к изображению</p>
    */
    public static function getImage($id) {
        // Название изображения-пустышки
        $noImage = 'no-image.jpg';

        // Путь к папке с товарами
        $path = '/images/products/';

        // Путь к изображению товара
        $pathToProductImage = $path . $id . '.jpg';

        if (file_exists($_SERVER['DOCUMENT_ROOT'].$pathToProductImage)) {
            // Если изображение для товара существует
            // Возвращаем путь изображения товара
            return $pathToProductImage;
        }

        // Возвращаем путь изображения-пустышки
        return $path . $noImage;
    }

}