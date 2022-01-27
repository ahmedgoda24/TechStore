<?php if ($session->has('errors')) : ?>
    <div class="alert alert-danger">
        <?php foreach ($session->get("errors") as $err) : ?>
            <p><?= $err ?></p>
        <?php endforeach;
        $session->remove("errors") ?>
    </div>
<?php endif; ?>