<?php
    include('session.php');
    include_once('includes/dbconfig.php');
    $sql="SELECT * FROM settings WHERE entry_by='".$_SESSION['userRel']."'";
    $result=mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)>0){
    while($rows=mysqli_fetch_array($result)){
        $name=$rows['name'];
        $description=$rows['inv_desc'];
        $logo=$rows['logo'];
?>
<?php
    if(isset($_GET['id'])){
        $quot_id=$_GET['id'];
        $ri="SELECT quot_id,quot_date FROM com_quot WHERE id='".$quot_id."'";
        $rishi=mysqli_query($conn,$ri);
        while($rish=mysqli_fetch_array($rishi)){
            $quotationId=$rish['quot_id'];
            $date=date_create($rish['quot_date']);
            $QuotationYear=date_format($date,'Y');
        }
        echo '<title>Quotation-'.$QuotationYear.'-'.$quotationId.' - '.$name.'</title>';
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
<div class="container-fluid my-3 p-5">
    <div class="justify-content-center">
            <div class="text-dark">
                <div class="form-row col-md-12">
                    <div class="form-group col-md-7">
                        <div class="col-md-7">
                            <?php echo'<img style="width:20%;" src="img/'.$logo.'" alt="logo">';?>
                            <h5><strong><?php echo $rows['name'];?></strong></h5>
                            <span><?php echo $rows['address'];?></span><br>
                            <span><?php echo $rows['email'];?></span><br>
                            <span>GSTIN: <?php echo $rows['gst_no'];?></span><br>
                            <span><?php echo $rows['number'];?></span>
                            <?php }}?><br><br>
                            <h5><strong>Quote To</strong></h5>
                            <?php
                                $sql="SELECT * FROM com_quot WHERE id='".$quot_id."'";
                                $result=mysqli_query($conn,$sql);
                                if(mysqli_num_rows($result)>0){
                                while($rows=mysqli_fetch_array($result)){
                                    $quotationId=$rows['quot_id'];
                                    $com_id=$rows['com_id'];
                                    $quot_dat=date_create($rows['quot_date']);
                                    // Changing Date Format to display as 19 Dec 2003
                                        $quot_date=date_format($quot_dat,"d M Y");
                                    $quot_en=date_create($rows['quot_end']);
                                        $quot_end=date_format($quot_en,"d M Y");
                                    $quot_yr=date_create($rows['quot_date']);
                                        $quot_yr=date_format($quot_yr,"Y");
                                    $amt_pay=$rows['amt_pay'];
                                    $total_pay=$rows['total_pay'];
                                    
                                    $sql="SELECT * FROM company WHERE id='".$com_id."'";
                                    $result=mysqli_query($conn,$sql);
                                    if(mysqli_num_rows($result)>0){
                                    while($com=mysqli_fetch_array($result)){
                                        $com_name=$com['name'];
                                ?>
                            <h5><strong><?php echo $com['name'];?></strong></h5>
                            <span><?php echo $com['address'];?></span><br>
                            <span class="mr-2"><?php echo $com['email'];?></span>
                            <span><?php echo $com['number'];?></span>
                                <?php }}?>
                            <?php }}?>
                        </div>
                    </div>
                    <div class="form-group col-md-5">
                        <div class="form-row mb-3">
                            <div class="col-md-4"></div>
                            <div class="col-md-8">
                                <h2><strong>QUOTATION</strong></h2>
                                <h4>#<?php echo $quot_yr.'-'.$quotationId; ?></h4>
                            </div>
                        </div>
                        <div class="form-row mb-4">
                            <div class="col-md-3"></div>
                            <div class="col-md-8">
                                <div class="bg-primary text-white" style="border-radius:5px;">
                                    <?php echo'<h5 style="text-align:center;padding:10px;"><strong>Amount : &emsp;&emsp;&#x20B9;'.number_format($total_pay,2).'</strong></h5>';?>
                                </div>
                            </div>
                        </div>
                        <div class="form-row" style="margin-left:10px;">
                            <div class="col-md-4"></div>
                            <div class="col-md-6">
                                <h5 style="text-align:center;"><strong>Issued On : &emsp;&emsp;<?php echo $quot_date;?></strong></h5>
                                <h5 style="text-align:center;"><strong>Valid Upto : &emsp;&emsp;<?php echo $quot_end;?></strong></h5>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row col-md-12 mb-3">
                    <table class="table text-dark table-bordered">
                        <thead class="thead-dark">
                            <th>Item</th>
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
                                $sql="SELECT * FROM com_quot_item WHERE quot_id='".$quot_id."'";
                                $ite=mysqli_query($conn,$sql);
                                $amt1=0;//subtotal
                                $gst1=0;//taxtotal
                                $gstTax=0;//total Tax
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
                                    // $tot1+=(((float)$taxable)+(float)$tax);
                                    $tot1+=$item['total'];
                                    $total+=$tot1;
                                    $gstTax+=$tax;
                            ?>
                            <tr style="text-align:end;">
                                <td style="text-align:start;">
                                    <h6><strong><?php echo $item['quot_item'];?></strong></h6>
                                    <p><?php echo $item['quot_desc'];?></p>
                                </td>
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
                                <?php echo'<td colspan="3">Total</td>';?>
                                <td><?php echo number_format($amt1,2);?></td>
                                <td></td>
                                <td><?php echo number_format($gst1,2);?></td>
                                <td><?php echo number_format($gst1,2);?></td>
                                <td><?php echo number_format($total_pay,2);?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <hr>
                <div class="form-row col-md-12">
                    <div class="form-group col-md-6">
                    </div>
                    <div class="form-group col-md-6">
                        <?php echo'<h6 style="font-size:18px;text-align:end;"><strong>Subtotal :&emsp;&#x20B9;'.number_format($amt1,2).'</strong></h6>';?>
                        <?php echo'<h6 style="font-size:18px;text-align:end;"><strong>Total Tax Value :&emsp;&#x20B9;'.number_format($gstTax,2).'</strong></h6>';?>
                        <?php echo'<h6 style="font-size:18px;text-align:end;"><strong>Grand Total (in Figures) :&emsp;&#x20B9;'.number_format($total_pay,2).'</strong></h6>';?>
                        <h5><strong></strong></h5>
                    </div>
                </div>
                <table class="table text-dark table-bordered">
                    <tr>
                        <td colspan="2"><p><?php echo $description;?></p></td>
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