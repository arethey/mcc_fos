<?php
	include 'db_connect.php';

	$resultOrders = $conn->query("SELECT * FROM orders WHERE status = 0");
	$row_cnt_all_orders = $resultOrders->num_rows;

	$resultApprovedOrders = $conn->query("SELECT * FROM orders WHERE status = 1");
	$row_cnt_approved_orders = $resultApprovedOrders->num_rows;

	$resultCancelledOrders = $conn->query("SELECT * FROM orders WHERE status = 2");
	$row_cnt_cancelled_orders = $resultCancelledOrders->num_rows;
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="all-tab" data-toggle="tab" href="#all" role="tab" aria-controls="all"
                        aria-selected="true">All Orders
                        <span class="badge badge-secondary"><?php echo $row_cnt_all_orders ?></span>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="approved-tab" data-toggle="tab" href="#approved" role="tab"
                        aria-controls="approved" aria-selected="false">
                        Approved Orders
                        <span class="badge badge-secondary"><?php echo $row_cnt_approved_orders ?></span>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="cancelled-tab" data-toggle="tab" href="#cancelled" role="tab"
                        aria-controls="cancelled" aria-selected="false">Cancelled Orders
                        <span class="badge badge-secondary"><?php echo $row_cnt_cancelled_orders ?></span>
                    </a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
                    <table class="table table-bordered mt-3">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
			$i = 1;
			while($row=$resultOrders->fetch_assoc()):
			 ?>
                            <tr>
                                <td><?php echo $i++ ?></td>
                                <td><?php echo $row['name'] ?></td>
                                <td><?php echo $row['address'] ?></td>
                                <td><?php echo $row['email'] ?></td>
                                <td><?php echo $row['mobile'] ?></td>
                                <?php 
								if($row['status'] == 1){
									echo '<td class="text-center"><span class="badge badge-success">Confirmed</span></td>';
								}else if($row['status'] == 2){
									echo '<td class="text-center"><span class="badge badge-danger">Cancelled</span></td>';
								}else{
									echo '<td class="text-center"><span class="badge badge-secondary">For Verification</span></td>';
								}
								?>
                                <td>
                                    <button class="btn btn-sm btn-primary view_order" data-id="<?php echo $row['id'] ?>"
                                        data-status="<?php echo $row['status'] ?>">View
                                        Order</button>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>

                <div class="tab-pane fade" id="approved" role="tabpanel" aria-labelledby="approved-tab">
                    <table class="table table-bordered mt-3">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
			$i = 1;
			while($row=$resultApprovedOrders->fetch_assoc()):
			 ?>
                            <tr>
                                <td><?php echo $i++ ?></td>
                                <td><?php echo $row['name'] ?></td>
                                <td><?php echo $row['address'] ?></td>
                                <td><?php echo $row['email'] ?></td>
                                <td><?php echo $row['mobile'] ?></td>
                                <?php 
								if($row['status'] == 1){
									echo '<td class="text-center"><span class="badge badge-success">Confirmed</span></td>';
								}else if($row['status'] == 2){
									echo '<td class="text-center"><span class="badge badge-danger">Cancelled</span></td>';
								}else{
									echo '<td class="text-center"><span class="badge badge-secondary">For Verification</span></td>';
								}
								?>
                                <td>
                                    <button class="btn btn-sm btn-primary view_order" data-id="<?php echo $row['id'] ?>"
                                        data-status="<?php echo $row['status'] ?>">View
                                        Order</button>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>

                <div class="tab-pane fade" id="cancelled" role="tabpanel" aria-labelledby="cancelled-tab">
                    <table class="table table-bordered mt-3">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
			$i = 1;
			while($row=$resultCancelledOrders->fetch_assoc()):
			 ?>
                            <tr>
                                <td><?php echo $i++ ?></td>
                                <td><?php echo $row['name'] ?></td>
                                <td><?php echo $row['address'] ?></td>
                                <td><?php echo $row['email'] ?></td>
                                <td><?php echo $row['mobile'] ?></td>
                                <?php 
								if($row['status'] == 1){
									echo '<td class="text-center"><span class="badge badge-success">Confirmed</span></td>';
								}else if($row['status'] == 2){
									echo '<td class="text-center"><span class="badge badge-danger">Cancelled</span></td>';
								}else{
									echo '<td class="text-center"><span class="badge badge-secondary">For Verification</span></td>';
								}
								?>
                                <td>
                                    <button class="btn btn-sm btn-primary view_order" data-id="<?php echo $row['id'] ?>"
                                        data-status="<?php echo $row['status'] ?>">View
                                        Order</button>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
<script>
$('.view_order').click(function() {
    uni_modal('Order', 'view_order.php?id=' + $(this).attr('data-id') + '&status=' + $(this).attr(
        'data-status'))
})
</script>