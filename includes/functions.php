<?php
class Rishi{
    private $host='localhost';
    // private $user='root';
    // private $password="";
    // private $database="vwayjobs";
    private $user='vwayin5_rishi';
    private $password="h+RS0q;?ia]7}VAaaC";
    private $database="vwayin5_hrm";
    private $invCom="com_invoice";
    private $invCan="can_invoice";
    private $com_invItem="com_invoice_item";
    private $can_invItem="can_invoice_item";
    private $com_quot="com_quot";
    private $com_quotItem="com_quot_item";
    private $dbConnect=false;
    public function __construct(){
        if(!$this->dbConnect){ 
            $conn = new mysqli($this->host, $this->user, $this->password, $this->database);
            if($conn->connect_error){
                die("Error failed to connect to MySQL: " . $conn->connect_error);
            }else{
                $this->dbConnect = $conn;
            }
        }
    }


/**************************************************************/
/**********  Invoice Submission Functions *********************/
/*************************************************************/
    // create company invoice
    public function saveComInvoice($POST){
        date_default_timezone_set('Asia/Kolkata');
        $created_at=date('Y-m-d H:i:s');
        $entry_by=$_SESSION['userRel'];
        $userId=$_SESSION['userId'];

        // $co="SELECT comInv FROM accounts WHERE id='".$_SESSION['userRel']."'";
        // $cou=mysqli_query($this->dbConnect,$co);
        // while($coun=mysqli_fetch_array($cou)){
        //     $count=($coun['comInv'])+1;
        // }

        //updating comInv count and inv_year in accounts table
        $sql="UPDATE accounts SET comInv='".$POST['inv_no']."', inv_year='".$POST['inv_year']."' WHERE id='".$_SESSION['userRel']."'";
        $res=mysqli_query($this->dbConnect,$sql);
        $total_pay=0;

        // $Inv="INSERT INTO ".$this->invCom."(inv_id,com_id,inv_date,amt_pay,total_pay,total_pending,cgstAmt,sgstAmt,entry_by,user_id,created_at) 
        // VALUES ('".$count."','".$POST['com_id']."','".$POST['inv_date']."','".$POST['amtPay']."','".$POST['totalPay']."','".$POST['totalPay']."','".$POST['cgstAmt']."','".$POST['sgstAmt']."','".$entry_by."','".$userId."','".$created_at."')";		
        $Inv="INSERT INTO ".$this->invCom."(inv_year,inv_id,com_id,inv_date,entry_by,user_id,created_at) 
        VALUES ('".$POST['inv_year']."','".$POST['inv_no']."','".$POST['com_id']."','".$POST['inv_date']."','".$entry_by."','".$userId."','".$created_at."')";		
        mysqli_query($this->dbConnect,$Inv);
        $lastInsertId=mysqli_insert_id($this->dbConnect);
        for($i=0;$i<count($POST['item']);$i++){
            date_default_timezone_set('Asia/Kolkata');
            $created_at=date('Y-m-d H:i:s');
            // $total_pay+=($POST['taxTot'][$i]+$POST['total'][$i]);
            $total_pay+=$POST['total'][$i];
            $InvItem = "INSERT INTO ".$this->com_invItem." (inv_id,inv_item,item_desc,quantity,price,taxRate,taxAmt,total,created_at) 
            VALUES ('".$lastInsertId."','".$POST['item'][$i]."','".$POST['description'][$i]."','".$POST['quantity'][$i]."','".$POST['price'][$i]."','".$POST['taxRate'][$i]."','".$POST['taxTot'][$i]."','".$POST['total'][$i]."','".$created_at."')";			
            mysqli_query($this->dbConnect, $InvItem);
        }
        $InvItem="UPDATE ".$this->invCom." SET total_pay='".$total_pay."', total_pending='".$total_pay."' WHERE id='".$lastInsertId."'";
        mysqli_query($this->dbConnect,$InvItem);

    }
    // edit company invoice
    public function editComInvoice($POST){
        date_default_timezone_set('Asia/Kolkata');
        $created_at=date('Y-m-d H:i:s');
        $invId = $POST['inv_id'];

        // (1) delete old invoice items
        $del = "DELETE FROM ".$this->com_invItem." WHERE inv_id='".$invId."'";
        $dele = mysqli_query($this->dbConnect,$del);

        // (2) add new invoice items and calculate total amount
        $total_pay=0;
        for($i=0;$i<count($POST['item']);$i++){
            date_default_timezone_set('Asia/Kolkata');
            $created_at=date('Y-m-d H:i:s');
            $total_pay+=$POST['total'][$i];
            $InvItem = "INSERT INTO ".$this->com_invItem." (inv_id,inv_item,item_desc,quantity,price,taxRate,taxAmt,total,created_at) 
            VALUES ('".$invId."','".$POST['item'][$i]."','".$POST['description'][$i]."','".$POST['quantity'][$i]."','".$POST['price'][$i]."','".$POST['taxRate'][$i]."','".$POST['taxTot'][$i]."','".$POST['total'][$i]."','".$created_at."')";			
            mysqli_query($this->dbConnect, $InvItem);
        }

        // (3) update invoice details and total payment
        // $InvItem="UPDATE ".$this->invCom." SET inv_year='".$POST['inv_year']."', inv_id='".$POST['inv_id']."', com_id='".$POST['com_id']."', inv_date='".$POST['inv_date']."', total_pay='".$total_pay."', total_pending='".$total_pay."' WHERE id='".$invId."'";
        $InvItem="UPDATE ".$this->invCom." SET inv_year='".$POST['inv_year']."', inv_id='".$POST['inv_id']."', com_id='".$POST['com_id']."', inv_date='".$POST['inv_date']."', total_pay='".$total_pay."' WHERE id='".$invId."'";
        mysqli_query($this->dbConnect,$InvItem);
    }
    // create candidate invoice
    public function saveCanInvoice($POST){
        date_default_timezone_set('Asia/Kolkata');
        $created_at=date('Y-m-d H:i:s');
        $entry_by=$_SESSION['userRel'];
        $userId=$_SESSION['userId'];

        // $co="SELECT canInv FROM accounts WHERE id='".$_SESSION['userRel']."'";
        // $cou=mysqli_query($this->dbConnect,$co);
        // while($coun=mysqli_fetch_array($cou)){
        //     $count=($coun['canInv'])+1;
        // }

        //updating comInv count and inv_year in accounts table
        $sql="UPDATE accounts SET canInv='".$POST['inv_no']."', inv_year='".$POST['inv_year']."' WHERE id='".$_SESSION['userRel']."'";
        $res=mysqli_query($this->dbConnect,$sql);
        $total_pay=0;

        $Inv="INSERT INTO ".$this->invCan."(inv_year,inv_id,can_id,inv_date,entry_by,user_id,created_at) 
        VALUES ('".$POST['inv_year']."','".$POST['inv_no']."','".$POST['can_id']."','".$POST['inv_date']."','".$entry_by."','".$userId."','".$created_at."')";		
        mysqli_query($this->dbConnect,$Inv);
        $lastInsertId=mysqli_insert_id($this->dbConnect);
        for($i=0;$i<count($POST['item']);$i++){
            date_default_timezone_set('Asia/Kolkata');
            $created_at=date('Y-m-d H:i:s');
            // $total_pay+=($POST['taxTot'][$i]+$POST['total'][$i]);
            $total_pay+=$POST['total'][$i];
            $InvItem = "INSERT INTO ".$this->can_invItem." (inv_id,inv_item,item_desc,quantity,price,taxRate,taxAmt,total,created_at) 
            VALUES ('".$lastInsertId."','".$POST['item'][$i]."','".$POST['description'][$i]."','".$POST['quantity'][$i]."','".$POST['price'][$i]."','".$POST['taxRate'][$i]."','".$POST['taxTot'][$i]."','".$POST['total'][$i]."','".$created_at."')";			
            mysqli_query($this->dbConnect, $InvItem);
        }
        $InvItem="UPDATE ".$this->invCan." SET total_pay='".$total_pay."', total_pending='".$total_pay."' WHERE id='".$lastInsertId."'";
        mysqli_query($this->dbConnect,$InvItem);
    }
    // edit candidate invoice
    public function editCanInvoice($POST){
        date_default_timezone_set('Asia/Kolkata');
        $created_at=date('Y-m-d H:i:s');
        $invId = $POST['inv_id'];

        // (1) delete old invoice items
        $del = "DELETE FROM ".$this->can_invItem." WHERE inv_id='".$invId."'";
        $dele = mysqli_query($this->dbConnect,$del);

        // (2) add new invoice items and calculate total amount
        $total_pay=0;
        for($i=0;$i<count($POST['item']);$i++){
            date_default_timezone_set('Asia/Kolkata');
            $created_at=date('Y-m-d H:i:s');
            $total_pay+=$POST['total'][$i];
            $InvItem = "INSERT INTO ".$this->can_invItem." (inv_id,inv_item,item_desc,quantity,price,taxRate,taxAmt,total,created_at) 
            VALUES ('".$invId."','".$POST['item'][$i]."','".$POST['description'][$i]."','".$POST['quantity'][$i]."','".$POST['price'][$i]."','".$POST['taxRate'][$i]."','".$POST['taxTot'][$i]."','".$POST['total'][$i]."','".$created_at."')";			
            mysqli_query($this->dbConnect, $InvItem);
        }

        // (3) update invoice details and total payment
        // $InvItem="UPDATE ".$this->invCan." SET inv_year='".$POST['inv_year']."', inv_id='".$POST['inv_id']."', can_id='".$POST['can_id']."', inv_date='".$POST['inv_date']."', total_pay='".$total_pay."', total_pending='".$total_pay."' WHERE id='".$invId."'";
        $InvItem="UPDATE ".$this->invCan." SET inv_year='".$POST['inv_year']."', inv_id='".$POST['inv_id']."', can_id='".$POST['can_id']."', inv_date='".$POST['inv_date']."', total_pay='".$total_pay."' WHERE id='".$invId."'";
        mysqli_query($this->dbConnect,$InvItem);
    }

    //Creating Quotation
    public function saveQuotation($POST){
        date_default_timezone_set('Asia/Kolkata');
        $created_at=date('Y-m-d H:i:s');
        $entry_by=$_SESSION['userRel'];
        $userId=$_SESSION['userId'];

        $co="SELECT comQuot FROM accounts WHERE id='".$_SESSION['userRel']."'";
        $cou=mysqli_query($this->dbConnect,$co);
        while($coun=mysqli_fetch_array($cou)){
            $count=($coun['comQuot'])+1;
        }
        $amt_pay=0;
        $total_pay=0;

        $Quot="INSERT INTO ".$this->com_quot."(quot_id,com_id,quot_date,quot_end,entry_by,user_id,created_at) 
        VALUES ('".$count."','".$POST['com_id']."','".$POST['quot_date']."','".$POST['quot_end']."','".$entry_by."','".$userId."','".$created_at."')";		
        mysqli_query($this->dbConnect,$Quot);
        $lastInsertId=mysqli_insert_id($this->dbConnect);
        for($i=0;$i<count($POST['item']);$i++){
            date_default_timezone_set('Asia/Kolkata');
            $created_at=date('Y-m-d H:i:s');
            $amt_pay+=$POST['price'][$i];
            $total_pay+=$POST['total'][$i];
            $QuotItem = "INSERT INTO ".$this->com_quotItem." (quot_id,quot_item,quot_desc,quantity,price,taxRate,taxAmt,total,entry_by,created_at) 
            VALUES ('".$lastInsertId."','".$POST['item'][$i]."','".$POST['description'][$i]."','".$POST['quantity'][$i]."','".$POST['price'][$i]."','".$POST['taxRate'][$i]."','".$POST['taxTot'][$i]."','".$POST['total'][$i]."','".$entry_by."','".$created_at."')";			
            mysqli_query($this->dbConnect, $QuotItem);
        }
        // updating total amount in quotation table
        $quoItem="UPDATE ".$this->com_quot." SET total_pay='".$total_pay."', amt_pay='".$amt_pay."' WHERE id='".$lastInsertId."'";
        mysqli_query($this->dbConnect,$quoItem);

        //updating inv count in accounts table
        $sql="UPDATE accounts SET comQuot='".$count."' WHERE id='".$_SESSION['userRel']."'";
        mysqli_query($this->dbConnect,$sql);

    }
    // edit quotation
    public function editQuotation($POST){
        date_default_timezone_set('Asia/Kolkata');
        $created_at=date('Y-m-d H:i:s');
        $entry_by=$_SESSION['userRel'];
        $quotId = $POST['quot_id'];

        // (1) delete old quotation items
        $del = "DELETE FROM ".$this->com_quotItem." WHERE quot_id='".$quotId."'";
        $dele = mysqli_query($this->dbConnect,$del);

        // (2) add new quotation items and calculate total pay
        $amt_pay=0;
        $total_pay=0;
        for($i=0;$i<count($POST['item']);$i++){
            date_default_timezone_set('Asia/Kolkata');
            $created_at=date('Y-m-d H:i:s');
            $amt_pay+=$POST['price'][$i];
            $total_pay+=$POST['total'][$i];
            $QuotItem = "INSERT INTO ".$this->com_quotItem." (quot_id,quot_item,quot_desc,quantity,price,taxRate,taxAmt,total,entry_by,created_at) 
            VALUES ('".$quotId."','".$POST['item'][$i]."','".$POST['description'][$i]."','".$POST['quantity'][$i]."','".$POST['price'][$i]."','".$POST['taxRate'][$i]."','".$POST['taxTot'][$i]."','".$POST['total'][$i]."','".$entry_by."','".$created_at."')";			
            mysqli_query($this->dbConnect, $QuotItem);
        }

        // (3) update quotation details and total pay
        $quoItem="UPDATE ".$this->com_quot." SET com_id='".$POST['com_id']."', quot_date='".$POST['quot_date']."', quot_end='".$POST['quot_end']."', total_pay='".$total_pay."', amt_pay='".$amt_pay."' WHERE id='".$quotId."'";
        mysqli_query($this->dbConnect,$quoItem);
    }
    // Deleting Quotation
    public function deleteQuotation($POST){
        $del=$POST['delId'];

        $sql="DELETE FROM ".$this->com_quot." WHERE id='".$del."'";
        mysqli_query($this->dbConnect,$sql);

        // deleting quotation items
        $sql="DELETE FROM ".$this->com_quotItem." WHERE quot_id=".$del."";
        mysqli_query($this->dbConnect,$sql);
    }
}
?>