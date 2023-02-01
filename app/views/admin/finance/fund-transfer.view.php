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
                <h3><i class="fa fa-users"></i> Fund Transfer</h3>
                <div><?= esc(APP_NAME) ?></div>
            </center>
            <br>
            <div class="mb-2">
                <label for="exampleFormControlInput1" class="form-label">Date</label>
                <input value="<?= set_value('date') ?>" name="date" type="date" class="form-control <?= !empty($errors['date']) ? 'border-danger' : '' ?>" id="exampleFormControlInput1" placeholder="Date" required="">
                <?php if (!empty($errors['date'])): ?>
                    <small class="text-danger"><?= $errors['date'] ?></small>
                <?php endif; ?>
            </div>
            <div class="mb-2">
                <label for="exampleFormControlInput1" class="form-label">A/c Name</label>
                <div class="form-control"><?= esc($row['acc_name']) ?></div>
            </div>
            <div class="mb-2">
                <label for="exampleFormControlInput1" class="form-label">A/c Balance</label>
                <div class="form-control"><?= esc($row['balance']) ?></div>
            </div>
            <div class="mb-2">
                <label for="exampleFormControlInput1" class="form-label">Destination</label>
                <select value="<?= set_value('destination') ?>" name="destination" type="text" class="form-control  <?= !empty($errors['destination']) ? 'border-danger' : '' ?>" required="">                              
                    <option value="" >--SELECT DESTINATION A/c--</option>
                    <?php if (!empty($des)): ?>
                        <?php foreach ($des as $des): ?>
                            <option value="<?= $des['id'] ?>" <?= !empty(set_value('destination') && set_value('destination') == $des['id']) ? 'selected' : '' ?>><?= $des['acc_name'] . ' ('.$des['acc_number'].')'.' @ ' . $des['location'].' ------- ['.$des['balance'].']' ?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>                              
                <?php if (!empty($errors['destination'])): ?>
                    <small class="text-danger"><?= $errors['destination'] ?></small>
                <?php endif; ?>
            </div>
            <div class="mb-2">
                <label for="exampleFormControlInput1" class="form-label">Amount</label>
                <input value="<?= set_value('amount') ?>" name="amount" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Amount" required="">
                  <?php if (!empty($errors['amount'])): ?>
                    <small class="text-danger"><?= $errors['amount'] ?></small>
                <?php endif; ?>
            </div>
            <div class="mb-1">
                <label for="exampleFormControlInput1" class="form-label">Narration</label>
                <input value="<?= set_value('comment') ?>" name="comment" type="text" class="form-control <?= !empty($errors['comment']) ? 'border-danger' : '' ?>" id="exampleFormControlInput1" placeholder="narration" required="">
                <?php if (!empty($errors['comment'])): ?>
                    <small class="text-danger"><?= $errors['comment'] ?></small>
                <?php endif; ?>
            </div>

            <br>
            <button class="btn btn-primary float-end"><i class="fa fa-forward"></i> Transfer</button>
            <a href="<?= $back_link; ?>" class="btn btn-danger "><i class="fa fa-ban"></i> Cancel</a>
        </form>
    <?php else: ?>           
        <div class="alert alert-danger text-center">Record not found</div>
        <a href="<?= $back_link; ?>" ><button class="btn btn-primary "> <i class="fa fa-ban"></i> Cancel</button></a>
    <?php endif; ?>
</div>

<?php require views_path('partials/footer'); ?>
