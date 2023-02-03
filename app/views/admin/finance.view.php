

<?php $this->view('admin/admin-header',$data) ?>


<?php if($action == 'add'):?>

    <?php
    if (!empty($_SESSION['referer'])) {
        $back_link = $_SESSION['referer'];
    } else {
        $back_link = "admin/finance/savings-account-add";
    }
    ?>
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

<?php elseif ($action == 'edit'):?>


<?php
if (!empty($_SESSION['referer'])) {
    $back_link = $_SESSION['referer'];
} else {
    $back_link = "admin/finance/source-of-funds";
}
?>

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

<?php elseif($action == 'stmnt'):?>

    <div class="container-fluid border col-lg-10 col-md-6 mt-5 p-4 mb-5" >
    <div class="table-responsive">
        <center>
            <h3><i class="fa fa-users"></i>Account Statement</h3>
            <div><?= esc(APP_NAME) ?></div>
        </center>
        
                    <div class="container col-12 col-md-4 col-lg-12 mt-4 mb-4">
                        <div class="row">
                           <h5 class="LucidaSans mt-3">A/c Name: <b><?= $row['acc_name'].' ('.$row['acc_number'].') @ '.$row['location'] ?></b></h5>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">Total Credit : GH&cent;<b><?=$total_credit ? $total_credit:0;?></b></div>
                            <div class="col-lg-4">Total Debit : GH&cent;<b><?=$total_debit ? $total_debit : 0?></b></div>
                            <div class="col-lg-4">Balance : GH&cent;<b><?=$total_credit - $total_debit?></b></div>
                        </div>
                    </div>
        <table class="table table-hover mt-3">
            <tr>
                <th>Sn</th><th>Date</th>
                <th>Transcode</th><th>Type</th><th>Credit</th>
                <th>Debit</th><th>Balance</th>
                <th>Comment</th><th>source</th>                
            </tr>

            <?php if (!empty($stmnt)): ?>
                <?php
                $NO = 0;
                foreach ($stmnt as $stmnts):
                    $NO += 1;
                    ?>
                    <tr>
                        <td><?= esc($NO) ?></td>
                        <td><?php echo $stmnts['date']; ?></td>                           
                        <td><?php echo $stmnts['transcode']; ?></td>  
                        <td><?php echo $stmnts['type']; ?></td>  
                        <td><?php echo $stmnts['credit']; ?></td>  
                        <td class="text-danger"><?php echo $stmnts['debit']; ?></td>  
                        <td class="text-info"><b><?php echo $stmnts['balance']; ?></b></td>    
                        <td><?php echo $stmnts['comment']; ?></td>  
                        <td><?php echo $stmnts['source']; ?></td>  
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </table>
    </div>
</div>

<?php elseif($action == 'transfer'):?>

    <?php
    if (!empty($_SESSION['referer'])) {
        $back_link = $_SESSION['referer'];
    } else {
        $back_link = "admin/finance/source-of-funds";
    }
    ?>

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

<?php elseif($action == 'record'):?>

    <?php
    if (!empty($_SESSION['referer'])) {
        $back_link = $_SESSION['referer'];
    } else {
        $back_link = "admin/finance/source-of-funds";
    }
    ?>

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

<?php elseif($action == 'sof'):?>

<div class="container-fluid border col-lg-10 col-md-6 mt-5 p-4 mb-5" >
    <div class="table-responsive">
        <center>
            <h3><i class="fa fa-users"></i>Source of Funds</h3>
            <div><?= esc(APP_NAME) ?></div>
        </center>

        <table class="table table-hover">
            <?php if (!empty($_SESSION['MESSAGE'])): ?>
                <center>
                    <div class="alert alert-success text-center"><b><?= Auth::getMessage(); ?></b></div>
                </center>
            <?php endif; ?>
            <a href="index.php?pg=account-add" class="btn btn-outline-primary btn-sm mb-2 ">Add New <i class="fa fa-plus"></i></a>
            <a href="index.php?pg=record-finance&transcode=<?= date('Ymd') . rand(1000, 9999); ?>" class="btn btn-outline-success btn-sm mb-2"><i class="fa fa-pen"></i> Record Finance </a>
            <tr>
                <th>Sn</th><th>A/c_Number</th><th>A/c_Name</th><th>Balance</th><th>Last_updated_on</th><th>Last_updated_by</th>
                <th>Form_Action</th>
            </tr>

            <?php if (!empty($sof)): ?>
                <?php
                $NO = 0;
                foreach ($sof as $sofs):
                    $NO += 1;
                    ?>
                    <tr>
                        <td><?= esc($NO) ?></td>
                        <td><?php echo $sofs['id']; ?></td>                           
                        <td><a href="index.php?pg=account-edit&id=<?= $sofs['id'] ?>"><?php echo $sofs['acc_name'] . ' (' . $sofs['location'] . ')'; ?></a></td>
                        <td class="text-info"><b><?php echo $sofs['balance']; ?></b></td>                                         
                        <td><?= date("jS M, Y", strtotime($sofs['updated_on'])); ?></td>
                        <td><?php echo $sofs['updated_by']; ?></td>                                            
                        <td>
                            <a title="Transfer " class="btn btn-sm btn-outline-info" href="index.php?pg=fund-transfer&id=<?php echo $sofs['id']; ?>"><span class="fa fa-bolt"></span> transfer</a> 
                            <a title="Statement " class="btn btn-sm btn-outline-success" href="index.php?pg=account-statement&id=<?php echo $sofs['id']; ?>"><span class="fa fa-check-circle"></span> Stmnt</a> 
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </table>
    </div>
</div>

<?php elseif($action == 'expenses'):?>

    <div class="container-fluid border col-lg-10 col-md-6 mt-5 p-4 mb-5" >
    <div class="table-responsive">
        <center>
            <h3><i class="fa fa-users"></i> Expenses</h3>
            <div><?= esc(APP_NAME) ?></div>
        </center>

        <table class="table table-hover">
            <?php if (!empty($_SESSION['MESSAGE'])): ?>
                <center>
                    <div class="alert alert-success text-center"><b><?= Auth::getMessage(); ?></b></div>
                </center>
            <?php endif; ?>
            <a href="index.php?pg=expenses-record" class="btn btn-outline-primary btn-sm mb-2 ">Add New <i class="fa fa-plus"></i></a>

            <tr>
                <th>Sn</th><th>Date</th><th>Transcode</th><th>amount</th><th>Description</th><th>Receiver</th>
               
            </tr>

            <?php if (!empty($exp)): ?>
                <?php
                $NO = 0;
                foreach ($exp as $exps):
                    $NO += 1;
                    ?>
                    <tr>
                        <td><?= esc($NO) ?></td>
                        <td><?php echo date("jS M, Y", strtotime($exps['date'])); ?></td>                           
                        <td><?php echo $exps['transcode'] ; ?></td>
                        <td class="text-info"><b><?php echo $exps['amount']; ?></b></td>                                         
                        <td><?php echo $exps['purpose']; ?></td>                                            
                        <td><?php echo $exps['receiver']; ?></td>                                          
                                                    
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </table>
    </div>
</div>
    
<?php elseif($action == 'record_expenses'):?>

    <?php
    if (!empty($_SESSION['referer'])) {
        $back_link = $_SESSION['referer'];
    } else {
        $back_link = "admin/finance/expenses-record";
    }
    ?>

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
                        <option value="<?= $des['id'] ?>" <?= !empty(set_value('acc_number') && set_value('acc_number') == $des['id']) ? 'selected' : '' ?>><?= $des['acc_name'] . ' ('.$des['acc_number'].')'.' @ ' . $des['location'].' ------- ['.$des['balance'].']' ?></option>
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

<?php elseif($action == 'sof'):?>



<?php else:?>



<?php endif;?>

<?php $this->view('admin/admin-footer',$data) ?>
