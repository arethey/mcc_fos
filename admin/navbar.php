<style>
</style>
<nav id="sidebar" class='mx-lt-5 bg-dark'>

    <div class="sidebar-list">

        <a href="index.php?page=orders" class="nav-item nav-orders"><span class='icon-field'><i
                    class="fa fa-list"></i></span>Orders</a>
        <a href="index.php?page=menu" class="nav-item nav-menu"><span class='icon-field'><i
                    class="fa fa-list"></i></span>Menu</a>

        <?php if($_SESSION['login_type'] == 1): ?>
        <a href="index.php?page=users" class="nav-item nav-users"><span class='icon-field'><i
                    class="fa fa-users"></i></span> Users</a>
        <a href="index.php?page=site_settings" class="nav-item nav-site_settings"><span class='icon-field'><i
                    class="fa fa-cogs"></i></span> Site Settings</a>
        <a href="index.php?page=sales_monitoring" class="nav-item nav-sales_monitoring">
            <span class='icon-field'>
                <i class="fa fa-database"></i>
            </span> Sales Monitoring</a>
        <?php endif; ?>
    </div>

</nav>
<script>
$('.nav-<?php echo isset($_GET['page']) ? $_GET['page'] : '' ?>').addClass('active')
</script>