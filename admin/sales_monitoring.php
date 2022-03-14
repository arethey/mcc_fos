<!--<?php
	include 'db_connect.php';

    $categories = $conn->query("SELECT * FROM category_list ORDER BY id ASC");
	$row_cnt_categories = $categories->num_rows;
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <nav class="nav nav-pills flex-column">
                        <?php
			while($row=$categories->fetch_assoc()):
			 ?>
                        <a class="border-bottom nav-link <?php if(isset($_GET['catId']) && $_GET['catId'] == $row['id']) echo 'active'; ?>"
                            href="index.php?page=sales_monitoring&catId=<?php echo $row['id']; ?>"><?php echo $row['name'] ?></a>
                        <?php endwhile; ?>
                    </nav>
                </div>
                <div class="col-md-9">
                    <?php
                        if(empty($_GET['catId'])){
                            echo '<div class="alert alert-info text-center" role="alert">
                            Please select category.
                        </div>';
                        }else{
                            $catId = $_GET['catId'];
                            
                            $results = $conn->query("SELECT *, orders.name as cname FROM orders
                            LEFT JOIN order_list
                            ON order_list.order_id = orders.id
                            LEFT JOIN product_list
                            ON product_list.id = order_list.product_id WHERE orders.status = 1 AND product_list.category_id = $catId");
                            ?>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Customer Name</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Price</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                        while($row=$results->fetch_assoc()):
                        ?>
                            <tr>
                                <th scope="row"><?php echo $row['cname']; ?></th>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['qty']; ?></td>
                                <td><?php echo $row['price']; ?></td>
                                <td><?php echo $row['qty']*$row['price']."php"; ?></td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>-->

<?php
    include 'db_connect.php';

    $resultOrders = $conn->query("SELECT *, count(order_list.product_id) as product_id, sum(order_list.qty) as qty, order_list.order_id FROM order_list
        inner join product_list
        on product_list.id = order_list.product_id
    GROUP BY product_list.id ");
    
//    $row_cnt_all_orders = $resultOrders->num_rows;

?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="all-tab" data-toggle="tab" href="#all" role="tab" aria-controls="all"
                        aria-selected="true">Inventory and Sales</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="approved-tab" data-toggle="tab" href="#approved" role="tab"
                        aria-controls="approved" aria-selected="false">
                        Sales
                    </a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
                    <table class="table table-bordered mt-3">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Product Name:</th>
                                <th>Quantity left</th>
                                <th>Unit Price</th>
                                <th>Unit Sold</th>
                                <th>Total Sales</th>
                                
                            </tr>
                        </thead>
                        <tbody>

                <?php 
                    $i = 1;
                    while($row=$resultOrders->fetch_assoc()):  
                 ?>
                            <tr> 
                                <td><?php echo $i++?></td>
                                <td><?php echo $row['name']?></td>
                                <td><?php echo $row['stocks'] ?></td>
                                <td><?php echo $row['price'] ?></td>
                                <td><?php echo $row['qty'] ?></td>
                                <td><?php echo number_format($row['qty'] * $row['price'],2) ?></td>
                          
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
                                <th>Product Name:</th>
                                <th>Quantity left</th>
                                <th>Unit Price</th>
                                <th>Unit Sold</th>
                                <th>Total Sales</th>
                                
                            </tr>
                        </thead>
                        <tbody>

                <?php 
                    $i = 1;
                    while($row=$resultOrders->fetch_assoc()):  
                 ?>
                            <tr> 
                                <td><?php echo $i++?></td>
                                <td><?php echo $row['name']?></td>
                                <td><?php echo $row['stocks'] ?></td>
                                <td><?php echo $row['price'] ?></td>
                                <td><?php echo $row['qty'] ?></td>
                                <td><?php echo number_format($row['qty'] * $row['price'],2) ?></td>
                                <td></td>
                            </tr>
                            <?php endwhile; ?>
                           </tbody>
                        </tbody>
                    </table>
                </div>

               
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