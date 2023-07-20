<?php
class Invoice{
    private $host='localhost';
    private $user='vwi_web';
    private $password="JQU@[aC@AwE*";
    private $database="vwi_hrm";
    private $invCom="com_invoice";
    private $invCan="can_invoice";
    private $com_invItem="com_invoice_item";
    private $can_invItem="can_invoice_item";
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
//Creating Invoice
    public function saveComInvoice($POST){
        date_default_timezone_set('Asia/Kolkata');
        $created_at=date('Y-m-d H:i:s');
        $entry_by=$_SESSION['userRel'];
        $userId=$_SESSION['userId'];

        $co="SELECT comInv FROM accounts WHERE id='".$_SESSION['userRel']."'";
        $cou=mysqli_query($this->dbConnect,$co);
        while($coun=mysqli_fetch_array($cou)){
            $count=($coun['comInv'])+1;
        }

        $Inv="INSERT INTO ".$this->invCom."(inv_id,com_id,inv_date,amt_pay,total_pay,total_pending,cgstAmt,sgstAmt,entry_by,user_id,created_at) 
        VALUES ('".$count."','".$POST['com_id']."','".$POST['inv_date']."','".$POST['amtPay']."','".$POST['totalPay']."','".$POST['totalPay']."','".$POST['cgstAmt']."','".$POST['sgstAmt']."','".$entry_by."','".$userId."','".$created_at."')";		
        mysqli_query($this->dbConnect,$Inv);
        $lastInsertId=mysqli_insert_id($this->dbConnect);
        for($i=0;$i<count($POST['item']);$i++){
            date_default_timezone_set('Asia/Kolkata');
            $created_at=date('Y-m-d H:i:s');
            $InvItem = "INSERT INTO ".$this->com_invItem." (inv_id,inv_item,item_desc,quantity,price,taxRate,taxAmt,total,created_at) 
            VALUES ('".$lastInsertId."','".$POST['item'][$i]."','".$POST['description'][$i]."','".$POST['quantity'][$i]."','".$POST['price'][$i]."','".$POST['taxRate'][$i]."','".$POST['taxTot'][$i]."','".$POST['total'][$i]."','".$created_at."')";			
            mysqli_query($this->dbConnect, $InvItem);
        }
        //updating comInv count in accounts table
        $sql="UPDATE accounts SET comInv='".$count."' WHERE id='".$_SESSION['userRel']."'";
        $res=mysqli_query($this->dbConnect,$sql);

    }
    public function saveCanInvoice($POST){
        date_default_timezone_set('Asia/Kolkata');
        $created_at=date('Y-m-d H:i:s');
        $entry_by=$_SESSION['userRel'];
        $userId=$_SESSION['userId'];

        $co="SELECT canInv FROM accounts WHERE id='".$_SESSION['userRel']."'";
        $cou=mysqli_query($this->dbConnect,$co);
        while($coun=mysqli_fetch_array($cou)){
            $count=($coun['canInv'])+1;
        }

        $Inv="INSERT INTO ".$this->invCan."(inv_id,can_id,inv_date,amt_pay,total_pay,total_pending,cgstAmt,sgstAmt,entry_by,user_id,created_at) 
        VALUES ('".$count."','".$POST['can_id']."','".$POST['inv_date']."','".$POST['amtPay']."','".$POST['totalPay']."','".$POST['totalPay']."','".$POST['cgstAmt']."','".$POST['sgstAmt']."','".$entry_by."','".$userId."','".$created_at."')";		
        mysqli_query($this->dbConnect,$Inv);
        $lastInsertId=mysqli_insert_id($this->dbConnect);
        for($i=0;$i<count($POST['item']);$i++){
            date_default_timezone_set('Asia/Kolkata');
            $created_at=date('Y-m-d H:i:s');
            $InvItem = "INSERT INTO ".$this->can_invItem." (inv_id,inv_item,item_desc,quantity,price,taxRate,taxAmt,total,created_at) 
            VALUES ('".$lastInsertId."','".$POST['item'][$i]."','".$POST['description'][$i]."','".$POST['quantity'][$i]."','".$POST['price'][$i]."','".$POST['taxRate'][$i]."','".$POST['taxTot'][$i]."','".$POST['total'][$i]."','".$created_at."')";			
            mysqli_query($this->dbConnect, $InvItem);
        }
        //updating comInv count in accounts table
        $sql="UPDATE accounts SET canInv='".$count."' WHERE id='".$_SESSION['userRel']."'";
        $res=mysqli_query($this->dbConnect,$sql);
    }

//Deleting Invoice
}
?>