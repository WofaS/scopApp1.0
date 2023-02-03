
<?php $this->view('admin/admin-header',$data) ?>

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
            <a href="<?=ROOT?>/admin/account_add" class="btn btn-outline-primary btn-sm mb-2 ">Add New <i class="fa fa-plus"></i></a>
            <a href="<?=ROOT?>/admin/record_finance&transcode=<?= date('Ymd') . rand(1000, 9999); ?>" class="btn btn-outline-success btn-sm mb-2"><i class="fa fa-pen"></i> Record Finance </a>
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
                        <td><a href="<?=ROOT?>/admin/account_edit&id=<?= $sofs['id'] ?>"><?php echo $sofs['acc_name'] . ' (' . $sofs['location'] . ')'; ?></a></td>
                        <td class="text-info"><b><?php echo $sofs['balance']; ?></b></td>                                         
                        <td><?= date("jS M, Y", strtotime($sofs['updated_on'])); ?></td>
                        <td><?php echo $sofs['updated_by']; ?></td>                                            
                        <td>
                            <a title="Transfer " class="btn btn-sm btn-outline-info" href="<?=ROOT?>/admin/fund_transfer&id=<?php echo $sofs['id']; ?>"><span class="fa fa-bolt"></span> transfer</a> 
                            <a title="Statement " class="btn btn-sm btn-outline-success" href="<?=ROOT?>/admin/account_statement&id=<?php echo $sofs['id']; ?>"><span class="fa fa-check-circle"></span> Stmnt</a> 
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </table>
    </div>
</div>

<?php $this->view('admin/admin-footer',$data) ?>