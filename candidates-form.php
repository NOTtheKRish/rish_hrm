<?php
include('includes/header.php');
include_once("includes/dbconfig.php");
?>
<div class="container-fluid bg-primary">
    <div class="col-md-8 mx-auto">
        <div class="card mt-4">
            <h5 class="card-header"><strong>V Way - Candidate Registration Form</strong></h5>
            <div class="card-body">
                <form action="candidates-success.php" method="POST" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group col-md-3">Name
                            <div class="form-input">
                                <input class="form-control" type="text" name="name">
                            </div>
                        </div>
                        <div class="form-group col-md-3">Gender
                            <div class="form-input">
                                <select name="gender" class="form-control">
                                    <?php
                                        $sql="SELECT * FROM can_gender";
                                        $result=mysqli_query($conn,$sql);
                                        if(mysqli_num_rows($result)>0){
                                        while($row=mysqli_fetch_array($result)){
                                    ?>
                                    <?php echo'<option value="'.$row['value'].'">'.$row['value'].'</option>';?>
                                    <?php }}?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-3">Phone Number
                            <div class="form-input">
                                <input class="form-control" type="text" name="number">
                            </div>
                        </div>
                        <div class="form-group col-md-3">WhatsApp Number
                            <div class="form-input">
                                <input class="form-control" type="text" name="wp_number">
                            </div>
                        </div>
                    </div><br>
                    <div class="form-row">
                        <div class="form-group col-md-4">E-Mail
                            <div class="form-input">
                                <input class="form-control" type="email" name="email">
                            </div>
                        </div>
                        <div class="form-group col-md-3">Qualification
                            <div class="form-input">
                            <select name="qualification" class="form-control">
                                <?php
                                    $sql="SELECT * FROM can_qualification";
                                    $result=mysqli_query($conn,$sql);
                                    if(mysqli_num_rows($result)>0){
                                    while($row=mysqli_fetch_array($result)){
                                ?>
                                <?php echo'<option value="'.$row['value'].'">'.$row['value'].'</option>';?>
                                <?php }}?>
                            </select>
                            </div>
                        </div>
                        <div class="form-group col-md-3">Experience
                            <div class="form-input">
                            <select name="experience" class="form-control">
                                <?php
                                    $sql="SELECT * FROM can_exp";
                                    $result=mysqli_query($conn,$sql);
                                    if(mysqli_num_rows($result)>0){
                                    while($row=mysqli_fetch_array($result)){
                                ?>
                                <?php echo'<option value="'.$row['value'].'">'.$row['value'].'</option>';?>
                                <?php }}?>
                            </select>
                            </div>
                        </div>
                    </div><br>
                    <div class="form-row">
                        <div class="form-group col-md-4">Job Role
                            <div class="form-input">
                                <select name="jobrole" class="form-control">
                                    <?php
                                        $sql="SELECT * FROM can_jobrole";
                                        $result=mysqli_query($conn,$sql);
                                        if(mysqli_num_rows($result)>0){
                                        while($row=mysqli_fetch_array($result)){
                                    ?>
                                    <?php echo'<option value="'.$row['value'].'">'.$row['value'].'</option>';?>
                                    <?php }}?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-4">Expected Job
                            <div class="form-input">
                            <select name="expected_job" class="form-control">
                                <?php
                                    $sql="SELECT * FROM can_jobexpect";
                                    $result=mysqli_query($conn,$sql);
                                    if(mysqli_num_rows($result)>0){
                                    while($row=mysqli_fetch_array($result)){
                                ?>
                                <?php echo'<option value="'.$row['value'].'">'.$row['value'].'</option>';?>
                                <?php }}?>
                            </select>
                            </div>
                        </div>
                    </div><br>
                    <div class="form-row">
                        <div class="form-group col-md-6">Address
                            <div class="form-input">
                                <textarea class="form-control" name="address" cols="30" rows="4"></textarea>
                            </div>
                        </div>
                        <div class="form-group col-md-4">Interested Location
                            <div class="form-input">
                                <input class="form-control" type="text" name="location_interest">
                            </div>
                        </div>
                        <div class="form-group col-md-3">Current Salary
                            <div class="form-input">
                                <input class="form-control" type="text" name="salary_current">
                            </div>
                        </div>
                        <div class="form-group col-md-3">Expected Salary
                            <div class="form-input">
                                <input class="form-control" type="text" name="salary_expect">
                            </div>
                        </div>
                    </div><br>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="resume">Upload Resume</label>
                            <input type="file" name="resume">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <button class="btn btn-primary" name="create" type="submit">
                                <i class="fas fa-save mr-2"></i>Submit
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
    include('includes/scripts.php');
?>