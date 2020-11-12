<?php
error_reporting(E_ALL);
ini_set('display_errors', 'on');
$root =  $_SERVER['DOCUMENT_ROOT'];
include ("$root/DB_config.php");
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="favicon-32x32.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <title>GU_835</title>
</head>
<body>
<div class="container box">
    <table class="table table-striped">
        <tr>
            <th>id</th>
            <th>name</th>
            <th>price</th>
            <th>description</th>
            <th>category</th>
            <th></th>
            <th></th>
        </tr>
        <?php
        $query  = "SELECT * FROM products  INNER JOIN categories ON products.category_id = categories.id_category";
        $result = mysqli_query($link, $query) or die(mysqli_error($link));
        for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);
        ?>
        <?php  foreach($data as $elem) {?>
            <tr>
                <td><?= $elem['id']?></td>
                <td><?= $elem['name']?></td>
                <td><?= $elem['price']?></td>
                <td><?= $elem['description']?></td>
                <td><?= $elem['name_category']?></td>
                <td><a class="btn btn-danger" onclick="return confirm('Are you really sure delete?')" href="index.php?delete=<?= $elem['id'] ?>">Delete</a></td>
                <td><a class="btn btn-success" href="edit.php?edit=  <?= $elem['id']?>">Edit</a></td>
            </tr>
        <?php }?>
    </table>
    <a href="add.php"  class="btn btn-primary btn_submit">Add</a>
</div>
</body>
</html>
<?php

if(isset($_GET['delete'])) {
    $deleteRow = $_GET['delete'];
    mysqli_query($link, "DELETE FROM products WHERE id=".$deleteRow);
    header('Location: index.php');
}
?>
