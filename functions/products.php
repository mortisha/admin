<?php

function products_get_all_count() {

    $sql ='
        SELECT products.id, products.title, products.price, COUNT(images.id) as cnt
        FROM products
        LEFT JOIN images ON products.id = images.product_id
        GROUP BY products.id
    ';
    $results = db_select($sql);

    return $results;
}

function products_images_get_all($product_id) {
    $sql = '
        SELECT id, image_name, product_id
        FROM images
        WHERE product_id = '.$product_id;

    $result = db_select($sql);

    return $result;
}

function products_get($id) {

    global $db_connection;

    $sql = '
        SELECT id, title, content, price
        FROM products
        WHERE id = '.$id;

    $res = mysqli_query($db_connection, $sql);
    return mysqli_fetch_assoc($res);

}

function products_get_image($id, $product_id) {

    global $db_connection;

    $sql = '
        SELECT id, image_name, product_id
        FROM images
        WHERE id='.$id.' AND product_id='.$product_id;
        
    $res = mysqli_query($db_connection, $sql);
    return mysqli_fetch_assoc($res);

}

function products_get_images ($id) {

    global $db_connection;


    $sql = '
        SELECT id, image_name
        FROM images
        INNER JOIN products ON products.id=images.product_id
        WHERE products.id= '.$id;

    

    $result = mysqli_query($db_connection, $sql);
    return $result;
    } 

