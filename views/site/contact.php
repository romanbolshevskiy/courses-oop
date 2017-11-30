<?php include ROOT . '/views/layout/header.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <div class="col-sm-4 col-sm-offset-4 padding-right">

                <?php if ($result): ?>
                    <p>Message has been sent! We will answer on your email.</p>
                <?php else: ?>
                    <?php if (isset($errors) && is_array($errors)): ?>
                        <ul>
                            <?php foreach ($errors as $error): ?>
                                <li> - <?php echo $error; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>

                    <div class="signup-form"><!--sign up form-->
                        <h2>Connect</h2>
                        <h5>Have a question? Write here</h5>
                        <br/>
                        <form action="#" method="post">
                            <p>Your name</p>
                            <input type="text" name="userName" placeholder="Name" value="<?php echo $name; ?>"/>
                            <p>Your email</p>
                            <input type="email" name="userEmail" placeholder="E-mail" value="<?php echo $email; ?>"/>
                            <p>Message</p>
                            <textarea name="userText" placeholder="Message"><?php echo $userText; ?></textarea> 
                            <br/>
                            <input type="submit" name="submit" class="btn btn-default" value="Send" />
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