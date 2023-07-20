<?php
    include('dbconfig.php');
    $number = $_POST['number'];
    $entry_by = $_POST['entry_by'];

    $sql = "SELECT * FROM calls WHERE number='".$number."' AND entry_by='".$entry_by."' LIMIT 1";
    $res = mysqli_query($conn,$sql);

    if(mysqli_num_rows($res)>0){
        $result = 1;
        while($call = mysqli_fetch_array($res)){
            $name = $call['name'];
            $job_role = $call['job_role'];
            $type = $call['type'];
        }
    }else{
        $result = 0;
    }

    echo json_encode(array(
        "result" => $result,
        "name" => $name,
        "job_role" => $job_role,
        "type" => $type,
    ));
?>