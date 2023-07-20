<?php
    include('includes/dbconfig.php');
    $item_id=$_POST['id'];
    $sql=$conn->prepare("SELECT description,price,tax FROM items WHERE id = ?");
    $sql->bind_param('i',$item_id);
    $sql->execute();
    $sql->bind_result($description,$price,$tax);
    $sql->fetch();
    $sql->close();

    echo json_encode(array("description" => $description, "price" => $price,"tax" => $tax));
?>