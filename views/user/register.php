<?php include ROOT . '/views/layout/header.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <div class="col-sm-4 col-sm-offset-4 padding-right">

                <?php if ($result): ?>
                    
                <?php else: ?>
                    <?php if (isset($errors) && is_array($errors)): ?>
                        <ul>
                            <?php foreach ($errors as $error): ?>
                                <li> - <?php echo $error; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>

                    <div class="signup-form"><!--sign up form-->
                        <h2>Регистрация на сайте</h2>
                        <form action="" method="post">
                            <input type="text" name="name" placeholder="Name" value="<?php echo $name; ?>"/>
                            <input type="text" name="surname" placeholder="Surname" value="<?php echo $surname; ?>"/>
                            <input type="email" id="em" name="email" placeholder="E-mail" value="<?php echo $email; ?>"/>
                            <input type="password" name="password" placeholder="Пароль" value="<?php echo $password; ?>"/>
                            <select name="type" id="type">
                                <option>student</option>
                                <option>teacher</option>
                            </select>
                            <div id="teacher" style="display: none;">
                                <input type="text" name="description" placeholder="Description" value="<?php echo $description; ?>"/>
                                <input type="text" name="degree" placeholder="Degree" value="<?php echo $degree; ?>"/>
                                <input type="text" name="working_place" placeholder="Working place" value="<?php echo $working_place; ?>"/>
                            </div>

                            <input type="submit" name="submit" class="btn btn-default" value="Регистрация" />
                        </form>
                    </div><!--/sign up form-->
              
                <script type="text/javascript">
                   $( "#type" ).change(function() {
                      $('#teacher').toggle() ;
                    });
                </script>
                <?php   endif; ?>
                <br/>
                <br/>
            </div>
        </div>
    </div>
</section>

<?php include ROOT . '/views/layout/footer.php'; ?>