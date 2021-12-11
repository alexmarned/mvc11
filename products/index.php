<?php
include('server.php');
?>

<?php if (isset($_SESSION['message'])): ?>
    <div class="msg">
        <?php
        echo $_SESSION['message'];
        unset($_SESSION['message']);
        ?>
    </div>
<?php endif ?>

<?php $page = $_GET['page'] ?? 0;
//  $page_step = 2;
$results = mysqli_query($link, "SELECT * FROM products ORDER BY id DESC LIMIT $page, $page_step"); ?>

<table>
    <thead>
        <tr>
            <th>id</th>
            <th>Vendor_code</th>
            <th>Price</th>
            <th>Name</th>
            <th>Product_dimensions</th>
            <th>Показать</th>            
            <th colspan="2">Редактировать / удалить</th>
        </tr>
    </thead>

    <?php while ($row = mysqli_fetch_array($results)) { ?>

        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['vendor_code']; ?></td>
            <td><?php echo $row['price']; ?></td>
            <td><?php echo $row['name']; ?> </td> 
            <td><?php echo $row['product_dimensions']; ?></td>
            <td>  <a href="products/show.php?show=<?php echo $row['id']; ?>">
                    Показать карточку
                </a>           </td>
            <?php
            $cook_id = $_COOKIE['id'] ?? -1;
          //  $cook_author = $_COOKIE['author'] ?? -1;
            $cook_role = $_COOKIE['role'] ?? -1;
            if (( $row['user_id'] == $cook_id) or ($cook_role == '1' )) {
                ?>
                <td>
                    <a href="products/server.php?edit=<?php echo $row['id']; ?>" class="edit_btn" >Edit</a>
                </td>
            <?php } ?>
            <?php if ($cook_role == '1') { ?>  
                <td>
                    <a href="products/server.php?del=<?php echo $row['id']; ?>" class="del_btn">Delete</a>
                </td>

                <?php
            } 
            ?>
        </tr>
    <?php } ?>
</table>

<div style=" text-align: center;">
    <?php     
    @$page=clean($_GET['page']) ? clean($_GET['page']) : 0;    
    $prev = $page - $page_step;
    if($prev <=0) {
        $prev = 0;
    }
       
   $page_count = mysqli_query($link, "SELECT count(id) FROM products "); 
    $page_count = $page_count->fetch_row();
  $page_count = $page_count[0];
    
    
     $next = $page + $page_step;
    if($next >= $page_count)
    {
        $next = $page_count  - 2 ;
    }    
    ?>
    
    
     <a id="prev" href='<?php echo "$main_url/?page=$prev" ?>'> Предыдущая</a> 
 <script>
     var page = '<?php echo $page ?>';    
     if (page < 2){
       el_prev =  document.querySelector("a#prev");
           el_prev.setAttribute('style', 'display: none');
               }    
    </script>       

    
    <strong style="wiedth: 4rem;">  Навигация </strong>
<a id="next" href=<?php echo "$main_url?page=$next" ?>>Следующая </a>
    <script>
  
        var page_count = '<?php echo $page_count ?>';
  
     if (page >=  page_count - 2){
       el_next =  document.querySelector("a#next");
           el_next.setAttribute('style', 'display: none');  
               }    
    </script>
</div>

<?php
if (isset($cook_id)) {
    echo '<a href="products/prod_form.php" > <h4>Создать новый товар</h4></a>';
};
?>

