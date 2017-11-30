<?php include ROOT . '/views/layout/header.php'; ?>

<section>
    <div class="container">
        <div class="row">
        
            <div class="col-sm-11 padding-right">
                <div class="features_items">

                    <h2 class="title text-center">Checkout</h2>

                    <?php if ($result){ ?>

                        <p>Order is accepted. We will call you.</p>

                    <?php } else{ ?>
                        
                        <p>Picked courses: <?php echo $count; ?>, on total price: <b><?php echo $sum; ?></b> eur.</p><br/>

                        <div class="col-sm-4">
                            <?php if (isset($errors) && is_array($errors)) { ?>
                                <ul>
                                    <?php foreach ($errors as $error): ?>
                                        <li> - <?php echo $error; ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php } ?>

                            <p>You need to complete this for. Our manager will connect with you.</p>

                            <div class="login-form">
                                <form action="#" method="post">

                                    <p>Your name</p>
                                    <input type="text" readonly="readonly" name="userName" placeholder="" value="<?php echo $user['name']; ?>"/>
                                    
                                    <p>Email</p>
                                    <input type="email" readonly="readonly" name="userEmail" placeholder="" value="<?php echo $user['email']; ?>"/>

                                    <p>Phone number</p>
                                    <input type="text" name="userPhone" placeholder="Phone" value="1234567890" />

                                    <p>Comments of order</p>
                                    <textarea name="userComment" placeholder="Comments" ><?php echo $userComment; ?></textarea>

                                    <br/>
                                    <br/>
                                    <input type="submit" name="submit" class="btn btn-default" value="Submit" />
                                </form>
                            </div>
                        </div>

                    <?php } ?>

                </div>

            </div>
        </div>
    </div>
</section>

<?php include ROOT . '/views/layout/footer.php'; ?>