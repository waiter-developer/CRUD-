<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge"> <link rel="shortcut icon" href="favicon-32x32.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <title>Edit</title>
</head>
<body>
<div class="container box">
    <?php
$root =  $_SERVER['DOCUMENT_ROOT'];
include ("$root/DB_config.php");

    if(isset($_POST['submit'])) {

        $product_id   = $_POST['product_id'];
        $name         = $_POST['name'];
        $price        = $_POST['price'];
        $description  = $_POST['description'];
        $category_id  = $_POST['category_id'];

        mysqli_query($link, "UPDATE products SET name='$name', price='$price', description='$description', category_id='$category_id' WHERE id='$product_id'");
        header('Location: index.php');
    }
    $editedId = $_GET['edit'];
    $query = "SELECT id, `name`, price, description FROM products WHERE id=".$editedId;
    $result = mysqli_query($link, $query) or die(mysqli_error($link));
    $data = mysqli_fetch_assoc($result);

    $query_categories = "SELECT * FROM categories";
    $categories_result = mysqli_query($link, $query_categories);
    for ($categories = []; $row = mysqli_fetch_assoc($categories_result); $categories[] = $row);

    ?>
    <form action="" method="post">
        <input type="hidden" value="<?= $data['id'];?>" name="product_id">
        <div class="form-group">
            <label for="">Name</label>
            <input type="text" class="form-control" value="<?= $data['name'];?>" name="name" placeholder="Type name">
        </div>
        <div class="form-group">
            <label for="">Price</label>
            <input type="text" class="form-control" value="<?= $data['price'];?>" name="price" placeholder="Type name">
        </div>
        <div class="form-group">
            <label for="">Description</label>
            <input type="text" class="form-control" value="<?= $data['description'];?>" name="description">
        </div>
        <div class="form-group">
            <label for="">Group</label>
            <select class="form-control" name="category_id" >
                <?php foreach ($categories as $category) { ?>
                    <option value="<?= $category['id_category'];?>"><?= $category['name_category'];?></option>
                <?php } ?>
            </select>
        </div>
        <input type="submit" class="btn btn-outline-warning" name="submit">
    </form>
</div>
</body>
</html>