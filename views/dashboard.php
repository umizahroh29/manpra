<?php
$name = (isset($_SESSION['user_name'])) ? $_SESSION['user_name'] : '';
?>

<?php include "layout/sidebar.php" ?>

<div class="pt-3 pl-3 pr-3 pb-0">
    <h5>Dashboard</h5>
</div>
<hr>

<div class="col-sm-12 text-center pt-2">
    <div style="font-weight: bold; font-size: 20px">Welcome <?= $name ?>!</div>
    <button class="btn btn-outline mt-3">Reset Password</button>
</div>

<?php include "layout/footer.php" ?>
