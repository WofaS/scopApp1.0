<?php require views_path('partials/header'); ?>

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
<?php require views_path('partials/footer'); ?>