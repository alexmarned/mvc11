<?php
include_once '../header.php';
include_once '../nav_reg.php';
include_once('server.php');
?>

<?php if (isset($_SESSION['message'])): ?>
    <div class="msg">
        <?php
        echo $_SESSION['message'];
        unset($_SESSION['message']);
        ?>
    </div>
<?php endif ?>

<center><h4>Форма для товара</h4></center>
<form method="post" action="server.php" >

    <input type="hidden" name="id" value="<?php echo $id; ?>">

    <div class="input-group">
        <label>Name</label>
        <input type="text" name="name" value="<?php echo $name; ?>" required autofocus >
    </div>

    <div class="input-group">
        <label>vendor_code</label>
        <input type="text" name="vendor_code" value="<?php echo $vendor_code; ?>"  required>
    </div>

    <div class="input-group">
        <label>price </label>
        <p>  - введите не более 5 цифр</p>
        <input type="text" name="price" value="<?php echo $price; ?>"  pattern="[0-9]{,5}" required>
    </div>

    <div class="input-group">
        <label>product_dimensions</label>
        <input type="text" name="product_dimensions" value="<?php echo $product_dimensions; ?>" required>
    </div>

    <div class="input-group">
        <?php if ($update == true): ?>
            <button class="btn" type="submit" name="update" style="background: #556B2F;" >update</button>
        <?php else: ?>
            <button class="btn" type="submit" name="save" >Save</button>
        <?php endif ?>
    </div>
</form>