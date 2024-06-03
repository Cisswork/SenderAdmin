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
        </div>
      </div>
<div class="modal-footer">

</div>