<?php include ROOT . '/views/layout/header.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <h1>Your account</h1>
            
            <h3>Hello, <?php echo $user['name'] . " ". $user['surname'];?>! 
               </h3>
           
           <table cellpadding="10px" cellspacing="10px" border="1">
                <thead>
                   <tr>
                        <th>
                            <img src="<?php echo $file1;?>" style="width: 150px; height: 135px;border-radius: 20%;">
                            <form enctype="multipart/form-data" method="post"> 
                                <input name="picture" type="file" />
                                <input type="submit" value="Load" />
                            </form>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>Id_user</th>
                        <th>Name</th>
                        <th>Surname</th>
                        <th>Type</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Admin</th>
                        <?php if( $user['user_type'] == 'teacher'){ ?>
                            <th>Degree</th>
                            <th>Working_place</th>
                            <th>Description</th>   
                        <?php } else { }?>
                    </tr>
                    
                    <tr>
                        <th><?php echo $user['id_u'];?></th>
                        <th><?php echo $user['name'];?></th>
                        <th><?php echo $user['surname'];?></th>
                        <th><?php echo $user['user_type'];?> <img  src="/images/<?=$user['user_type']?>.png"></th>
                        <th><?php echo $user['email'];?></th>
                        <th><?php echo $user['password'];?></th>
                        <th><?php echo $user['is_admin'];?></th>
                        <?php  if( $user['user_type'] == 'teacher'){ ?>
                            <th><?php echo $user['degree'];?></th>
                            <th><?php echo $user['working_place'];?></th>
                            <th><?php echo $user['description'];?></th>   
                        <?php } else{ }?>
                       

                    </tr>
                </tbody>
            </table>

            <ul>
                <li><a href="/cabinet/edit">Edit data</a></li>
                <!-- <li><a href="/cabinet/history">Список покупок</a></li> -->
                <li><a href="/cabinet/delete">Delete account!</a></li>
            </ul>
            
        </div>
    </div>
</section>

<?php include ROOT . '/views/layout/footer.php'; ?>