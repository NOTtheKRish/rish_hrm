<?php
/**************************************************************/
/************ Invoice Form Functions **************************/
/**************************************************************/
// Items Dropdown from Products
function getItems($conn,$user){
    echo '<option value="" disabled selected>Select Product</option>';
    $pro='SELECT id,value FROM items WHERE entry_by='.$user.'';
    $prod=mysqli_query($conn,$pro);
    while($produ=mysqli_fetch_array($prod)){
        echo '<option value="'.$produ['id'].'">'.$produ['value'].'</option>';
    }
}
function getTax($conn){
    echo '<option value="" disabled selected>Select Tax</option>';
    $pro='SELECT id,tax_percent FROM tax';
    $prod=mysqli_query($conn,$pro);
    while($produ=mysqli_fetch_array($prod)){
        echo '<option value="'.$produ['tax_percent'].'">'.$produ['tax_percent'].'</option>';
    }
}
function getInvoiceId($conn){
    $co="SELECT comInv FROM accounts WHERE id='".$_SESSION['userRel']."'";
    $cou=mysqli_query($conn,$co);
    while($coun=mysqli_fetch_array($cou)){
        $count=$coun['comInv'];
    }
    $count+=1;
    echo $count;
}
function getCanInvoiceId($conn){
    $co="SELECT canInv FROM accounts WHERE id='".$_SESSION['userRel']."'";
    $cou=mysqli_query($conn,$co);
    while($coun=mysqli_fetch_array($cou)){
        $count=$coun['canInv'];
    }
    $count+=1;
    echo $count;
}
function getInvoiceYear($conn){
    $co="SELECT inv_year FROM accounts WHERE id='".$_SESSION['userRel']."'";
    $cou=mysqli_query($conn,$co);
    while($c=mysqli_fetch_array($cou)){
        $inv_year=$c['inv_year'];
    }
    echo $inv_year;
}
?>