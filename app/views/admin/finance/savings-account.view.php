<?php require views_path('partials/header'); ?>

<div class="container-fluid border col-lg-10 col-md-6 mt-5 p-4 mb-5" >
    <div class="table-responsive">
        <center>
            <h3><i class="fa fa-users"></i> Savings Accounts</h3>
            <div><?= esc(APP_NAME) ?></div>
        </center>

        <table class="table table-hover">
            <?php if (!empty($_SESSION['MESSAGE'])): ?>
                <center>
                    <div class="alert alert-success text-center"><b><?= Auth::getMessage(); ?></b></div>
                </center>
            <?php endif; ?>
            <a href="index.php?pg=account-add" class="btn btn-outline-primary btn-sm mb-2 ">Add New <i class="fa fa-plus"></i></a>
                <a href="index.php?pg=expenses-record" class="btn btn-outline-success btn-sm mb-2"><i class="fa fa-pen"></i> Record Expenses </a>
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
                        <td><a href="index.php?pg=account-edit&id=<?= $sofs['id'] ?>"><?php echo $sofs['acc_name'] . ' @ ' . $sofs['location']; ?></a></td>
                        <td class="text-info"><b><?php echo $sofs['balance']; ?></b></td>                                         
                        <td><?= date("jS M, Y", strtotime($sofs['updated_on'])); ?></td>
                        <td><?php echo $sofs['updated_by']; ?></td>                                            
                        <td>
                            <?php if (strtolower($sofs['acc_name']) == "cash"): ?>
                               <a title="Transfer " class="btn btn-sm btn-outline-info" href="index.php?pg=fund-transfer&id=<?php echo $sofs['id']; ?>"><span class="fa fa-bolt"></span> transfer</a> 
                            <?php endif; ?>
                            <a title="Statement " class="btn btn-sm btn-outline-success" href="index.php?pg=account-statement&id=<?php echo $sofs['id']; ?>"><span class="fa fa-check-circle"></span> Stmnt</a> 
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </table>
    </div>
</div>
<?php require views_path('partials/footer'); ?>