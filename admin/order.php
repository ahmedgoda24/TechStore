<?php

use TeachStore\Classes\Models\Order;
use TeachStore\Classes\Models\OrderDetails;

include("inc/header.php"); ?>
<?php
if ($request->get('id')) {
  $id = $request->get("id");
}


$o = new Order;
$order = $o->selectId($id, "orders.*,products.name AS prodName ,SUM(price*quan) AS total");

$det = new OrderDetails;
$details = $det->selectWithProduct($id);
?>

<div class="container py-5">
  <div class="row">

    <div class="col-md-6 offset-md-3">
      <h3 class="mb-3">Show Order :<?= $order['id']; ?></h3>
      <div class="card">
        <div class="card-body p-5">
          <table class="table table-bordered">
            <thead>
              <th colspan="2" class="text-center">Customer</th>
            </thead>
            <tbody>
              <tr>
                <th scope="row">Name</th>
                <td><?= $order['name']; ?></td>
              </tr>
              <tr>
                <th scope="row">Email</th>
                <td><?=($order['email']=="NULL") ?"....": $order['email'];?></td>
              </tr>
              <tr>
                <th scope="row">Phone</th>
                <td><?= $order['phone']; ?></td>
              </tr>
              <tr>
                <th scope="row">Address</th>
                <td><?=( $order['address']=="NULL") ? "....": $order['address'];?></td>
              </tr>
              <tr>
                <th scope="row">Time</th>
                <td><?= date("d M,Y  h:i a", strtotime($order["created_at"])); ?></td>
              </tr>
              <tr>
                <th scope="row">Status</th>
                <td><?= $order['status']; ?></td>
              </tr>
            </tbody>
          </table>

          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Product name</th>
                <th>Quantity</th>
                <th>Price</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($details as $productDet) : ?>
                <tr>
                  <td><?= $productDet['name']; ?></td>
                  <td><?= $productDet['quan']; ?></td>
                  <td>$<?= $productDet['price']; ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>

          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Total</th>
                <?php if ($order['status'] == "pending") { ?>

                  <th>Change Status</th>
                <?php } ?>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>$<?= $order['total']; ?></td>
                <?php if ($order['status'] == "pending") { ?>

                  <td>
                  <?php if($adm["is_super"]=="yes") :?>
                    <a class="btn btn-success" href="<?= AURL . "handlers/approve.php?id=" . $order['id']; ?>">Approve</a>
                    <a class="btn btn-danger" href="<?= AURL . "handlers/cancle.php?id=" . $order['id']; ?>">Cancel</a>
                  </td>
                  <?php endif;?>
                <?php } ?>


              </tr>
            </tbody>
          </table>

          <a class="btn btn-dark" href="<?= AURL . "orders.php"?>">Back</a>
        </div>
      </div>
    </div>

  </div>
</div>
<?php include("inc/footer.php"); ?>