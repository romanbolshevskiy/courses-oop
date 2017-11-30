<?php   include_once ROOT. '/components/Cart.php'; // підключення моделі 
        include ROOT . '/views/layout/header.php'; ?>
        
        <section>
            <div class="container">
                <div class="row">

                    <div class="col-sm-12 padding-right">
                        <div class="features_items"><!--features_items-->
                            <div class="courses">
                                <?php 
                                if($type=="simple"){ // для вивиода піделементів
                                    if(!$courses) {?>
                                        <h3>Course hasnt some information yet </h3>
                                        <h4>You can edit it <a href='/main-course/edit/<?php echo $id; ?>'>here </></h4> 
                                    <?php }else{
                                        echo "<h2 class='title text-center'>All courses in ".$url['2'] ."</h2>";
                                        foreach ($courses as  $course){
                                           $is_id_cu = Cart::isItIdCU($_SESSION['user'],$course['id_c']); 
                                        ?>
                                        <div class="course <?php echo $course['id_c']; ?> " >     
                                            <p><a class="course_a" href="/courses/<?php echo $arr_main_courses[0];?>/<?php echo $course['url'] ?>">
                                                <img src="/images/courses/course<?php echo $course['id_c']; ?>.png">
                                            </a></p>
                                            <h2 style="text-align: center; font-weight: bold;" class="panel-title">
                                                <?php echo $course['name']; ?>
                                            </h2>
                                            <h4>
                                                <?php if($_SESSION['user']){
                                                    if(!$is_id_cu){?>
                                                    <a href="#" class="add-to-cart" 
                                                        data-idc ="<?php echo $course['id_c'];?>" 
                                                        data-price ="<?php echo $course['price'];?>" 
                                                        data-name ="<?php echo $course['name'];?>" 
                                                        data-url ="<?php echo $course['url'];?>" 
                                                        data-idu="<?php echo $_SESSION['user'];?>">
                                                        Add to cart
                                                    </a>
                                                    <?php } else {
                                                        echo "<span style='color:orange;' >Added already</span>";
                                                    }
                                                }?>
                                            </h4>
                                            <?php  if($admin){  ?>
                                            <p class="edit_delete">
                                                <span><a href="/course/edit/<?php echo $course['id_c']; ?>">Edit course</a></span>
                                                <span><a href="/course/delete/<?php echo $course['id_c']; ?>">Delete course</a></span>
                                            </p>
                                            <?php }  ?>
                                        </div>
                                    <?php } }
                                }   
                                else if($type=="view"){ // для вивиода індивідуально елемента
                                    foreach ($course_info as  $course){
                                        echo "<h2 class='title text-center'>".$course['name'] ."</h2>";
                                        $is_id_cu = Cart::isItIdCU($_SESSION['user'],$course['id_c']);
                                    ?> 
                                        <div class="course_ind">  
                                            <div class="left">
                                                <?php if($bought || ($_SESSION['user']==$course['id_t'])){  ?>
                                                    <iframe width="100%" height="400px" src="<?= $course['video'] ?>" frameborder="0" allowfullscreen></iframe>
                                                <?php } else { ?> 
                                                    <iframe width="100%" height="400px" src="<?= $course['trailer'] ?>" frameborder="0" allowfullscreen></iframe>
                                                <?php }  ?> 
                                            </div>
                                            <div class="right">

                                                <h3><?php echo $course['name']; ?> , id_course: <?php echo $course['id_c']; ?></h3>
                                                <p><?php echo $course['description']; ?></p>
                                                <h3 style="color: #FE980F;">Price: <?php echo $course['price']; ?>$</h3>
                                                <h4 >Teacher:<a style="color: #FE980F;" href="/teacher/<?php echo $course['id_t'];?>"><?php echo $teacher_info[0]['name'] .' '. $teacher_info[0]['surname'];?></a></h4>
                                                <h5 style="color: #FE980F;">
                                                    Course's students:
                                                    <?php
                                                    if($course_students){?>
                                                    <div class="students_of_course">
                                                    <?php
                                                        foreach ($course_students as $student) { 
                                                        if($student['id_user']!=$_SESSION['user'])?>
                                                            <p><a href="/user/<?=$student['id_user']?>"><?=$student['user'] .":".$student['id_user']?></a></p>
                                                    <?php }?>
                                                    </div>
                                                    <?php } else { echo "There aren't student yet"; }?>
                                                    
                                                </h5>

                                                <h4>
                                                <?php if($_SESSION['user'] && $_SESSION['user']!=$course['id_t'] ){
                                                    if(!$is_id_cu){?>
                                                    <a href="#" class="add-to-cart" 
                                                        data-idc ="<?php echo $course['id_c'];?>" 
                                                        data-price ="<?php echo $course['price'];?>" 
                                                        data-name ="<?php echo $course['name'];?>" 
                                                        data-url ="<?php echo $course['url'];?>" 
                                                        data-idu="<?php echo $_SESSION['user'];?>">
                                                        Add to cart
                                                    </a>
                                                    <?php } else {
                                                        echo "<span style='color:orange;' >Added already</span>";
                                                    }
                                                }else{}
                                                ?>
                                                </h4>
                                            </div>
                                        </div>
                                        <?php  if($admin){  ?>
                                        <p class="edit_delete">
                                            <span><a href="/course/edit/<?php echo $course['id_c']; ?>">Edit course</a></span>
                                            <span><a href="/course/delete/<?php echo $course['id_c']; ?>">Delete course</a></span>
                                        </p>
                                        <?php } ?>
                                <?php }  }
                                else if($type == "non_information"){
                                     
                                }
                                else { echo "<h3>There is not such course </h3>"; } ?>

                            </div>
                        </div><!--features_items-->

                    </div>
                </div>
            </div>
        </section>

       <?php  include ROOT. '/views/layout/footer.php'; // підключення моделі  ?>
    </body>
</html>