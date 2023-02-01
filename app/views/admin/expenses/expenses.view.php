<?php require views_path('partials/header'); ?>

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
<?php require views_path('partials/footer'); ?>