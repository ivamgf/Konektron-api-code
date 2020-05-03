<?php echo form_open('#', [ 'class' => 'form-signin' ]); ?>
    <img class="mb-4" src="/assets/img/logo-konektron-large.png" alt="" width="120" height="120">
    <?php
        if (!empty($success)) {
        ?>
            <div class="alert alert-success" role="alert">
                <?php echo $success; ?>
            </div>
        <?php
        } else if (!empty($error)) {
            ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error; ?>
            </div>
            <?php
        }
    ?>
</form>
