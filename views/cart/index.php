<?php include ROOT . '/views/layout/header.php'; ?>
<?php include_once ROOT. '/components/Cart.php'; // підключення моделі ?>

<section>
    <div class="container">
        <div class="row">
       

            <div class="col-sm-11 padding-right">
                <div class="features_items">
                    <h2 class="title text-center">Cart</h2>
                    <?php if ($user_cart){ ?>
                        
                        <p>You picked such courses:</p>
                        <table class="table-bordered table-striped table">
                            <tr>
                                <th>Id cart</th>
                                <th>Id course</th>
                                <th>Name</th>
                                <th>Price, eur</th>
                                <th>Delete</th>
                            </tr>
                        <?php foreach ($user_cart as $cart){   ?>
                                <tr>
                                    <td><?php echo $cart['id_cart'];?></td>
                                    <td><?php echo $cart['id_c'];?></td>
                                    <td>
                                        <a href="/courses/<?php echo $cart['url'];?>">
                                            <?php echo $cart['name'];?>
                                        </a>
                                    </td>
                                    <td><?php echo $cart['price'];?></td>
                                    <td>
                                        <a class="btn btn-default checkout" href="/cart/delete/<?php echo $cart['id_cart'];?>">
                                            X
                                        </a>
                                    </td>
                                </tr>
                            <?php  } ?>
                            <tr>
                                <td colspan="3">Total price, eur:</td>
                                <td> 
                                    <a class="btn btn-default checkout" href="/cart/delete/all"> 
                                        Delete all
                                    </a>
                                </td>
                                <td><b><?php echo $sum;?></b></td>
                            </tr>

                        </table>

                        <a class="btn btn-default checkout" href="/cart/checkout"><i class="fa fa-shopping-cart"></i> Proceed to simple ckeckout</a>
                        
                        <form method="post" action= "https://www.paypal.com/cgi-bin/webscr" style="display: inline;">
                            <input type="hidden" name="cmd" value="_xclick">
                            <input type="hidden" name="business" value="roman.bolshevskiy@gmail.com">
                            <?php foreach ($user_cart as $cart){   
                                $names .= "".$cart['name'] ." / ";
                                $idc .= "".$cart['id_c'] ." / ";
                            } ?>
                            <input type="hidden" name="item_name" value="<?php echo $names;?>">
                            <input type="hidden" name="item_number" value="<?php echo $idc;?>"> 
 
                            <input type="hidden" name="amount" value="<?=$sum;?>">
                            <input type="hidden" name="no_shipping" value="1">

                            <input name="rm" type="hidden" value="2" />
                            <input name="return" type="hidden" value="http://courses-oop/success/" />
                            <input name="cancel_return" type="hidden" value="http://courses-oop/fail/" />
                            <input name="currency_code" type="hidden" value="EUR" />
                            <input name="notify_url" type="hidden" value="http://site.ru/order/paypallistener/" />
                            <input type="submit" class="btn btn-default checkout" value="Buy Now With PayPall">
                        </form>
                    <?php } else{?>
                        <p>Корзина пуста</p>
                        <a class="btn btn-default checkout" href="/"><i class="fa fa-shopping-cart"></i> Go back to buy</a>
                    <?php } ?>

                </div>
            </div>
        </div>
    </div>
</section>

<?php include ROOT . '/views/layout/footer.php'; ?>