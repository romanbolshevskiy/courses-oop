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
                        <h3>You searched this *<?php echo  $data['search'];?>* </h3>
                        <?php if($found){ 
                            foreach ($found as $course) { 
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
                                                    <a href="/courses/<?php echo $course['url'];?>">
                                                        <?php echo $course['name'];?>
                                                    </a>
                                                </p>
                                                <h4><?php if($_SESSION['user']){
                                                     if(!$is_id_cu){?>
                                                    <a href="#" class="add-to-cart" data-idc ="<?php echo $course['id_c'];?>" data-idu="<?php echo $_SESSION['user'];?>">Add to cart</a>
                                                    <?php } else {
                                                        echo "<span style='color:orange;' >Added already</span>";
                                                    }
                                                    }?>
                                                </h4>
                                            </div>
                                           <!--  <img src="/assets/images/home/new.png" class="new" alt="" /> -->

                                        </div>
                                    </div>
                                </div>
                            <?php }
                            }else {
                                echo "<h4>There isnt one courses which you want.</h4>"; 
                            }  ?>

                    </div>
                </div>

            </div>
        </section>
        <script type="text/javascript">
                                
          

        </script>
       <?php  include ROOT. '/views/layout/footer.php'; // підключення моделі  ?>
    </body>
</html>