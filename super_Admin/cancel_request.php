<?php 
include "config.php";
  echo $rt=$_GET['IDD'];
?>

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title" id="myModalLabel">Cancel Reason</h4>
</div>
<div class="modal-body">
                <?php 
                
                if($_GET['IDD'])
                {
                   
                
              $cancel_reason = $_POST['cancel_reason'];
                   $upd=mysqli_query($con,"update driver_withdraw_request set cancel_reason='$cancel_reason' where withdraw_id='".$_GET['IDD']."'");
                  
                    // $aa_id=$_GET['ID'];
                    // $status='Cancel';
                    // $sql1=mysqli_query($con,"SELECT * FROM driver_withdraw_request WHERE withdraw_id='$aa_id'");
                    // $row1=mysqli_fetch_assoc($sql1);
                    // $didl=$row1['driver_id'];
                    // $amontwithdrawel=$row1['withdraw_credit'];
                    // $se1=mysqli_query($con,"select * from driver_register where id='$didl'");
                    // $se2=mysqli_fetch_assoc($se1);
                    // $amt=$se2['wallet_amount'];
                    // $ttlamt=$amt+$amontwithdrawel;
                      
                    // $se3=mysqli_query($con,"update driver_register set wallet_amount='$ttlamt' where id='$didl'  ");
                    // $update=mysqli_query($con,"UPDATE `driver_withdraw_request` SET `status`='$status' WHERE withdraw_id='$aa_id'");
                    
        //              date_default_timezone_set('Asia/Kolkata');
        //   $dattime= date('Y-m-d H:i:s');
        //     $tr=mysqli_query($con,"INSERT INTO `getTransactionhistory`(`iUserId`, `iDriverId`, `eUserType`, `eType`, `iTripId`, `eFor`, `tDescription`, `ePaymentstatus`,`last_balance`, `currentbal`, 
        // `dDateorig`, `iBalance`, `ePaymentBy`,`ePaymentTo`, `eWithdrawStatus`, `ewithdrawpaid`,`remaining_amount`)
        // VALUES('','$didl','Driver','Credit','','Withdraw Amount Refund','Withdraw request cancel by superadmin and credit to your wallet','Paid','$amt','$ttlamt','$dattime','$amontwithdrawel','Admin','Driver','','','0') ");
                
                    // if($tr)
                    // {
                    //      echo'<script>window.location.href="driverwithdrawreport.php";</script>';  
                    // }
                }
                ?>
                            <form class="form-horizontal" method="POST" enctype="multipart/form-data">
                                <div class="card-body">
                                    <h4 class="card-title"></h4>
                                        <div class="form-group has-feedback">
                                          <label for="">Cancel Reason:</label>
                                          <input type="text" name="cancel_reason"  class="form-control"  placeholder="" Required>
                                        </div>
                                    <div class="border-top">
                                    <div class="card-body">
                                        <input type="submit" class="btn btn-primary" name="submit" value="Submit">
                                    </div>
                                </div>
                            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <!--<button type="button" class="btn btn-primary">Save changes</button>-->
        </div>
      </div>
<div class="modal-footer">

</div>