        <?php include ROOT . '/views/layout/header.php'; ?>
        <section>
            <div class="container">
                <div class="row">

                    <div class="col-sm-12 padding-right">
                        <div class="features_items"><!--features_items-->
                            <div class="courses" style="border: 1px solid;">
                                <?php if(!$teacher){ ?> 
                                    <h3>There is not such teacher </h3>
                                <?php } else { ?>
                                    <div class="course_ind edit_teacher">  
                                        <div class="left">
                                            <img src="<?php echo $file1; ?>">
                                        </div>
                                        <div class="right">
                                            <h4><?php echo $teacher[0]['name'] ." " .$teacher[0]['surname']; ?></h4>  
                                            <h4>Email: <?php echo $teacher[0]['email']; ?></h4>
                                            <h4>Registered: <?php echo $teacher[0]['date_register'];?></h4>
                                            <h4>Degree:<?php echo $teacher[0]['degree'];?></h4>
                                            <h4>Working place: <?php echo $teacher[0]['working_place'];?></h4>
                                            <h4>Description: <?php echo $teacher[0]['description'];?></h4>
                                        </div>
                                        <div class="clear"></div>
                                        <p>
                                        <div class="his_courses">
                                            <h3>His courses:</h3>
                                            <?php if($his_courses) {
                                                foreach ($his_courses as $course) {?>
                                                    <div class="his">
                                                    <p><?php echo $course['name'];?></p>
                                                    <iframe width="100%" height="300px" src="<?php echo $course['video'];?>" frameborder="0" allowfullscreen>
                                                    </iframe>
                                                    </div>
                                                <?php }?>
                                                <div class="clear"></div>
                                                <button id="loadMore">Next</button>
                                                <button id="showLess">Preview</button>
                                            <?php }  else {?>
                                                <h3>His teacher hasn't courses yet.</h3>
                                            <?php }?>
                                        </div>
                                        </p>
                                    </div>
                                    <?php if($admin){ ?>
                                    <h5 class="edit_delete">
                                        <span><a href="/teacher/edit/<?php echo $teacher[0]['id_t']; ?>">Edit teacher</a></span>
                                        <span><a href="/teacher/delete/<?php echo $teacher[0]['id_t']; ?>">Delete teacher</a></span>
                                    </h5>
                                <?php } }; ?>
                            </div>
                        </div><!--features_items-->
                        <script type="text/javascript">
                            
                            size5 = $(".his_courses .his").size();
                            x=3;
                            if(size5 <=x) {  $('#loadMore').hide();}
                            $('.his_courses .his').hide(0);
                            $('.his_courses .his:lt('+ (x) +')').css('display','inline-block');

                            if(x-3<=0){
                                $('#showLess').hide();
                            }
                            $('#loadMore').click(function () {

                                if(x+3 < size5){
                                    x=x+3;
                                    $('.his_courses .his:lt('+x+')').show(0);
                                    $('.his_courses .his:lt('+ (x-3) +')').hide(0);
                                }
                                else{
                                    y=size5-x;
                                    x=x+3;
                                    $('.his_courses .his:lt('+size5+')').show(0);
                                    $('.his_courses .his:lt('+ (size5-y) +')').hide(); 
                                    $(this).hide(0);
                                }
                                $('#showLess').show();
                            });

                            $('#showLess').click(function () {
                                if(x-3<=3){
                                    x=x-3;
                                    $(this).hide(0);
                                }
                                else{
                                    x=x-3;      
                                }
                                $('.his_courses .his').not(':lt('+(x-3)+')').show();
                                $('.his_courses .his').not(':lt('+(x)+')').hide();
                                $('#loadMore').show();
                            });

                        </script>

                    </div>
                </div>
            </div>
        </section>

       <?php  include ROOT. '/views/layout/footer.php'; // підключення моделі  ?>
    </body>
</html>