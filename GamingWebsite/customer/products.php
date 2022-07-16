<?php

$conn = mysqli_connect('localhost','root','','compuware');

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="style.css">

    <title>Compuware</title>

    <?php include 'header.php'; ?>
<body>

<?php

if(isset($message)){
    foreach($message as $message){
        echo '<div class="message"><span>'.$message.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
    };
};

?>


<div class="all">
    <div class="container">

        <section class="products">

            <h1 class="heading">Keyboards</h1>

            <div class="box-container">

                <?php

                $select_products = mysqli_query($conn, "SELECT * FROM `products` WHERE type = 'keyboard'");
                if(mysqli_num_rows($select_products) > 0){
                    while($fetch_product = mysqli_fetch_assoc($select_products)){
                        ?>

                        <form action="" method="post">
                            <div class="box">
                                <img src="images/<?php echo $fetch_product['image']; ?>" alt="">
                                <h3><?php echo $fetch_product['name']; ?></h3>
                                <p><?php echo $fetch_product['type'];  ?></p>
                                <div class="price"><?php echo $fetch_product['price']; ?></div>
                                <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
                                <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
                                <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
                                <button class="button-64" role="button"><span class="text">Add to Cart</span></button>

                            </div>
                        </form>

                        <?php
                    };
                };
                ?>

            </div>

        </section>

        <section class="products">

            <h1 class="heading" name="#mice">Mice</h1>

            <div class="box-container">

                <?php

                $select_products = mysqli_query($conn, "SELECT * FROM `products` WHERE type = 'mouse'");
                if(mysqli_num_rows($select_products) > 0){
                    while($fetch_product = mysqli_fetch_assoc($select_products)){
                        ?>

                        <form action="" method="post">
                            <div class="box">
                                <img src="images/<?php echo $fetch_product['image']; ?>" alt="">
                                <h3><?php echo $fetch_product['name']; ?></h3>
                                <p><?php echo $fetch_product['type'];  ?></p>
                                <div class="price"><?php echo $fetch_product['price']; ?></div>
                                <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
                                <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
                                <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
                                <button class="button-64" role="button"><span class="text">Add to Cart</span></button>

                            </div>
                        </form>

                        <?php
                    };
                };
                ?>

            </div>

        </section>

        <section class="products">

            <h1 class="heading">Headsets</h1>

            <div class="box-container">

                <?php

                $select_products = mysqli_query($conn, "SELECT * FROM `products` WHERE type = 'headset'");
                if(mysqli_num_rows($select_products) > 0){
                    while($fetch_product = mysqli_fetch_assoc($select_products)){
                        ?>

                        <form action="" method="post">
                            <div class="box">
                                <img src="images/<?php echo $fetch_product['image']; ?>" alt="">
                                <h3><?php echo $fetch_product['name']; ?></h3>
                                <p><?php echo $fetch_product['type'];  ?></p>
                                <div class="price"><?php echo $fetch_product['price']; ?></div>
                                <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
                                <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
                                <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
                                <button class="button-64" role="button"><span class="text">Add to Cart</span></button>

                            </div>
                        </form>

                        <?php
                    };
                };
                ?>

            </div>

        </section>

    </div>
</div>

<!-- custom js file link  -->
<script src="script.js"></script>

</body>