<?php include ROOT . '/views/layout/header.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <div class="col-sm-4 col-sm-offset-4 padding-right">
                
                <?php if ($result): ?>
                    <!--<p>Данные отредактированы!</p>-->
                <?php else: ?>
                    <?php if (isset($errors) && is_array($errors)): ?>
                        <ul>
                            <?php foreach ($errors as $error): ?>
                                <li> - <?php echo $error; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>

                    <div class="signup-form"><!--sign up form-->
                        <h2>Редактирование данных</h2>
                        <form action="" method="post">
                            <p>Имя:</p>
                            <input type="text" name="name" placeholder="Имя" value="<?php echo $user['name']; ?>"/>
                            <p>Фамилия:</p>
                            <input type="text" name="surname" placeholder="Фамилия" value="<?php echo $user['surname']; ?>"/>
                            <p>Email:</p>
                            <input type="email" name="email" placeholder="Email" value="<?php echo $user['email']; ?>"/>
                            <p>Пароль:</p>
                            <input type="password" name="password" placeholder="Пароль" value="<?php echo $user['password']; ?>"/>
                            <br/>
                            <?php  if( $user['user_type'] == 'teacher'){ ?>
                                <p>Degree:</p>
                                <input type="text" name="degree" placeholder="Имя" value="<?php echo $user['degree']; ?>"/>
                                <p>Working_place:</p>
                                <input type="text" name="working_place" placeholder="Имя" value="<?php echo $user['working_place']; ?>"/>
                                <p>Description:</p>
                                <input type="text" name="description" placeholder="Имя" value="<?php echo $user['description']; ?>"/> 
                            <?php } ?>

                            <input type="submit" name="submit" class="btn btn-default" value="Редактировать" />
                        </form>
                    </div><!--/sign up form-->
                
                <?php endif; ?>
                <br/>
                <br/>
            </div>
        </div>
    </div>
</section>

<?php include ROOT . '/views/layout/footer.php'; ?>