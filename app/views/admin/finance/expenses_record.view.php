<?php
if (!empty($_SESSION['referer'])) {
    $back_link = $_SESSION['referer'];
} else {
    $back_link = "admin/expenses_record";
}


$des = get_account_destination();
?>

<?php $this->view('admin/admin-header',$data) ?>


<div class="container-fluid border col-lg-5 col-md-6 mt-5 p-4" >
  
    <form method="post">
        <center>
            <h3><i class="fa fa-users"></i> Record Expenses</h3>
            <div><?= esc(APP_NAME) ?></div>
        </center>
           <?php if (!empty($_SESSION['MESSAGE'])): ?>
            <center>
                <div class="alert alert-success text-center"><b><?= Auth::getMessage(); ?></b></div>
            </center>
        <?php endif; ?>	
        <br>
        <div class="mb-2">
            <label for="exampleFormControlInput1" class="form-label">Date</label>
            <input value="<?= set_value('date') ?>" name="date" type="date" class="form-control <?= !empty($errors['date']) ? 'border-danger' : '' ?>" id="exampleFormControlInput1" placeholder="Date" required="">
            <?php if (!empty($errors['date'])): ?>
                <small class="text-danger"><?= $errors['date'] ?></small>
            <?php endif; ?>
        </div>
     
        <div class="mb-2">
            <label for="exampleFormControlInput1" class="form-label">Amount</label>
            <input value="<?= set_value('amount') ?>" name="amount" type="text" class="form-control <?= !empty($errors['date']) ? 'border-danger' : '' ?>" id="exampleFormControlInput1" placeholder="Amount" required="">
              <?php if (!empty($errors['amount'])): ?>
                <small class="text-danger"><?= $errors['amount'] ?></small>
            <?php endif; ?>
        </div>
        <div class="mb-2">
            <label for="exampleFormControlInput1" class="form-label">Description</label>
            <input value="<?= set_value('purpose') ?>" name="purpose" type="text" class="form-control <?= !empty($errors['purpose']) ? 'border-danger' : '' ?>" id="exampleFormControlInput1" placeholder="Full Description of expensespurpose" required="">
            <?php if (!empty($errors['purpose'])): ?>
                <small class="text-danger"><?= $errors['purpose'] ?></small>
            <?php endif; ?>
        </div>
        <div class="mb-2">
            <label for="exampleFormControlInput1" class="form-label">Received By</label>
            <input value="<?= set_value('receiver') ?>" name="receiver" type="text" class="form-control <?= !empty($errors['receiver']) ? 'border-danger' : '' ?>" id="exampleFormControlInput1" placeholder="narration" required="">
            <?php if (!empty($errors['receiver'])): ?>
                <small class="text-danger"><?= $errors['receiver'] ?></small>
            <?php endif; ?>
        </div>

        <div class="mb-2">
            <label for="exampleFormControlInput1" class="form-label">Source A/c</label>
            <select value="<?= set_value('acc_number') ?>" name="acc_number" type="text" class="form-control  <?= !empty($errors['acc_number']) ? 'border-danger' : '' ?>" required="">                              
                <option value="" >--SELECT DESTINATION A/c--</option>
               
                <?php if (!empty($des)): ?>
                    <?php foreach ($des as $des): ?>
                        <option <?=set_select('acc_number',$des->id)?> value="<?= $des->id ?>"><?= $des->acc_name . ' ('.$des->acc_number.')'.' @ ' . $des->location.' ------- ['.$des->balance.']' ?></option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>                              
            <?php if (!empty($errors['destination'])): ?>
                <small class="text-danger"><?= $errors['destination'] ?></small>
            <?php endif; ?>
        </div>
        <br>
        <button class="btn btn-primary float-end"><i class="fa fa-save"></i> Save</button>
        <a href="<?= $back_link; ?>" class="btn btn-danger "><i class="fa fa-ban"></i> Cancel</a>
    </form>
   
</div>

<?php $this->view('admin/admin-footer',$data) ?>
