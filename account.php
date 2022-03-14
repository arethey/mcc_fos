 <!-- Masthead-->
 
 <?php 

if(!isset($_SESSION['login_user_id']))
 header("location: index.php?page=home");
 ?>

 <header class="masthead">
     <div class="container h-100">
         <div class="row h-100 d-flex align-items-center justify-content-center text-center">
             <div class="col-lg-10 align-self-end mb-4 page-title">
                 <h3 class="text-white">My Account</h3>
                 <hr class="divider my-4" />
             </div>
         </div>
     </div>
 </header>

<div class="container mt-5">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="orders-tab" data-toggle="tab" href="#orders" role="tab" aria-controls="orders" aria-selected="true">Orders</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Account Settings</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="orders" role="tabpanel" aria-labelledby="orders-tab">
            <?php
                if(isset($_SESSION['login_user_id'])){
                    $data = "where c.user_id = '".$_SESSION['login_user_id']."' ";
                }else{
                    $ip = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
                    $data = "where c.client_ip = '".$ip."' ";
                }
                $get = $conn->query("SELECT *, count(ol.product_id) as totalItems from orders o INNER JOIN order_list ol ON o.id = ol.order_id WHERE ol.user_id =". $_SESSION['login_user_id']." GROUP BY ol.order_id");

                // $get = $conn->query("SELECT *,
                //     c.id as cid, p.id as pid 
                //     FROM order_list c 
                //     inner join product_list p 
                //     on p.id = c.product_id 
                //     inner join orders o 
                //     on c.order_id = o.id ".$data); 
                           
            ?>
            <div class="card-body">
                <table class="table table-bordered;">    
                         <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Order #</th>
                                <th>Items</th>
                                <th>Status</th>
                                <th>&nbsp;</th>
                                <!-- <th>Product Name</th>
                                <th>Unit Price</th>
                                <th>Quantity</th>
                                <th>Total Amount</th>
                                <th>Status</th>
                                <th>Action</th> -->
                            </tr>
                        </thead>
                            <tbody>
                <?php 
                //$total = 0;
                $i = 1;
                while($row= $get->fetch_assoc()):
                   // $total += ($row['qty'] * $row['price']);
                ?>
                         <tr>
                                <td><?php echo $i++?></td>
                                <td><?php echo date_format(date_create($row['order_date']),"F j, Y, g:i a")?></td> 
                                <td><?php echo $row['order_id']?></td>  
                                <td><?php echo $row['totalItems']?></td>
                                <?php 
                                if($row['status'] == 1){
                                    echo '<td><span class="badge badge-success">Confirmed</span></td>';
                                }else if($row['status'] == 2){
                                    echo '<td><span class="badge badge-danger">Cancelled</span></td>';
                                }else{
                                    echo '<td><span class="badge badge-secondary">For Verification</span></td>';
                                }
                                ?>
                                <td>
                                    <button type="button" class="btn btn-warning">
                                        Cancel
                                    </button>
                                    <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#itemsModal">
                                        View
                                    </button> -->
                                </td>

                                <!-- <td><?php echo $row['price']?></td>
                                <td><?php echo $row['qty']?></td>
                                <td><?php echo number_format($row['qty'] * $row['price'],2) ?></td> -->
                                 
                                <!--<td> <button class="btn btn-sm btn-danger"
                                     onclick="removeItem1(<?php echo $row['pid'].','.$row['cid'].','.$row['qty'] ?>)">Remove</button></td>-->
                              </tr>
                              <?php endwhile; ?>
                             </tbody>
                          </table>
                  </div>
            </div>

        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <div class="card-body">
                <table class="table table-bordered;">    
                    <tbody>
                        <tr>
                        <td width="250">Name:</td>
                        <td><?php echo $_SESSION['login_first_name'] ." ". $_SESSION['login_last_name']?></td>
                        </tr>
                        <tr>
                        <td>Delivery Adress:</td>
                        <td><?php echo $_SESSION['login_address']?></td>
                        </tr>
                        <tr>
                        <td>Contact Number:</td>
                        <td><?php echo $_SESSION['login_email']?></td></tr>
                        <tr>
                        <td>Contact Number:</td>
                        <td><?php echo $_SESSION['login_mobile']?></td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="itemsModal" tabindex="-1" role="dialog" aria-labelledby="itemsModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="itemsModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
    </div>
  </div>
</div>
