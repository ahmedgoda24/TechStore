<?php

use TeachStore\Classes\Models\Admin;
use TeachStore\Classes\Models\Product;


include("inc/header.php");?>
<?php
$idAdm=$session->get('adminID');
$a=new Admin;
$adm=$a->selectId($idAdm);



$p=new Product;
$prods=$p->selectAllWithCat("products.id AS prodId, products.name AS prodName, cats.name AS catName,
 img, pieces_no, price, products.created_at AS prodCreatedAt");
?>

    <div class="container-fluid py-5">
        <div class="row">

            <div class="col-md-10 offset-md-1">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3>All Products</h3>
                    <?php if($adm["is_super"]=="no"): ?>
                    <a href="<?=AURL."add-product.php"?>" class="btn btn-success disabled">
                        Add new
                    </a>
                    <?php elseif($adm["is_super"]=="yes"): ?>
                    <a href="<?=AURL."add-product.php"?>" class="btn btn-success ">
                        Add new
                    </a>
                    <?php endif;?>
                </div>

                <table class="table table-hover">
                    <thead>
                       
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Category</th>
                        <th scope="col">Image</th>
                        <th scope="col">Pieces</th>
                        <th scope="col">Price</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($prods as $index => $prod): ?>
                      <tr>
                        <th scope="row"><?=$index+1;?></th>
                        <td><?=$prod["prodName"];?></td>
                        <td><?=$prod["catName"];?></td>
                        <td>
                            <img src="<?= URL."uploads/".$prod["img"];?>" height="60px" alt="">
                        </td>
                        <td><?=$prod["pieces_no"];?></td>
                        <td>$<?=$prod["price"];?></td>
                        <td><?= date( "d M,Y  h:i a",strtotime($prod["prodCreatedAt"]));?></td>
                      <?php if($adm["is_super"]=="no"): ?>
                            <td>
                                <a class="btn btn-sm btn-info disabled" href="<?=AURL."edit-product.php?id=".$prod['prodId']?>">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a class="btn btn-sm btn-danger disabled"href="<?=AURL."handlers/delete-product.php?id=".$prod['prodId']?>">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                            <?php elseif($adm["is_super"]=="yes") :?>
                                <td>
                                <a class="btn btn-sm btn-info" href="<?=AURL."edit-product.php?id=".$prod['prodId']?>">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a class="btn btn-sm btn-danger"href="<?=AURL."handlers/delete-product.php?id=".$prod['prodId']?>">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        <?php endif; ?>
                      </tr>
                      <?php endforeach;?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    <?php include("inc/footer.php");?>
