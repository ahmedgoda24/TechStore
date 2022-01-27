<?php

use TeachStore\Classes\Models\Admin;

include("inc/header.php"); ?>
<?php

$a = new Admin;
$admin = $a->selectAll("id,name,email,is_super");
?>

<div class="container-fluid py-5">
    <div class="row">

        <div class="col-md-10 offset-md-1">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3>All Admins</h3>
            </div>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($admin as $index => $adm) : ?>
                        <tr>
                            <th scope="row"><?= $index + 1; ?></th>
                            <td><?= $adm['name']; ?></td>
                            <td><?= $adm['email']; ?></td>



                            <td>
                                <a class="btn btn-sm btn-info disabled" href="#">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a class="btn btn-sm btn-danger disabled " href="#">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>



                        </tr>


                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </div>
</div>
<?php include("inc/footer.php"); ?>