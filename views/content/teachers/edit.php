        <?php include ROOT . '/views/layout/header.php'; ?>
        <section>
            <div class="container">
                <div class="row">

                    <div class="col-sm-12 padding-right">
                        
                      
                        <div class="features_items"><!--features_items-->
                            <?php if (isset($errors) && is_array($errors)){ ?>
                                <ul>
                                    <?php foreach ($errors as $error){ ?>
                                        <h4><li> - <?php echo $error; ?></li></h4>
                                    <?php }  ?>
                                </ul>
                            <?php } ?>   

                            <form action="" method="post" enctype="multipart/form-data">
                            <div class="courses" style="border: 1px solid;padding: 2%;">
                                <?php if(!$teacher){ ?> 
                                    <h3>There is not such teacher </h3>
                                <?php } else { ?>
                                    <div class="course_ind edit_teacher">  
                                        <div class="left">
                                            <img src ="<?php echo $file1;?>"/>
                                            <p>
                                            <input name="picture" type="file" /></p>
                                        </div>
                                        <div class="right">
                                            <h4>
                                                <span>Name:</span>
                                                <span> <input type="text" name="name" value="<?php echo $teacher[0]['name']; ?>"/></span>
                                            </h4>
                                            <h4>
                                                <span>Surname: </span>
                                                <span><input type="text" name="surname" value="<?php echo $teacher[0]['surname']; ?>"/></span>       
                                            </h4>
                                            <h4>
                                                <span>Email:</span> 
                                                <span><input type="text" name="email" value="<?php echo $teacher[0]['email']; ?>"/></span>       
                                            </h4>
                                            <h4>
                                                <span>Password: </span>
                                                <span><input type="text" name="password" value="<?php echo $teacher[0]['password']; ?>"/></span>       
                                            </h4>
                                            <h4 class="adm">
                                                <div class="selects">
                                                    <span>Is_admin:</span> 
                                                    <span>
                                                        <select id="sel_admin" name="admin">
                                                            <option value="0">0</option>
                                                            <option value="1">1</option>
                                                        </select></span>
                                                    <script type="text/javascript">
                                                        var admin = <?php echo $teacher[0]['is_admin'] ? json_encode($teacher[0]['is_admin']) : "null";  ?>;//1
                                                        adm= $( "#sel_admin").val(admin).attr('selected','selected');
                                                    </script> 
                                                </div> 
                                                <div class="selects">
                                                    <span>Best teacher:</span> 
                                                    <span>
                                                        <select id="best" name="best">
                                                            <option value="0">0</option>
                                                            <option value="1">1</option>
                                                        </select></span>
                                                    <script type="text/javascript">
                                                        var best = <?php echo $teacher[0]['best'] ? json_encode($teacher[0]['best']) : "null";  ?>;//1
                                                        adm= $( "#best").val(best).attr('selected','selected');
                                                    </script>   
                                                </div> 
                                            </h4>
                                            <h4>
                                                <span>Degree:</span>
                                                <span> <input type="text" name="degree" value="<?php echo $teacher[0]['degree']; ?>"/></span>       
                                            </h4>
                                            <h4>
                                                <span>Working place:</span>
                                                <span> <input type="text" name="working" value="<?php echo $teacher[0]['working_place']; ?>"/></span>       
                                            </h4>
                                            <h4>
                                                <span>Description:</span>
                                                <span><textarea name="description" resize="no"><?php echo $teacher[0]['description'];?></textarea>   </span>    
                                            </h4>
                                        </div>
                                        <div class="clear"></div>
                                        <p>
                                        <div class="his_courses_edit">
                                            <h3>His courses:</h3>
                                                <div class="courses_to_check">
                                                <?php 
                                                foreach ($courses_all as $course) { ?>
                                                    <p><input class="course_check course_check<?php echo $course['id_c']; ?>" type="checkbox" name="courses[]" value="<?php echo $course['id_c']; ?>"> <span><?php echo $course['name'] ; ?></span></p>
                                                <?php }  ?>
                                            </div>
                                        </div>
                                        </p>
                                    </div>
                                     <input type="submit" name="submit" class="btn btn-default" value="Edit" />
                                    <h5 class="edit_delete">
                                        <span><a href="/teacher/delete/<?php echo $teacher[0]['id_t']; ?>">Delete teacher</a></span>
                                        <span><a href="/teacher/<?php echo $teacher[0]['id_t']; ?>">Go to teacher</a></span>
                                    </h5>
                                <?php } ?>
                            </div>
                            </form>
                        </div><!--features_items-->
                        <script type="text/javascript">

                            var his_courses = <?php echo $his_courses ? json_encode($his_courses) : "null";  ?>;
                            if (his_courses) {
                                var length =his_courses.length;
                                //console.log(courses);
                                a = $(".course_check").val();
                                //alert(a);
                                for (var i = 0; i < length ; i++) {
                                    //console.log(courses[i]['id_c']); 
                                    $(".course_check"+his_courses[i]['id_c']).attr("checked","checked");
                                }
                            }


                            
                        </script>

                    </div>
                </div>
            </div>
        </section>

       <?php  include ROOT. '/views/layout/footer.php';   ?>
    </body>
</html>