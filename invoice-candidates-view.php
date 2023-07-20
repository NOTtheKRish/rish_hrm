<?php
    include('session.php');
    include_once('includes/dbconfig.php');
    $sql="SELECT * FROM settings WHERE entry_by='".$_SESSION['userRel']."'";
    $result=mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)>0){
    while($rows=mysqli_fetch_array($result)){
        $name=$rows['name'];
        $bank_name=$rows['bank_name'];
        $account_no=$rows['account_no'];
        $ifsc_code=$rows['ifsc_code'];
        $branch_name=$rows['branch_name'];
        $upi_id=$rows['upi_id'];
        $description=$rows['inv_desc'];
        $logo=$rows['logo'];
        $sign=$rows['inv_sign'];
?>
<?php
    if(isset($_GET['id'])){
        $inv_id=$_GET['id'];
    }
    if(isset($_GET['print'])==true){
        echo'<script type="text/javascript">
            window.print();
        </script>';
    }
?>
<?php
include('includes/header.php');
?>
<div class="container-fluid mt-2 p-5">
    <div class="justify-content-center">
            <div class="text-dark">
                <div class="form-row col-md-12">
                    <div class="form-group col-md-8">
                        <div class="col-md-7">
                            <?php echo'<img style="width:20%;" src="img/'.$logo.'" alt="logo">';?>
                            <h5><strong><?php echo $rows['name'];?></strong></h5>
                            <span><?php echo $rows['address'];?></span><br>
                            <span><?php echo $rows['email'];?></span><br>
                            <span>GSTIN: <?php echo $rows['gst_no'];?></span><br>
                            <span><?php echo $rows['number'];?></span>
                            <?php }}?><br><br>
                            <h5><strong>Bill To</strong></h5>
                            <?php
                                $sql="SELECT * FROM can_invoice WHERE id='".$inv_id."'";
                                $result=mysqli_query($conn,$sql);
                                if(mysqli_num_rows($result)>0){
                                while($rows=mysqli_fetch_array($result)){
                                    $invId=$rows['inv_id'];
                                    $can_id=$rows['can_id'];
                                    $inv_dat=date_create($rows['inv_date']);
                                    // Changing Date Format to display as 19 Dec 2003
                                        $inv_date=date_format($inv_dat,"d M Y");
                                    // $inv_yr=date_create($rows['inv_date']);
                                    //     $inv_yr=date_format($inv_yr,"Y");
                                    $inv_year=$rows['inv_year'];
                                    $amt_pay=$rows['amt_pay'];
                                    $total_pay=$rows['total_pay'];
                                    
                                    $sql="SELECT * FROM candidates WHERE id='".$can_id."'";
                                    $result=mysqli_query($conn,$sql);
                                    if(mysqli_num_rows($result)>0){
                                    while($com=mysqli_fetch_array($result)){
                                        $can_name=$com['name'];
                                ?>
                            <h5><strong><?php echo $com['name'];?></strong></h5>
                            <span><?php echo $com['address'];?></span><br>
                            <span class="mr-2"><?php echo $com['email'];?></span>
                            <span><?php echo $com['number'];?></span>
                                <?php }}?>
                            <?php }}?>
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <div class="form-row">
                            <div class="col-md-4"></div>
                            <div class="col-md-8">
                                <div class="card text-white bg-primary mb-2" style="max-width: 18rem;">
                                    <div class="card-body">
                                        <h5 class="card-title lead"><strong>Invoice No.</strong></h5>
                                        <?php echo'<p class="card-text"><strong>'.$inv_year.'-CAN-'.$invId.'</strong></p>';?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-4"></div>
                            <div class="col-md-8">
                                <div class="card text-light bg-primary mb-2" style="max-width: 18rem;">
                                    <div class="card-body">
                                        <h5 class="card-title lead"><strong>Amount Due</strong></h5>
                                        <?php echo'<p class="h5 card-text"><strong>&#x20B9;'.number_format($total_pay,2).'</strong></p>';?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-4"></div>
                            <div class="col-md-8">
                                <div class="card text-light bg-primary mb-3" style="max-width: 18rem;">
                                    <div class="card-body">
                                        <h5 class="card-title lead"><strong>Invoice Date</strong></h5>
                                        <?php echo'<p class="h5 card-text"><strong>'.$inv_date.'</strong></p>';?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row col-md-12">
                    <table class="table text-dark table-bordered">
                        <thead class="thead-dark">
                        <th>Item</th>
                        <th>Description</th>
                        <th>Qty</th>
                        <th>Price(&#x20B9;)</th>
                        <th>Taxable Value(&#x20B9;)</th>
                        <th>Tax(%)</th>
                        <th>CGST(&#x20B9;)</th>
                        <th>SGST(&#x20B9;)</th>
                        <th>Amount(&#x20B9;)</th>
                        </thead>
                        <tbody>
                            <?php
                                $sql="SELECT * FROM can_invoice_item WHERE inv_id='".$inv_id."'";
                                $ite=mysqli_query($conn,$sql);
                                $amt1=0;//subtotal
                                $gst1=0;//taxtotal
                                $gstTax=0;// total Tax
                                while($item=mysqli_fetch_array($ite,MYSQLI_ASSOC)){
                                    $total=0;//total
                                    $tot1=0;
                                    $tax=0;
                                    $taxable=0;
                                    $q=0;
                                    $q=$item['quantity'];
                                    $taxP=$item['taxRate'];
                                    $tax=$item['taxAmt'];
                                    $taxA=$tax/2;
                                    // $taxR=(float)($taxP/2);
                                    $taxable=$q*$item['price'];
                                    $amt1+=$taxable;
                                    $gst1+=$taxA;
                                    $tot1+=(((float)$taxable)+(float)$tax);
                                    $total+=$tot1;
                                    $gstTax+=$tax;
                            ?>
                            <tr style="text-align:end;">
                                <td><?php echo $item['inv_item'];?></td>
                                <td style="text-align:left;"><?php echo $item['item_desc'];?></td>
                                <td><?php echo (int)$item['quantity'];?></td>
                                <td><?php echo $item['price'];?></td>
                                <td><?php echo number_format($taxable,2);?></td>
                                <td><?php echo $taxP;?></td>
                                <td><?php echo $taxA;?></td>
                                <td><?php echo $taxA;?></td>
                                <td><?php echo number_format($tot1,2);?></td>
                            </tr>
                            
                            <?php
                                }
                            ?>
                            <tr class="font-weight-bold" style="text-align:end;">
                                <?php echo'<td colspan="4">Total</td>';?>
                                <td><?php echo number_format($amt1,2);?></td>
                                <td></td>
                                <td><?php echo number_format($gst1,2);?></td>
                                <td><?php echo number_format($gst1,2);?></td>
                                <td><?php echo number_format($total_pay,2);?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="form-row col-md-12">
                    <div class="form-group col-md-6">
                        <h5 class="text-dark lead"><strong>Bank Name:&emsp;<?php echo $bank_name;?></strong></h5>
                        <h5 class="text-dark lead"><strong>Account Number:&emsp;<?php echo $account_no;?></strong></h5>
                        <h5 class="text-dark lead"><strong>IFSC Code:&emsp;<?php echo $ifsc_code;?></strong></h5>
                        <h5 class="text-dark lead"><strong>Branch Name:&emsp;<?php echo $branch_name;?></strong></h5>
                        <h5 class="text-dark lead"><strong>UPI ID:&emsp;<?php echo $upi_id;?></strong></h5>
                    </div>
                    <div class="form-group col-md-6">
                        <?php echo'<h6 style="font-size:18px;text-align:end;"><strong>Subtotal :&emsp;&#x20B9;'.number_format($amt1,2).'</strong></h6>';?>
                        <?php echo'<h6 style="font-size:18px;text-align:end;"><strong>Total Tax Value :&emsp;&#x20B9;'.number_format($gstTax,2).'</strong></h6>';?>
                        <?php echo'<h6 style="font-size:18px;text-align:end;"><strong>Total Value (in Figures) :&emsp;&#x20B9;'.number_format($total_pay,2).'</strong></h6>';?>
                        <h5><strong></strong></h5>
                    </div>
                </div>
                <?php
                    //balance finder
                    $old_balance=0;
                    $new_balance=0;
                    $ri="SELECT total_pending FROM can_invoice WHERE can_id='".$can_id."' AND inv_id !='".$invId."' AND entry_by='".$_SESSION['userRel']."'";
                    $ris=mysqli_query($conn,$ri);
                    while($rish=mysqli_fetch_array($ris)){
                        $old_balance+=$rish['total_pending'];
                    }
                    $new_balance=$old_balance+$total_pay;
                ?>
                <div class="d-flex col-md-6 my-4" style="border:2px solid #E3E6F0;padding:10px;">
                    <div class="col-md-6"><strong>Old Balance :</strong><span class="ml-4">&#x20B9;<?php echo $old_balance;?></span></div>
                    <div class="col-md-6"><strong>New Balance :<span class="ml-4">&#x20B9;<?php echo $new_balance;?></span></strong></div>
                </div>
                <table class="table text-dark table-bordered">
                    <tr>
                        <td colspan="2"><p><?php echo $description;?></p></td>
                    </tr>
                    <tr class="text-center" style="font-weight:bold;width:1000px;">
                        <td>
                            <span>Received (For <?php echo $can_name;?>)</span><br><br><br><br><br>
                            <span>Authorized Signatory</span>
                        </td>
                        <td>
                            <span>For <?php echo $name;?></span>
                            <div class="my-3">
                                <img style="max-width: 300px;" src="img/<?php echo $sign; ?>">
                            </div>
                            <span>Authorized Signatory</span>
                        </td>
                    </tr>
                </table>
            </div>
    </div>
</div>


<?php
    include('includes/scripts.php');
?>
</div>
        <!-- End of Content Wrapper -->


</body>

</html>