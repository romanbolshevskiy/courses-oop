<?php include ROOT . '/views/layout/header.php'; ?>


<section>
    <div class="container">
        <div class="row">
       
            <div class="col-sm-10 col-sm-offset-1 padding-right">
                <div class="features_items">
                    
                    <div class="recommended_items"><!--recommended_items-->
                    <h2 class="title text-center">My bought courses</h2>
                    <div class="slider"   >
                        <?php if ($user_cart){ ?>
                            <?php if($type == "bought"){   echo "<p>You have already bought such courses:</p>";}
                            else if($type == "processing"){ echo "<p>These your orders are in pocessing:</p>"; }?>
                           
                               
                            <?php foreach ($user_cart as $value){ 
                                $order = Order::OrderInfo($value['id_order']);     
                                foreach ($order as $product){
                                    
                                    $path = 'images/courses/course'.$product['id_c'].'.png';
                                    $file = "/".$path;
                                    if (file_exists($_SERVER['DOCUMENT_ROOT'].$file)) {
                                        $file1 = $file;
                                    }
                                    else {  
                                        $file1 = '/images/courses/none.png';
                                    }

                                    ?>
                                    
                                    <div class="item">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center">
                                                    <a href="/courses/<?php echo $product['url']; ?>"><img src="<?=$file1;?>"></a>
                                                    <h2>$<?php echo $product['price']; ?></h2>
                                                    <h4><a href="/courses/<?php echo $product['url']; ?>">
                                                        <?php echo $product['name']; ?></a>
                                                    </h4>
                                                </div>
                                                
                                               
                                            </div>
                                        </div>
                                    </div>

                                <?php } 
                            } ?>
                        <?php } else{   echo "<h3>There are'nt bought courses</h3>"; 
                            echo "<a class='btn btn-default checkout' href='/'>Вернуться к покупкам</a>";
                        }?>
                    </div>

                    <a class="left recommended-item-control" id="prev"> < </a>
                    <a class="right recommended-item-control" id="next"> > </a>

                </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include ROOT . '/views/layout/footer.php'; ?>