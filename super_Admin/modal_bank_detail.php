<?php 
include "config.php";
?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title" id="myModalLabel">Bank Detail</h4>
</div>
<div class="modal-body">
   
    <form class="form-horizontal" method="POST" enctype="multipart/form-data">
                    <div class="card-body">
                    
                        <table id="example1" class="table table-bordered table-striped table-responsive">
                            <thead>
                                <tr>
                                    <th>Driver Name</th>
                                    <th>Contact No.</th>
                                    <th>Account Number</th>
                                    <th>Bank Holder Name</th>
                                    <th>Bank Name</th>
                                    <th>Ifsc Code</th>
                                </tr>
                            </thead>
                            <tbody>
                              
                            <?php
                                $count=1;
                                $sql44=mysqli_query($con,"SELECT * FROM tbl_driver_bank_detail where iDriverId='".$_GET['ID']."' ");
                                while($data=mysqli_fetch_assoc($sql44))
	                            {   
                                    $driver_credit=mysqli_query($con,"SELECT * FROM driver_register WHERE id='".$_GET['ID']."'");
                                    $driver_credit=mysqli_fetch_assoc($driver_credit);
                            ?>
                            <tr> 
                                
                                <td><?php echo $driver_credit['fullname'];?></td>
                                <td><?php echo $driver_credit['contact'];?></td>
                                <td><?php echo $data['vAccountNumber'];?></td>
                                <td><?php echo $data['vBankAccountHolderName']; ?></td>
                                
                                <td><?php echo $data['vBankName'];?></td>
                                <td><?php echo $data['vBIC_SWIFT_Code'];?></td>
                            </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                                
                    </div>
                </form>
</div>
<div class="modal-footer">

</div>