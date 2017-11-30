<?php include ROOT . '/views/layout/header.php'; ?>


<section>
    <div class="container">
        <div class="row">
       

            <div class="col-sm-11 padding-right">
                <div class="features_items">
                    <?php if($type == "bought"){    
                        echo "<h2 class='title text-center'>Bought orders:</h2>";
                    }else if($type == "processing"){
                        echo "<h2 class='title text-center'>Processing orders:</h2>";
                    }?>
                   
                    <?php if ($user_cart){ ?>
                        <?php if($type == "bought"){   echo "<p>You have already bought such courses:</p>";}
                        else if($type == "processing"){ echo "<p>These your orders are in pocessing:</p>"; }?>
                        <table class="table-bordered table-striped table">
                            <tr>
                                <th>Id course</th>
                                <th>Name</th>
                                <!-- <th>Buyer</th> -->
                                <th>Price, eur</th>
                                <th>Status</th>
                            </tr>
                        <?php foreach ($user_cart as $value){ 
                            $order = Order::OrderInfo($value['id_order']); 
                            foreach ($order as $product){
                                $sum += $product['price'];
                                ?>
                                <tr>
                                    <td><?php echo $product['id_c'];?></td>
                                    <td>
                                        <a href="/courses/<?=$product['url'];?>">
                                            <?php echo $product['name'];?>
                                        </span>
                                    </td>
                                    <!-- <td><?php// echo $value['user'] .":".$value['id_user'] ;?></td> -->
                                    <td><?php echo $product['price'];?></td>
                                    <td>
                                    <?php if($type == "bought"){   echo "<p style='color:red'>Bought</p>";}
                                      else if($type == "processing"){ echo "<p style='color:lightgreen'>In process</p>"; }?><b></b>
                                    </td>
                                </tr>
                            <?php } } ?>
                            <tr>
                                <td colspan="3">Total price, eur:</td>
                                <td><b><?php echo $sum;?></b></td> 
                            </tr>

                        </table>
                    <?php } else{?>
                        <p>Корзина пуста</p>

                        <a class="btn btn-default checkout" href="/"><i class="fa fa-shopping-cart"></i> Вернуться к покупкам</a>
                    <?php } ?>

                </div>
            </div>
        </div>
    </div>
</section>

<?php include ROOT . '/views/layout/footer.php'; ?>