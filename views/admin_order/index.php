
<?php include ROOT . '/views/layout/header.php'; ?>

<section>
    <div class="container">
        <div class="row">

        <br/>
                    
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="/admin">Adminpanel</a></li>
                <li class="active">Orders in processing</li>
            </ol>
        </div>


        <h4>New orders</h4>

        <br/>
        <?php if(!$orders_all){ echo "<h4>There arent orders yet.!</h4>";}else {?>
        <div class="order_table parent">
            <div class="titles">
                <div class="blok small" >ID order</div>
                <div class="blok large">User name/id</div>
                <div class="blok large">Email </div>
                <div class="blok large">Phone</div> 
                <div class="blok large">Total price</div> 
                <div class="blok large">Comment</div>
                <div class="blok large">Status</div>
                <div class="blok large">Date</div>
                <div class="blok small"></div>
                <div class="blok small"></div>
                <div class="blok small last"></div>
            </div>
            <?php foreach ($orders_all as $order){ 
            $orders_details = Order::OrdersDetail($order['id_order']);
            ?>
            <div class="contents parent">
                <div class="blok small" > 
                    <a href="/admin/order/view/<?php echo $order['id_order']; ?>">
                        <?php echo $order['id_order']; ?>
                    </a>
                </div>
                <div class="blok large"><?php echo $order['user'] .":".$order['id_user']; ?></div>
                <div class="blok large"><?php echo $order['email']; ?> </div>
                <div class="blok large"><?php echo $order['phone']; ?></div> 
                <div class="blok large"><?php echo $order['total_price']; ?> є.</div> 
                <div class="blok large"><?php echo $order['comment']; ?> є.</div> 
                <div class="blok large"><span style="color: lightgreen;">In process</span></div>
                <div class="blok large"><?php echo $order['date_creation']; ?></div>
                <!-- <div class="blok small"><a href="/admin/order/view/<?php// echo $order['id_order']; ?>" title="Смотреть">View </a></div> -->
                <div class="blok small"><a href="/admin/order/delete/<?php echo $order['id_order']; ?>" title="Delete">Delete</a></div>
                <div class="blok small"><a href="/admin/order/bought/<?php echo $order['id_order']; ?>" title="To Bought order">To bought</a></div>
                <div class="blok small more last"><span id="more"><img src="/images/+.png"></span></div>
                    <!-- Вкладена таблиця -->
                    <div class="order_table child">
                        <div class="titles">
                            <div class="blok large">ID order_detail</div>
                            <div class="blok large">id course</div>
                            <div class="blok large">Title </div>
                            <div class="blok large">Price</div> 
                            <div class="blok small"></div>   
                        </div>
                    <?php foreach ($orders_details as $detail){ ?>
                        <div class="contents ">
                            <div class="blok large" > 
                                <?php echo $detail['id_od']; ?>
                            </div>
                            <div class="blok large"><?php echo $detail['id_c']; ?></div>
                            <div class="blok large">
                                <a href="/courses/<?php echo $detail['url']; ?>" target="_blank"> 
                                <?php echo $detail['name']; ?> 
                                </a>
                            </div>
                            <div class="blok large"><?php echo $detail['price']; ?></div>
                            <?php if( count($orders_details)>1){?>
                            <div class="blok small">
                                <a href="/order-detail/delete/<?php echo $detail['id_od'];?>"  id="delete_detail">Delete</a>
                            </div>
                            <?php } ?>
                        </div>
                        <?php } ?>
                    </div>
                    <!-- Вкладена таблиця -->
            </div>
            <?php } ?>
        </div>  
        <?php } ?>             
        <script type="text/javascript">
            $(".contents.parent").find(".more").click(function(){
                $(this).parent(".contents.parent").find(".order_table.child").slideToggle();
                var src = ($(this).find("img").attr("src") === "/images/+.png")
                ? "/images/-.png" 
                : "/images/+.png";
                $(this).find("img").attr("src", src);
            });
        </script>
        </div>
    </div>
</section>

<?php include ROOT . '/views/layout/footer.php'; ?>