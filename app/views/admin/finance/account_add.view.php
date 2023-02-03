<?php
if (!empty($_SESSION['referer'])) {
    $back_link = $_SESSION['referer'];
} else {
    $back_link = "admin/savings_account-add";
}
?>

<?php $this->view('admin/admin-header',$data) ?>

<div class="container-fluid border col-lg-5 col-md-6 mt-5 p-4" >

    <form method="post">
        <center>
            <h3><i class="fa fa-users"></i> Add Account</h3>
            <div><?= esc(APP_NAME) ?></div>
        </center>
        <br>		 
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Type</label>                         
            <select name="type" type="text" class="form-control  <?= !empty($errors['type']) ? 'border-danger' : '' ?>">                              
                <option value="" >--SELECT TYPE--</option>
                <?php if ($source == "sof_add"): ?>
                <option value="Default" selected="">Default</option>
                    <?php else: ?>
                    <option value="Savings" selected="">Savings</option>
                   
                <?php endif ?>
            </select>                              
            <?php if (!empty($errors['type'])): ?>
                <small class="text-danger"><?= $errors['type'] ?></small>
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">A/c Name</label>
            <input value="<?= set_value('acc_name') ?>" name="acc_name" type="text" class="form-control <?= !empty($errors['acc_name']) ? 'border-danger' : '' ?>" id="exampleFormControlInput1" placeholder="A/c Name">
            <?php if (!empty($errors['acc_name'])): ?>
                <small class="text-danger"><?= $errors['acc_name'] ?></small>
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">A/c Number</label>
            <input value="<?= set_value('acc_number') ?>" name="acc_number" type="text" class="form-control" id="exampleFormControlInput1" placeholder="A/c Number">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Location</label>
            <input value="<?= set_value('location') ?>" name="location" type="text" class="form-control <?= !empty($errors['location']) ? 'border-danger' : '' ?>" id="exampleFormControlInput1" placeholder="Location">
            <?php if (!empty($errors['location'])): ?>
                <small class="text-danger"><?= $errors['location'] ?></small>
            <?php endif; ?>
        </div>

        <br>
        <button class="btn btn-primary float-end"><i class="fa fa-save"></i> Create</button>
        <a href="<?= $back_link; ?>" class="btn btn-danger "><i class="fa fa-ban"></i> Cancel</a>
    </form>
</div>

<?php $this->view('admin/admin-footer',$data) ?>
