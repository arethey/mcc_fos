 <!-- Masthead-->
 
 <?php 

if(!isset($_SESSION['login_user_id']))
 header("location: index.php?page=home");
 ?>

 <header class="masthead">
     <div class="container h-100">
         <div class="row h-100 align-items-center justify-content-center text-center">
             <div class="col-lg-10 align-self-end mb-4 page-title">
                 <h3 class="text-white">Welcome!</h3>
                 <hr class="divider my-4" />
             </div>

         </div>
     </div>
 </header>



<div id="accordion" style="width:auto; margin: 30px 30px 30px 30px;">
  <div class="card">
    <div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Customer Information
        </button>
      </h5>
    </div>

    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
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
  <div class="card">
    <div class="card-header" id="headingTwo">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Orders Infomation
        </button>
      </h5>
    </div>



                 <?php
                if(isset($_SESSION['login_user_id'])){
                    $data = "where c.user_id = '".$_SESSION['login_user_id']."' ";
                }else{
                    $ip = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
                    $data = "where c.client_ip = '".$ip."' ";
                }
                $get = $conn->query("SELECT *,
                    c.id as cid, p.id as pid 
                    FROM order_list c 
                    inner join product_list p 
                    on p.id = c.product_id 
                    inner join orders o 
                    on c.order_id = o.id ".$data); 
                           
                ?>


    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
      <div class="card-body">
        <table class="table table-bordered;">    
                         <thead>
                            <tr>
                                <th>#</th>
                                <th>OrderId</th>
                                <th>Product Name</th>
                                <th>Unit Price</th>
                                <th>Quantity</th>
                                <th>Total Amount</th>
                                <th>Status</th>
                                <th>Action</th>
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
                                <td><?php echo $row['order_id']?></td>    
                                <td><?php echo $row['name']?></td> 
                                <td><?php echo $row['price']?></td>
                                <td><?php echo $row['qty']?></td>
                                <td><?php echo number_format($row['qty'] * $row['price'],2) ?></td>
                                 <?php 
                                if($row['status'] == 1){
                                    echo '<td class="text-center"><span class="badge badge-success">Confirmed</span></td>';
                                }else if($row['status'] == 2){
                                    echo '<td class="text-center"><span class="badge badge-danger">Cancelled</span></td>';
                                }else{
                                    echo '<td class="text-center"><span class="badge badge-secondary">For Verification</span></td>';
                                }
                                ?>
                                <!--<td> <button class="btn btn-sm btn-danger"
                                     onclick="removeItem1(<?php echo $row['pid'].','.$row['cid'].','.$row['qty'] ?>)">Remove</button></td>-->
                              </tr>
                              <?php endwhile; ?>
                             </tbody>
                          </table>
                  </div>
    </div>
  </div>
 </div>



                
  <!--              

 <style>

.card p {
    margin: unset
}

.card img {
    max-width: calc(100%);
    max-height: calc(59%);
}

div.sticky {
    position: -webkit-sticky;
    /* Safari */
    position: sticky;
    top: 4.7em;
    z-index: 10;
    background: white
}

.rem_cart {
    position: absolute;
    left: 0;
}
 </style>
 <script>
$('.view_prod').click(function() {
    uni_modal_right('Product', 'view_prod.php?id=' + $(this).attr('data-id'))
})
$('.qty-minus').click(function() {
    var qty = $(this).parent().siblings('input[name="qty"]').val();
    update_qty(parseInt(qty) - 1, $(this).attr('data-id'), $(this).attr('data-pid'), 'minus')
    if (qty == 1) {
        return false;
    } else {
        // $(this).parent().siblings('input[name="qty"]').val(parseInt(qty) - 1);
    }
})
$('.qty-plus').click(function() {
    var qty = $(this).parent().siblings('input[name="qty"]').val();

    const stocks = $(this).parent().siblings('input[name="qty"]').attr('max');
    if (stocks == 0) {
        return false
    }

    // $(this).parent().siblings('input[name="qty"]').val(parseInt(qty) + 1);
    update_qty(parseInt(qty) + 1, $(this).attr('data-id'), $(this).attr('data-pid'), 'plus')
})

function update_qty2(qty, id, pid, action) {
    start_load()
    $.ajax({
        url: 'admin/ajax.php?action=update_cart_qty2',
        method: "POST",
        data: {
            id: id,
            qty,
            pid,
            action
        },
        success: function(resp) {
            if (resp == 1) {
                // load_cart()
                // end_load()

                setTimeout(() => {
                    location.reload();
                }, 1000);
            }
        }
    })

}
$('#checkout').click(function() {
    if ('<?php echo isset($_SESSION['login_user_id']) ?>' == 1) {
        location.replace("index.php?page=checkout")
    } else {
        uni_modal("Checkout", "login.php?page=checkout")
    }
})

function removeItem1(productId, orderId, qty) {
    start_load()
    $.ajax({
        url: 'admin/ajax.php?action=remove_cart2',
        method: "POST",
        data: {
            productId,
            orderId,
            qty
        },
        success: function(resp) {
            if (resp == 1) {
                // load_cart()
                // end_load()

                setTimeout(() => {
                    location.reload();
                }, 1000);
            }
        }
    })
}
 </script> -->