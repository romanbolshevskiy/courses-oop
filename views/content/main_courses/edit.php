<?php include ROOT . '/views/layout/header.php'; ?>
    

<script>
    var courses = <?php echo $courses ? json_encode($courses) : "null";  ?>;
</script>

<section>
    <div class="container">
        <div class="row">

            <div class="col-sm-5 col-sm-offset-4 padding-right">
                
                <?php if (isset($errors) && is_array($errors)){ ?>
                    <ul>
                        <?php foreach ($errors as $error){ ?>
                            <li> - <?php echo $error; ?></li>
                        <?php }  ?>
                    </ul>
                <?php }   
                if($type!="bad"){
                if ($admin){
                ?>
                    <h3>Edit main course <b><?php echo strtoupper($main_course[0]['name_mc']); ?></b></h3>            
                    <form action="" method="post" id="edit">
                        Name: <input type="text" name="name" required="required" placeholder="Name" value="<?php echo $main_course[0]['name_mc'];?>" />
                        <?php if(!$courses) { echo "<h4>There arent udercourses yet!!</h4>"; } ?>
                        <div class="courses_to_check">
                            <?php 
                            foreach ($courses_all as $course) { ?>
                                <p><input class="course_check course_check<?php echo $course['id_c']; ?>" type="checkbox" name="courses[]" value="<?php echo $course['id_c']; ?>"> <span><?php echo $course['name'] ; ?></span></p>
                            <?php }  ?>
                        </div>

                        <input type="submit" name="submit" class="btn btn-default" value="Edit" />            
                    </form>
                    <h4>
                        <a href="/courses/<?php echo $main_course[0]['url_mc']; ?>">Go back to course</a>
                        <a href="/main-courses/">Go back to all main courses</a>
                        <a href="/course-main/delete/<?php echo $main_course[0]['id_mc']; ?>">Delete</a>
                    </h4>

                <?php } else { echo " <img src='/images/error-404.png'>"; }
                 } else {  echo "<h1>There is no such main course!!!</h1>";  } ?>
                    <script>
                    if (courses) {
                        var length =courses.length;
                        //console.log(courses);
                        a = $(".course_check").val();
                        //alert(a);
                        for (var i = 0; i < length ; i++) {
                            //console.log(courses[i]['id_c']); 
                            $(".course_check"+courses[i]['id_c']).attr("checked","checked");
                        }
                    }
                </script>
                <br/>
                <br/>
            </div>

        </div>
    </div>
</section>

<?php include ROOT . '/views/layout/footer.php'; ?>