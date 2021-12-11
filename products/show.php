<?php
include_once '../header.php';
include_once '../nav_reg.php';
?>

<a href="<?php echo $_SERVER['HTTP_REFERER'] ?>"> На главную страницу</a>

<?php
$id = $_GET['show'];
$results = mysqli_query($link, "SELECT * FROM products  where id=$id");
?>	
<table>
    <thead>
        <tr>
            <th>id</th>
            <th>Vendor_code</th>
            <th>Price</th>
            <th>Name</th>
            <th>Product_dimensions</th>           
            <th colspan="2">Action</th>
        </tr>
    </thead>

    <?php while ($row = mysqli_fetch_array($results)) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['vendor_code']; ?></td>
            <td><?php echo $row['price']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['product_dimensions']; ?></td>
            <?php
               $cook_id = $_COOKIE['id'] ?? -1;
               $cook_role = $_COOKIE['role'] ?? -1;
                                                       
            if (( $row['user_id'] == $cook_id) or ($cook_role  == '1' )) {
                ?>
            
                <td>
                    <a href="server.php?edit=<?php echo $row['id']; ?>" class="edit_btn" >Edit</a>
                </td>
            
            <?php   }  ?>
<?php  if  ($cook_role  == '1' ) :  ?>          
                <td>
                    <a href="server.php?del=<?php echo $row['id']; ?>" class="del_btn">Delete</a>
                </td>

                <?php   endif    ?>

        </tr>
   <?php   }  ?>
</table>
</body>
</html>