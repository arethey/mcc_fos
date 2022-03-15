<?php
    include 'db_connect.php';
?>

<div class="container">
    <div class="bg-white p-3 shadow-sm rounded">
        <h1>Inventory</h1>
        <table class="table table-striped mt-3">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Qty Left</th>
                    <th scope="col">Price</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    // $products = $conn->query("SELECT * FROM order_list ol INNER JOIN product_list pl ON ol.product_id = pl.id GROUP BY pl.id ORDER BY pl.name");
                    $products = $conn->query("SELECT * FROM product_list pl ORDER BY pl.name");
                    $i = 1;
                    while($row=$products->fetch_assoc()):
                ?>
                <tr class="<?php echo $row['stocks'] < 10 ? 'text-danger' : '' ?>">
                    <th scope="row"><?php echo $i++?></th>
                    <td><?php echo $row['name']?></td>
                    <td><?php echo $row['stocks']?></td>
                    <td><?php echo $row['price']?></td>
                    <td>
                        <button type="button" class="btn btn-primary btn-stock" data-toggle="modal" data-target="#stockModal" data-id="<?php echo $row['id'] ?>">
                            Add Stocks
                        </button>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
</div>

<!-- Modal -->
<div class="modal fade" id="stockModal" tabindex="-1" role="dialog" aria-labelledby="stockModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="stockModalLabel">Adjust Stock</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="stock_form">
            <div class="modal-body">
                <input type="hidden" name="id" id="stockId" />
                <div class="form-group">
                    <label for="stocks">Stocks</label>
                    <input type="number" class="form-control" id="stocks" name="stocks" required />
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
      </form>
    </div>
  </div>
</div>

<script>
    $('.btn-stock').click(function(){
        $('#stockId').val($(this).attr('data-id'))
    })

$('#stock_form').submit(function(e) {
    e.preventDefault()
    start_load()

    $.ajax({
        url: 'ajax.php?action=add_stock',
        data: new FormData($(this)[0]),
        cache: false,
        contentType: false,
        processData: false,
        method: 'POST',
        type: 'POST',
        success: function(resp) {
            if (resp == 1) {
                alert_toast("Stocks adjusted successfully added", 'success')
                setTimeout(function() {
                    location.reload()
                }, 1500)
            }
        }
    })
})
</script>