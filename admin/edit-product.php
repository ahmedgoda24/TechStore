<?php

use TeachStore\Classes\Models\Product;
use TeachStore\Classes\Models\Cat;


include("inc/header.php");?>
<?php

if($request->get('id')){
    $id=$request->get("id");
}else{
    $id=1;
}
$c=new Cat;
$cats=$c->selectAll("id,name");
$p=new Product;
$prod=$p->selectId($id," products.name AS prodName, `desc`, cats.name AS catName,
img, pieces_no, price, cat_id");

?>

    <div class="container py-5">
        <div class="row">

            <div class="col-md-6 offset-md-3">
                <h3 class="mb-3">Edit Product : <?=$prod['prodName'];?></h3>
                <div class="card">
                    <div class="card-body p-5">
                        <form method="POST" action="<?=AURL;?>handlers/edit-product.php" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?=$id?>">
                            <div class="form-group">
                              <label>Name</label>
                              <input type="text" class="form-control" value="<?=$prod['prodName'];?>" name="name">
                            </div>

                            <div class="form-group">
                                <label>Category</label>
                                <select class="form-control" name="cat_id">
                                <?php foreach($cats as $cat):?>
                                  <option value="<?=$cat["id"];?>"<?php if($cat['id']==$prod['cat_id']){echo "selected";}?> ><?=$cat["name"];?></option>
                                  <?php endforeach;?>
                                </select>
                            </div>
                            

                            <div class="form-group">
                                <label>Price</label>
                                <input type="number" class="form-control"  value="<?=$prod['price'];?>" name="price">
                            </div>

                            <div class="form-group">
                                <label>Pieces</label>
                                <input type="number" class="form-control" value="<?=$prod['pieces_no'];?>" name="pieces">
                            </div>
  
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" rows="3" name="desc">  <?=$prod['desc'];?></textarea>
                            </div>
                            <div class="text-center">
                            <img src="<?=URL."uploads/".$prod['img']?>" height="100px" alt="">
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile" name="img">
                                <label class="custom-file-label" for="customFile">Choose Image</label>
                            </div>
                              
                            <div class="text-center mt-5">
                                <button type="submit" class="btn btn-primary" name="submit" >Submit</button>
                                <a class="btn btn-dark" href="<?=AURL."products.php"?>">Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
<?php include("inc/footer.php");?>
