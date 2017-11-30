<?php include ROOT . '/views/layout/header.php'; ?>

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
                <?php }     if($admin){   ?>
                <div class="signup-form"><!--sign up form-->
                    <?php if( $type !="bad"){ ?>
                        <h2>Edit course <b><?php echo $course[0]['name']; ?></b></h2>
                        <form action="" method="post" enctype="multipart/form-data">
                            <p>Name:</p>
                            <input type="text" name="name" placeholder="Имя" value="<?php echo $course[0]['name']; ?>"/>
                            <p>Description:</p>
                            <textarea name="description"><?php echo $course[0]['description']; ?></textarea>
                            <p>Reccomend(1/0):</p>
                            <input type="number" name="reccomend" placeholder="Reccomend" value="<?php echo $course[0]['is_recommended']; ?>"/>
                            <p>Video:</p>
                            <input type="text" name="video" placeholder="Video's link" value="<?php echo $course[0]['video']; ?>"/>
                            <p>Price:</p>
                            <input type="number" name="price" placeholder="Price" value="<?php echo $course[0]['price']; ?>"/>
                            <select name="teacher" id="type">  
                                <option value ="<?php echo $course[0]['id_t'];?>"><?php echo $name_surname; ?></option>
                                <?php foreach ($teachers as $teacher) { 
                                    if( $course[0]['id_t'] != $teacher['id_u']){ ?>
                                    <option value ="<?php echo $teacher['id_u']; ?>"><?php echo $teacher['name'] . ' ' . $teacher['surname']; ?></option>
                                <?php } 
                                }  ?>
                            </select> <br/><br/>
                            <p><img style="width: 20%" src="/images/courses/course<?php echo $course[0]['id_c'];?>.png"</p>
                            <input name="picture" type="file" />
                            <input type="submit" name="submit" class="btn btn-default" value="Редактировать" />
                        </form>
                    <?php } else {
                        echo "<h1>There is no such course!!!</h1>";  
                    }?>
                </div><!--/sign up form-->
                <?php }  else {  echo " <img src='/images/error-404.png'>"; }  ?>
                <h3><a href="/courses/<?php echo $course[0]['url']; ?>">Go back to course</a></h3>
                <br/>
                <br/>
            </div>

        </div>
    </div>
</section>

<?php include ROOT . '/views/layout/footer.php'; ?>