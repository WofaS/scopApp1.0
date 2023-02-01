<?php
if (!empty($_SESSION['referer'])) {
    $back_link = $_SESSION['referer'];
} else {
    $back_link = "index.php?pg=source-of-funds";
}
?>

<?php require views_path('partials/header'); ?>

<div class="container-fluid border col-lg-10 col-md-6 mt-5 p-4" >
    <?php if (!empty($transcode) && strlen($transcode) == 12): ?>
    <form method="post">
            <center>
                <h3><i class="fa fa-users"></i> Record Finance</h3>
                <div><?= esc(APP_NAME) ?></div>
            </center>
            <br>	
            <div class="row">
                <input value="add-finance" name="from" type="hidden" >
                <div class="mb-2 col col-lg-4">
                    <label for="exampleFormControlInput1" class="form-label">Amount</label>
                    <input value="<?= set_value('amount') ?>" name="amount" type="text" class="form-control <?= !empty($errors['amount']) ? 'border-danger' : '' ?>" id="exampleFormControlInput1" placeholder="Amount">
                    <?php if (!empty($errors['amount'])): ?>
                        <small class="text-danger"><?= $errors['amount'] ?></small>
                    <?php endif; ?>
                </div>
                <div class="mb-2 col col-lg-4">
                    <label for="exampleFormControlInput1" class="form-label">Type</label>                         
                    <select name="id" type="text" class="form-control  <?= !empty($errors['type']) ? 'border-danger' : '' ?>">                              
                        <option value="" >--SELECT TYPE--</option>
                        <?php if (!empty($sof) && is_array($sof)): ?>
                        <?php foreach ($sof as $type): ?>
                            <option value="<?= $type['id'] ?>" <?= !empty(set_value('type') && set_value('type') == $type['acc_name']) ? 'selected' : '' ?>><?= $type['acc_name'] ?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    </select>                              
                    <?php if (!empty($errors['type'])): ?>
                        <small class="text-danger"><?= $errors['type'] ?></small>
                    <?php endif; ?>
                </div>
                <div class="mb-2 col col-lg-4">
                    <label for="exampleFormControlInput1" class="form-label">Comment</label>
                    <input value="<?= set_value('comment') ?>" name="comment" type="text" class="form-control <?= !empty($errors['comment']) ? 'border-danger' : '' ?>" id="exampleFormControlInput1" placeholder="comment">
                    <?php if (!empty($errors['comment'])): ?>
                        <small class="text-danger"><?= $errors['comment'] ?></small>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row">

                <div class="mb-1 col col-lg-4">
                    <label for="exampleFormControlInput1" class="form-label">Date</label>
                    <input value="<?= set_value('date') ?>" name="date" type="date" class="form-control <?= !empty($errors['date']) ? 'border-danger' : '' ?>" id="exampleFormControlInput1" >
                    <?php if (!empty($errors['date'])): ?>
                        <small class="text-danger"><?= $errors['date'] ?></small>
                    <?php endif; ?>
                </div>
                
                <div class="mb-1 col col-lg-4">
                    <label for="exampleFormControlInput1" class="form-label">Add</label>
                    <button class="btn btn-primary form-control"><i class="fa fa-plus"></i> Add</button>
                </div>
            </div>
            <br>
          
           
        </form>
 
    <div class="table-responsive">
   
    <table class="table table-hover">
     
        <tr>
            <th>Sn</th><th>A/c_Number</th><th>A/c_Name</th><th>Amount</th><th>Comment</th><th>Status</th>
            <th ></th>
        </tr>

        <?php if (!empty($pending) && is_array($pending)): ?>
           <hr>
            <?php
            $NO = 0;
            foreach ($pending as $pending):
                $NO += 1;
                ?>
                <tr>
                    <td><?= esc($NO) ?></td>
                    <td><?php echo $pending['acc_number']; ?></td>                           
                    <td><?php echo $pending['acc_name']; ?></td>
                    <td class="text-info"><b><?php echo $pending['credit']; ?></b></td>                                       
                    <td><?php echo $pending['comment']; ?></td>                                            
                    <td class="text-warning"><?php echo $pending['status']; ?></td>                                            
                    <td>
                     <a title="Delete " class="btn btn-sm btn-outline-danger float-end" href="?q=finance-stmnt&acc-number=<?php echo $pending['id']; ?>&name=<?php echo $pending['acc_name']; ?>"><span class="fa fa-trash"></span> Delete</a> 
                    </td>
                </tr>
                 
            <?php endforeach; ?>
                <tr>
                <form method="POST">
                    <td colspan="7" class="">
                        <input name="from" type="hidden" value="save-all" > 
                        <button type="submit" class="btn btn-primary float-end ml-5 btn-sm"  ><i class="fa fa-save"></i> Save All</button> 
                    </td>
                </form>             
                </tr> 
        <?php endif; ?>
    </table>
</div>
    <?php elseif (!empty($transcode) && strlen($transcode) != 12): ?>
        <div class="alert alert-danger text-center">Invalid Transaction Code</div>
        <a  href="<?= $back_link; ?>" ><button class="btn btn-danger "> <i class="fa fa-ban"></i> Cancel</button></a>
    <?php else: ?>
        <div class="alert alert-danger text-center">Transaction Code not found</div>
        <a  href="<?= $back_link; ?>" ><button class="btn btn-danger "> <i class="fa fa-ban"></i> Cancel</button></a>
    <?php endif; ?>
</div>

<?php require views_path('partials/footer'); ?>
