<?php

$conn = mysqli_connect('localhost','root','','compuware');

if(isset($_POST['add_product'])){
    $p_type = $_POST['p_type'];
    $p_name = $_POST['p_name'];
    $p_price = $_POST['p_price'];
    $p_image = $_FILES['p_image']['name'];
    $p_image_tmp_name = $_FILES['p_image']['tmp_name'];
    $p_image_folder = 'uploaded_img/'.$p_image;

    $insert_query = mysqli_query($conn, "INSERT INTO `products`(type, name,price, image) VALUES('$p_type','$p_name', '$p_price', '$p_image')") or die('query failed');

    if($insert_query){
        move_uploaded_file($p_image_tmp_name, $p_image_folder);
        $message[] = 'product add successfully';
    }else{
        $message[] = 'could not add the product';
    }
};

if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    $delete_query = mysqli_query($conn, "DELETE FROM `products` WHERE id = $delete_id ") or die('query failed');
    if($delete_query){
        header('location:admin.php');
        $message[] = 'product has been deleted';
    }else{
        header('location:admin.php');
        $message[] = 'product could not be deleted';
    };
};

if(isset($_POST['update_product'])){
    $update_p_id = $_POST['update_p_id'];
    $update_p_name = $_POST['update_p_name'];
    $update_p_price = $_POST['update_p_price'];
    $update_p_description = $_POST['update_p_description'];
    $update_p_image = $_FILES['update_p_image']['name'];
    $update_p_image_tmp_name = $_FILES['update_p_image']['tmp_name'];
    $update_p_image_folder = 'admin/uploaded_img/'.$update_p_image;

    $update_query = mysqli_query($conn, "UPDATE `products` SET name = '$update_p_name', price = '$update_p_price',description = '$update_p_description', image = '$update_p_image' WHERE id = '$update_p_id'");

    if($update_query){
        move_uploaded_file($update_p_image_tmp_name, $update_p_image_folder);
        $message[] = 'product updated succesfully';
        header('location:admin.php');
    }else{
        $message[] = 'product could not be updated';
        header('location:admin.php');
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin panel</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom css file link  -->

    <link rel="stylesheet" href="../admin/style.css">

</head>
<body>


<?php

if(isset($message)){
    foreach($message as $message){
        echo '<div class="message"><span>'.$message.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
    };
};

?>



<div class="container">

    <section>

        <form action="" method="post" class="add-product-form" enctype="multipart/form-data">
            <h3>add a new product</h3>

            <select type="" id="p_type" name="p_type" placeholder="Type of Product">
                <option value="headset">Headset</option>
                <option value="mouse">Mouse</option>
                <option value="keyboard">Keyboard</option>
            </select>
            <input type="text" name="p_name" placeholder="Products Name" class="box" required>
            <input type="text" name="p_price" min="0" placeholder="Price of product" class="box" required>
            <input type="file" name="p_image" accept="image/png, image/jpg, image/jpeg" class="box" required>
            <button class="button-64" name="add_product" role="button"><span class="text">Add Product</span></button>
        </form>

    </section>

    <section class="display-product-table">

        <table>

            <thead>
            <th>product image</th>
            <th>product name</th>
            <th>product price</th>
            <th>manage</th>
            </thead>

            <tbody>
            <?php

            $select_products = mysqli_query($conn, "SELECT * FROM `products`");
            if(mysqli_num_rows($select_products) > 0){
                while($row = mysqli_fetch_assoc($select_products)){
                    ?>

                    <tr>
                        <td><img src="uploaded_img/<?php echo $row['image']; ?>" height="100" alt=""></td>
                        <td><?php echo $row['name'];?><span>:</span><br><?php echo $row['type'];?></td>
                        <td><?php echo $row['price']; ?></td>
                        <td>
                            <a href="admin.php?delete=<?php echo $row['id']; ?>" class="button-64" onclick="return confirm('are your sure you want to delete this?');"> <span> <i class="fas fa-trash"></i> delete </span> </a>

                        </td>
                    </tr>

                    <?php
                };
            }else{
                echo "<div class='empty'>no product added</div>";
            };
            ?>
            </tbody>
        </table>

    </section>

    <section class="edit-form-container">

        <?php

        if(isset($_GET['edit'])){
            $edit_id = $_GET['edit'];
            $edit_query = mysqli_query($conn, "SELECT * FROM `products` WHERE id = $edit_id");
            if(mysqli_num_rows($edit_query) > 0){
                while($fetch_edit = mysqli_fetch_assoc($edit_query)){
                    ?>

                    <form action="" method="post" enctype="multipart/form-data">
                        <img src="admin/uploaded_img/<?php echo $fetch_edit['image']; ?>" height="200" alt="">
                        <input type="hidden" name="update_p_id" value="<?php echo $fetch_edit['id']; ?>">
                        <input type="text" class="box" required name="update_p_name" value="<?php echo $fetch_edit['name']; ?>">
                        <input type="number" min="0" class="box" required name="update_p_price" value="<?php echo $fetch_edit['price']; ?>">
                        <input type="text" class="box" required name="update_p_description" value="<?php echo $fetch_edit['description']; ?>">
                        <input type="file" class="box" required name="update_p_image" accept="image/png, image/jpg, image/jpeg">
                        <input type="submit" value="update the product" name="update_product" class="btn">
                        <input type="reset" value="cancel" id="close-edit" class="option-btn">
                    </form>

                    <?php
                };
            };
            echo "<script>document.querySelector('.edit-form-container').style.display = 'flex';</script>";
        };
        ?>

    </section>

</div>



</body>
</html>