<?php
    $exp="SELECT spend_for,total_paid FROM expenses WHERE spend_for='Ad'";
    $ad=0;
    $result=mysqli_query($conn,$exp);
    if(mysqli_num_rows($result)>0){
    while($rows=mysqli_fetch_array($result)){
        $spend_for=$rows['spend_for'];
        $ad+=$rows['total_paid'];
    }}
?>
<?php
    $exp="SELECT spend_for,total_paid FROM expenses WHERE spend_for='EB Bill'";
    $eb=0;
    $result=mysqli_query($conn,$exp);
    if(mysqli_num_rows($result)>0){
    while($rows=mysqli_fetch_array($result)){
        $spend_for=$rows['spend_for'];
        $eb+=$rows['total_paid'];
    }}
?>
<?php
    $exp="SELECT spend_for,total_paid FROM expenses WHERE spend_for='Extra'";
    $extra=0;
    $result=mysqli_query($conn,$exp);
    if(mysqli_num_rows($result)>0){
    while($rows=mysqli_fetch_array($result)){
        $spend_for=$rows['spend_for'];
        $extra+=$rows['total_paid'];
    }}
?>
<?php
    $exp="SELECT spend_for,total_paid FROM expenses WHERE spend_for='Food'";
    $food=0;
    $result=mysqli_query($conn,$exp);
    if(mysqli_num_rows($result)>0){
    while($rows=mysqli_fetch_array($result)){
        $spend_for=$rows['spend_for'];
        $food+=$rows['total_paid'];
    }}
?>
<?php
    $exp="SELECT spend_for,total_paid FROM expenses WHERE spend_for='Home'";
    $home=0;
    $result=mysqli_query($conn,$exp);
    if(mysqli_num_rows($result)>0){
    while($rows=mysqli_fetch_array($result)){
        $spend_for=$rows['spend_for'];
        $home+=$rows['total_paid'];
    }}
?>
<?php
    $exp="SELECT spend_for,total_paid FROM expenses WHERE spend_for='Hospital'";
    $hospital=0;
    $result=mysqli_query($conn,$exp);
    if(mysqli_num_rows($result)>0){
    while($rows=mysqli_fetch_array($result)){
        $spend_for=$rows['spend_for'];
        $hospital+=$rows['total_paid'];
    }}
?>
<?php
    $exp="SELECT spend_for,total_paid FROM expenses WHERE spend_for='Mobile Bills'";
    $mobile_bills=0;
    $result=mysqli_query($conn,$exp);
    if(mysqli_num_rows($result)>0){
    while($rows=mysqli_fetch_array($result)){
        $spend_for=$rows['spend_for'];
        $mobile_bills+=$rows['total_paid'];
    }}
?>
<?php
    $exp="SELECT spend_for,total_paid FROM expenses WHERE spend_for='Office'";
    $office=0;
    $result=mysqli_query($conn,$exp);
    if(mysqli_num_rows($result)>0){
    while($rows=mysqli_fetch_array($result)){
        $spend_for=$rows['spend_for'];
        $office+=$rows['total_paid'];
    }}
?>
<?php
    $exp="SELECT spend_for,total_paid FROM expenses WHERE spend_for='Petrol'";
    $petrol=0;
    $result=mysqli_query($conn,$exp);
    if(mysqli_num_rows($result)>0){
    while($rows=mysqli_fetch_array($result)){
        $spend_for=$rows['spend_for'];
        $petrol+=$rows['total_paid'];
    }}
?>
<?php
    $exp="SELECT spend_for,total_paid FROM expenses WHERE spend_for='Purchase'";
    $purchase=0;
    $result=mysqli_query($conn,$exp);
    if(mysqli_num_rows($result)>0){
    while($rows=mysqli_fetch_array($result)){
        $spend_for=$rows['spend_for'];
        $purchase+=$rows['total_paid'];
    }}
?>
<?php
    $exp="SELECT spend_for,total_paid FROM expenses WHERE spend_for='Salary'";
    $salary=0;
    $result=mysqli_query($conn,$exp);
    if(mysqli_num_rows($result)>0){
    while($rows=mysqli_fetch_array($result)){
        $spend_for=$rows['spend_for'];
        $salary+=$rows['total_paid'];
    }}
?>
<?php
    $exp="SELECT spend_for,total_paid FROM expenses WHERE spend_for='Service'";
    $service=0;
    $result=mysqli_query($conn,$exp);
    if(mysqli_num_rows($result)>0){
    while($rows=mysqli_fetch_array($result)){
        $spend_for=$rows['spend_for'];
        $service+=$rows['total_paid'];
    }}
?>
<?php
    $exp="SELECT spend_for,total_paid FROM expenses WHERE spend_for='Social Media'";
    $social=0;
    $result=mysqli_query($conn,$exp);
    if(mysqli_num_rows($result)>0){
    while($rows=mysqli_fetch_array($result)){
        $spend_for=$rows['spend_for'];
        $social+=$rows['total_paid'];
    }}
?>
<?php
    $exp="SELECT spend_for,total_paid FROM expenses WHERE spend_for='Travel'";
    $travel=0;
    $result=mysqli_query($conn,$exp);
    if(mysqli_num_rows($result)>0){
    while($rows=mysqli_fetch_array($result)){
        $spend_for=$rows['spend_for'];
        $travel+=$rows['total_paid'];
    }}
?>