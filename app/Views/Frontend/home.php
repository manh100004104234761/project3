<?php
/**
 * Created by PhpStorm.
 * User: baoquanhan
 * Date: 10/25/20
 * Time: 3:39 PM
 */
include_once 'layouts/header.php'; ?>
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
    </head>
    <body>
    <br>
    <form action="" method="POST">
        <input type="hidden" name="action" value="productDetail">
        <input type="hidden" name="scope" value="frontend">
        <input type="submit" value="Add Product">
    </form>
    <button><a href="?scope=frontend&action=productDetail">Add Product</a></button>


    <form action="" method="POST">
        <input type="hidden" name="action" value="login">
        <input type="hidden" name="scope" value="frontend">
        <input type="submit" value="Dang nhap">
    </form>
    <button><a href="?scope=frontend&action=login">Dang nhap</a></button>

    <h1>category</h1>
    <?php var_dump($categories[0]); ?>
    <br>


    <h1>product</h1>
    <?php  var_dump($products[0]);?>


    </body>
    <script>

    </script>
    </html>

<?php include_once 'layouts/footer.php'; ?>