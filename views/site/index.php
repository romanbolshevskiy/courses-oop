        <?php include ROOT . '/views/layout/header.php'; ?>
        <?php include_once ROOT. '/models/Teachers.php'; // підключення моделі?>

        <section>
            <div class="container">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="left-sidebar">
                            <h2>Каталог</h2>
                           <div class="panel-group category-products">
                                <div class="search">
                                    <h4>Find what you need here</h4>

                                    <form action="/find/" method="post" >
                                      
                                        <input  type="text"  name="search" id="search" list="courses">
                                        <datalist id="courses">
                                            <?php  foreach ($coursesAll as  $value) {?>
                                                <option value="<?php echo $value['name']; ?>">
                                            <?php }  ?>
                                        </datalist>
                                        <input type="submit" value="Search">
                                      </form>
                                </div>
                           </div>

                            <div class="panel-group category-products">
                                <h2>Reccomends courses:</h2>
                                <?php foreach ($coursesList as $course): ?>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a href="/courses/<?php echo $course['url'];?>">
                                                    <?php echo $course['name'];?>
                                                </a>
                                            </h4>
                                        </div>
                                    </div>
                                <?php endforeach; ?>

                            </div>

                            <div class="panel-group category-products">
                                <h2>Best teachers:</h2>
                                <?php foreach ($teachersList as $teacher): ?>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a href="/courses/<?php echo $course['url'];?>">
                                                    <?php echo $teacher['name'] ." " .$teacher['surname'];?>
                                                </a>
                                            </h4>
                                        </div>
                                    </div>
                                <?php endforeach; ?>

                            </div>

                        </div>
                    </div>

                    <div class="col-sm-9 padding-right">
                        <div class="features_items" style="border: 1px solid;padding: 2%;"><!--features_items-->
                            <h2 class="title text-center">New courses</h2>
                            <?php foreach ($latest as $course):
                                $is_id_cu = Cart::isItIdCU($_SESSION['user'],$course['id_c']); 
                                $bought = Order::isItBought($_SESSION['user'],$course['id_c'],$buy=1);
                                $process = Order::isItBought($_SESSION['user'],$course['id_c'],$buy=0);
                                $path = 'images/courses/course'.$course['id_c'].'.png';
                                $file = "/".$path;
                                if (file_exists($_SERVER['DOCUMENT_ROOT'].$file)) {
                                    $file1 = $file;
                                }
                                else {  
                                    $file1 = '/images/courses/none.png';
                                }
                             ?>
                                <div class="col-sm-4">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <a href="/courses/<?php echo $course['url'];?>"><img src="<?=$file1;?>" alt="" /></a>
                                                <h2><?php echo $course['price'];?>$</h2>
                                                <p>
                                                    <a href="/courses/<?php echo $course['url'];?>" class="name_course">
                                                        <?php echo $course['name'];?>
                                                    </a>
                                                </p>
                                                <h4>
                                                    <?php if($_SESSION['user']){
                                                    
                                                    if(!$is_id_cu && !$bought && !$process){?>
                                                    <a href="#" class="add-to-cart" 
                                                        data-idc ="<?php echo $course['id_c'];?>" 
                                                        data-price ="<?php echo $course['price'];?>" 
                                                        data-name ="<?php echo $course['name'];?>" 
                                                        data-url ="<?php echo $course['url'];?>" 
                                                        data-idu="<?php echo $_SESSION['user'];?>">
                                                        Add to cart
                                                    </a>
                                                    <?php } else if($is_id_cu){
                                                        echo "<span style='color:orange;' >Added already</span>";

                                                    } else if(!$is_id_cu && $bought){
                                                         echo "<span style='color:red;' >Bought</span>";
                                                    }
                                                    else if(!$is_id_cu && !$bought && $process){
                                                         echo "<span style='color:lightgreen;' >In process</span>";
                                                    }
                                                    }?>
                                                </h4>
                                            </div>
                                            <img src="/assets/images/home/new.png" class="new" alt="" />
                                            
                                            <?php  if($admin){  ?>
                                            <p class="edit_delete" style="text-align: center;">
                                                <span><a href="/course/edit/<?php echo $course['id_c']; ?>">Edit course</a></span>
                                                <span><a href="/course/delete/<?php echo $course['id_c']; ?>">Delete course</a></span>
                                            </p>
                                            <?php }  ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach;?>

                        </div><!--features_items-->
                    
                        <hr/>

                        <div class="recommended_items"><!--recommended_items-->
                            <h2 class="title text-center">Reccomends courses</h2>

                            <div class="slider"   >
                                <?php foreach ($coursesList as $course){
                                    $is_id_cu = Cart::isItIdCU($_SESSION['user'],$course['id_c']);
                                    $bought = Order::isItBought($_SESSION['user'],$course['id_c'],$buy=1);
                                    $process = Order::isItBought($_SESSION['user'],$course['id_c'],$buy=0);
                                    $path = 'images/courses/course'.$course['id_c'].'.png';
                                    $file = "/".$path;
                                    if (file_exists($_SERVER['DOCUMENT_ROOT'].$file)) {
                                        $file1 = $file;
                                    }
                                    else {  
                                        $file1 = '/images/courses/none.png';
                                    }   
                                    ?>
                                    <div class="item">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center">
                                                    <img src="<?=$file1;?>">
                                                    <h2>$<?php echo $course['price']; ?></h2>
                                                    <a href="/courses/<?php echo $course['url']; ?>" class="name_course">
                                                        <?php echo strtoupper($course['name']); ?>
                                                    </a>
                                                    <h4 id="add-to-cart">
                                                        <?php if($_SESSION['user']){
                                                        
                                                        if(!$is_id_cu && !$bought && !$process){?>
                                                        <a href="#" class="add-to-cart" 
                                                            data-idc ="<?php echo $course['id_c'];?>" 
                                                            data-price ="<?php echo $course['price'];?>" 
                                                            data-name ="<?php echo $course['name'];?>" 
                                                            data-url ="<?php echo $course['url'];?>" 
                                                            data-idu="<?php echo $_SESSION['user'];?>">
                                                            Add to cart
                                                        </a>
                                                        <?php } else if($is_id_cu){
                                                            echo "<span style='color:orange;' >Added already</span>";

                                                        } else if(!$is_id_cu && $bought){
                                                             echo "<span style='color:red;' >Bought</span>";
                                                        }
                                                        else if(!$is_id_cu && !$bought && $process){
                                                             echo "<span style='color:lightgreen;' >In process</span>";
                                                        }
                                                        }?>
                                                    </h4>
                                                </div>
                                                
                                                <?php  if($admin){  ?>
                                                <p class="edit_delete" style="text-align: center;">
                                                    <span><a href="/course/edit/<?php echo $course['id_c']; ?>">Edit course</a></span>
                                                    <span><a href="/course/delete/<?php echo $course['id_c']; ?>">Delete course</a></span>
                                                </p>
                                                <?php }  ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>

                            <a class="left recommended-item-control" id="prev"> < </a>
                            <a class="right recommended-item-control" id="next"> > </a>

                        </div><!--/recommended_items-->
                        
                        <hr/>

                        <div class="best_teachers"><!--recommended_items-->
                            <h2 class="title text-center">Best teachers</h2>

                            <div class="slider2" >
                                <?php foreach ($teachersList as $teacher){
                                    $path = 'images/users/user'.$teacher['id_t'].'.png';
                                    $file = "/".$path;
                                    if (file_exists($_SERVER['DOCUMENT_ROOT'].$file)) {
                                        $file1 = $file;
                                    }
                                    else {  
                                        $file1 = '/images/users/none.png';
                                    }
                                ?>
                                    <div class="item">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center">
                                                    <img src="<?php echo $file1;?>">
                                                    <h5 class="name_course" style="color:orange;"><?php echo ($teacher['name'] ." ".$teacher['surname']) ; ?></h5>
                                                    <p>
                                                        <?php echo 'Work in: '. $teacher['working_place'] ; ?>
                                                    </p>
                                                    <a href="/teacher/<?php echo $teacher['id_t'];?>" class="name_course">More info</a>
                                                </div>
                                                <?php if ($teacher['is_new']): ?>
                                                    <img src="/assets/images/home/new.png" class="new" alt="" />
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>

                            <a class="left recommended-item-control2" id="prev2"> < </a>
                            <a class="right recommended-item-control2" id="next2"> > </a>

                        </div><!--/recommended_items-->
                    </div>
                </div>

            </div>
        </section>
        <script type="text/javascript">
                                
          

        </script>
       <?php  include ROOT. '/views/layout/footer.php'; // підключення моделі  ?>
    </body>
</html>