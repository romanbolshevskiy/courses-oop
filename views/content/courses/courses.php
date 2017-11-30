<?php   //include_once ROOT. '/components/Cart.php'; // підключення моделі 
        include ROOT . '/views/layout/header.php'; ?>
        
        <section>
            <div class="container">
                <div class="row">

                    <div class="col-sm-12 padding-right">
                        <div class="features_items"><!--features_items-->
                            <div class="courses">
                                    <?php 
                                    if($admin){ 
                                        echo "<h3><a href='/course/create'>Create new course</a></h3>";
                                        echo "<h3><a href='/main-course/create'>Create new main relation's course</a></h3>";
                                        echo "<h3><a href='/main-courses/'>All main courses</a></h3>"; 
                                    }
                                    echo "<h2 class='title text-center'>All courses</h2>";
                                if($type == "non_information"){
                                     
                                }
                                 //PaGINATIoN
                                if(!$courses_list_menu){ echo "<h4>There are no information in this page</h4>";}
                                else { 
                                    foreach ($courses_list_menu as  $course){ 
                                        //Додаткові параметри
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
                                        //Додаткові параметри
                                        ?>
                                        <?php if($course['id_mc']){?>
                                            <?php  if($_SESSION['user']){ ?>
                                                <div class="course mc">  
                                            <?php } else{ ?>
                                                <div class="course mc1">     
                                            <?php }  ?>   
                                        <?php } else{ ?>
                                        <div class="course">  
                                        <?php } ?>
                                        
                                            <p><a class="course_a" href="/courses/<?php echo $course['url']?>">
                                                <?php if($course['id_mc']){?>
                                                    <img src="/images/main.png"></a></p>
                                                    <h3 style="color: orange;">-</h3
                                                >
                                                <?php }
                                                else{ ?>
                                                    <img src="<?php echo $file1; ?>"></a></p>
                                                    <h3 style="color: orange;"><?php echo $course['price'];?>$</h3
                                                >
                                                    <?php } ?>
                                            <h2 style="text-align: center;" class="panel-title">
                                                <b><?php echo $course['name']; ?></b>
                                            </h2>
                                            
                                            <h4>
                                                
                                                <?php 
                                                if(!$course['id_mc']){
                                                    if($_SESSION['user']){
                                                    
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
                                                    }
                                                }?>
                                            </h4>
                                            <?php  if($admin){ 
                                            if(!$course['id_mc']){ ?>
                                            <p class="edit_delete">
                                                <span><a href="/course/edit/<?php echo $course['id_c']; ?>">Edit course</a></span>
                                                <span><a href="/course/delete/<?php echo $course['id_c']; ?>">Delete course</a></span>
                                            </p>
                                            <?php  } else { ?>
                                            <p class="edit_delete">
                                                <span><a href="/main-course/edit/<?php echo $course['id_mc']; ?>">Edit </a></span>
                                                <span><a href="/course-main/delete/<?php echo $course['id_mc']; ?>">Delete </a></span>
                                            </p>
                                            <?php }  
                                            }?>
                                            </div>

                                    <?php } 
                                }  
                                echo "<div class='clear'>";
                                echo $pagination->get();
                                ?>
                                
                            </div>
                        </div><!--features_items-->

                    </div>
                </div>
            </div>
        </section>

       <?php  include ROOT. '/views/layout/footer.php'; // підключення моделі  ?>
    </body>
</html>