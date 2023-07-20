<div class="d-none d-sm-flex ml-sm-3 mr-auto my-2 my-sm-0">
    <?php
        if($_SESSION['id']!=3){
            if($package=="WFH (MONTHLY)" || $package=="WFH (YEARLY)"){
                echo "";
            }else{
                echo'<a href="call-list-create.php" class="btn btn-sm btn-primary mr-3">Add New CALL</a>
                <a href="candidates-create.php" class="btn btn-sm btn-primary mr-3">Add Candidate</a>
                <a href="vendors-create.php" class="btn btn-sm btn-primary mr-3">Add Vendor</a>';
            }
            if($package=="BASIC (MONTHLY)" || $package=="BASIC (YEARLY)" || $package=="SMART (MONTHLY)" || $package=="SMART (YEARLY)"){
                echo'';
            }else{
                echo'<a href="company-create.php" class="btn btn-sm btn-primary mr-3">Add Company</a>
                <a href="vacancy-create.php" class="btn btn-sm btn-primary mr-3">Add JOB Vacancy</a>';
            }
        }
        if($package=="WFH (MONTHLY)" || $package=="WFH (YEARLY)"){
            echo'<a href="call-list-create.php" class="btn btn-sm btn-primary mr-3">Add New CALL</a>
            <a href="vendors-create.php" class="btn btn-sm btn-primary mr-3">Add Vendor</a>';
        }elseif($_SESSION['id']==3){
            echo'<a href="call-list-create.php" class="btn btn-primary mr-3">Add New CALL</a>
            <a href="company-create.php" class="btn btn-sm btn-primary mr-3">Add Company</a>
            <a href="vendors-create.php" class="btn btn-sm btn-primary mr-3">Add Vendor</a>';
        }
    ?>
</div>