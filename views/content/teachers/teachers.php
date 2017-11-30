        <?php include ROOT . '/views/layout/header.php'; ?>

        <section>
            <div class="container">
                <div class="row">
          
                    <div class="col-sm-11 padding-right">
                        <div class="features_items"><!--features_items-->
                            <h2 class="title text-center"><a href="/user/register/">Create new teacher</a></h2>
                            <h2 class="title text-center">All teachers</h2>

                            <div class="teachers">
                                <?php foreach ($teachers as  $teacher){
                                    $path = 'images/users/user'.$teacher['id_t'].'.png';
                                    $file = "/".$path;
                                    if (file_exists($_SERVER['DOCUMENT_ROOT'].$file)) {
                                        $file1 = $file;
                                    }
                                    else {  
                                        $file1 = '/images/users/none.png';
                                    }
                                 ?>
                                    <div class="teacher">  
                                        <p><a style="display: block;" href="/teacher/<?php echo $teacher['id_t']?>"><img src="<?php echo $file1;?>" alt="placeholder+image"></a></p>
                                        <h4 ><a href="/teacher/<?php echo $teacher['id_t']?>"> <?php echo $teacher['name'] . " " . $teacher['surname'] ?></a></h4>
                                        <p> Degree: <?php echo $teacher['degree']; ?></p>
                                        <p> Working place: <?php echo $teacher['working_place'] ?></p>
                                        <p> Description: <?php echo $teacher['description'] ?></p>
                                        <p> More info: <a href="/teacher/<?php echo $teacher['id_t']?>">here</a> </p>
                                    </div>
                                <?php } ?> 
                                <div class="clear"></div>
                                <p id="more3">More</p>
                                <p id="less3">Less</p>
                            </div>

                        </div><!--features_items-->
                        <script type="text/javascript">
                            size3 = $(".teachers .teacher").size();
                            x=3;

                            $('#less3').hide();
                            if(size3 <=x) {  $('#more3').hide();}
                            
                            $('.teachers .teacher:lt('+x+')').show();
                            

                          $('#more3').click(function () {
                            if(x+3 < size3){
                                x=x+3;
                                $('.teachers .teacher:lt('+x+')').css('display','inline-block');
                                $('.teachers .teacher:lt('+ (x-3) +')').hide(0);
                            }
                            else{
                                y=size3-x;
                                x=x+3;
                                $('.teachers .teacher:lt('+ (size3) +')').css('display','inline-block');
                                $('.teachers .teacher:lt('+(size3-y)+')').hide(0);
                                $(this).hide(0);
                            }
                            $('#less3').show();
                        });

                        $('#less3').click(function () {
                            if(x-3<=3){
                                x=x-3;
                                $(this).hide(0);
                            }
                            else{
                                x=x-3;      
                            }
                            $('.teachers .teacher').not(':lt('+(x-3)+')').css('display','inline-block');
                            $('.teachers .teacher').not(':lt('+(x)+')').hide();
                            $('#more3').show();
                        });


                        </script>


                    </div>
                </div>
            </div>
        </section>

       <?php  include ROOT. '/views/layout/footer.php'; // підключення моделі  ?>
    </body>
</html>