<?php
    function buyInterest($conn,$entry_by){
        echo '<option value="" selected disabled>Select Option</option>';
        $b='SELECT name FROM interest_buy WHERE entry_by='.$entry_by.'';
        $bu=mysqli_query($conn,$b);
        while($buy=mysqli_fetch_array($bu)){
            echo '<option value="'.$buy['name'].'">'.$buy['name'].'</option>';
        }
    }
    function sellInterest($conn,$entry_by){
        echo '<option value="" selected disabled>Select Option</option>';
        $s='SELECT name FROM interest_sell WHERE entry_by='.$entry_by.'';
        $se=mysqli_query($conn,$s);
        while($sell=mysqli_fetch_array($se)){
            echo '<option value="'.$sell['name'].'">'.$sell['name'].'</option>';
        }
    }
    function industryType($conn,$entry_by){
        echo '<option value="" selected disabled>Select Type</option>';
        $s='SELECT id,name FROM industry_type WHERE entry_by='.$entry_by.'';
        $se=mysqli_query($conn,$s);
        while($type=mysqli_fetch_array($se)){
            echo '<option value="'.$type['id'].'">'.$type['name'].'</option>';
        }
    }
?>