        <?php include ROOT . '/views/layout/header.php'; ?>
        <section>
            <div class="container">
                <div class="row">
                    <h3>Main courses</h3>
                    <div class="col-sm-12 padding-right">
                        <div class="features_items"><!--features_items-->
                            <div class="courses">
                                    <?php
                                    foreach ($main_courses_list as $course) {
                                     //foreach (array_unique($a) as  $b){
                                       
                                       //if($b['id_mc']==$course['id_mc']){
                                        ?>
                                        <div class="course">  
                                            <p><a href="/courses/<?php echo $course['url_mc'];?>"><img src="/images/main.png"></a></p>
                                            <h2 style="text-align: center;" class="panel-title">
                                                <?php echo $course['name_mc']; ?>
                                            </h2>
                                            <p class="edit_delete">
                                                <span><a href="/main-course/edit/<?php echo $course['id_mc']; ?>">Edit main_course</a></span>
                                                <span><a href="/course-main/delete/<?php echo $course['id_mc']; ?>">Delete main_course</a></span>
                                            </p>
                                        </div>
                                    <?php    } //} }?>
                            </div>
                        </div><!--features_items-->
                      
                    </div>
                </div>
            </div>
        </section>

       <?php  include ROOT. '/views/layout/footer.php'; // підключення моделі  ?>
    </body>
</html>