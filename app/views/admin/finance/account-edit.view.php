<?php
if (!empty($_SESSION['referer'])) {
    $back_link = $_SESSION['referer'];
} else {
    $back_link = "index.php?pg=source-of-funds";
}
?>

<?php require views_path('partials/header'); ?>

<div class="container-fluid border col-lg-5 col-md-6 mt-5 p-4" >
 <?php if (is_array($row)): ?>
    <form method="post">
        <center>
            <h3><i class="fa fa-users"></i>Account Edit</h3>
            <div><?= esc(APP_NAME) ?></div>
        </center>
        <br>		
           
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Type</label>                         
            <select name="type" type="text" class="form-control  <?= !empty($errors['type']) ? 'border-danger' : '' ?>">                              
                <?php if ($source == "sof_add"): ?>
                <option value="Default" selected="" <?= !empty(set_value('type', $row['type']) && set_value('type', $row['type']) == 'Default') ? 'selected' : '' ?>>Default</option>
                    <?php else: ?>
                    <option value="Savings" <?= !empty(set_value('type', $row['type']) && set_value('type', $row['type']) == 'Savings') ? 'selected' : '' ?> >Savings</option>
        
                <?php endif ?>
            </select>                              
            <?php if (!empty($errors['type'])): ?>
                <small class="text-danger"><?= $errors['type'] ?></small>
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">A/c Name</label>
            <input value="<?= set_value('acc_name', $row['acc_name']) ?>" name="acc_name" type="text" class="form-control <?= !empty($errors['acc_name']) ? 'border-danger' : '' ?>" id="exampleFormControlInput1" placeholder="A/c Name">
            <?php if (!empty($errors['acc_name'])): ?>
                <small class="text-danger"><?= $errors['acc_name'] ?></small>
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">A/c Name</label>
            <input value="<?= set_value('acc_number', $row['acc_number']) ?>" name="acc_number" type="text" class="form-control" id="exampleFormControlInput1" placeholder="A/c Number">
            
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Location</label>
            <input value="<?= set_value('location',$row['location']) ?>" name="location" type="text" class="form-control <?= !empty($errors['location']) ? 'border-danger' : '' ?>" id="exampleFormControlInput1" placeholder="Location">
            <?php if (!empty($errors['location'])): ?>
                <small class="text-danger"><?= $errors['location'] ?></small>
            <?php endif; ?>
        </div>

        <br>
        <button class="btn btn-primary float-end"><i class="fa fa-edit"></i> Update</button>
        <a href="<?= $back_link; ?>" class="btn btn-danger "><i class="fa fa-ban"></i> Cancel</a>
    </form>
    <?php else: ?>
        <div class="alert alert-danger text-center">Record not found</div>
        <a  href="<?= $back_link; ?>" ><button class="btn btn-danger "> <i class="fa fa-ban"></i> Cancel</button></a>
<?php endif; ?>
</div>

<?php require views_path('partials/footer'); ?>
