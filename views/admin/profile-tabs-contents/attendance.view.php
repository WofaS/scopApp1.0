<div class="tab-pane fade attendance pt-3 show" id="attendance">
  <!-- Profile Edit Form -->

  <?php /*include('register/stat2.inc.php');*/ ?>

  <div class="row">
      <div class="mx-auto p-3 rounded">
      <div class=" rounded">
      <?php if(!empty($rows2)):?>
          <h4 class="text-center LucidaSans mt-3"><u>Marked Attendance for <?= $row->firstname ?></u></h4>
          <div class="table-responsive mt-3">
              <div class="card p-3 mb-4 col-8 mx-auto">
                  <table  id="example" class="table table-hover table-striped">
                      
                    <tbody>  
                      <tr class="alert alert-info">                                        
                           
                          <th></th>          
                          <th>Total</th>
                      </tr> 
                      <tr>
                          <th focus="row">Present:</th>
                          <td><?=$my_total_present ? $my_total_present : 0?></td>

                      </tr>
                      <tr>
                          <th focus="row">Absent:</th>
                          <td><?=$my_total_attentance ? $my_total_absent : 0?></td>

                      </tr>

                      <tr>
                          <th focus="row">Total Marked:</th>
                          <th class="border-bottom text-primary"><?=$my_total_attentance  ? $my_total_attentance :0;?></th>

                      </tr>
                      </tbody>
                  </table>
              </div>
              <div class="container-fluid mb-4 mx-auto">

                  <table id="example" class="table table-hover ">
                      <tr>                                        
                          <th>Sn</th> 
                          <th>Event Date</th> 
                          <th>Image</th>            
                          <th>Name</th>            
                          <th>Assembly</th>            
                          <th>Comment</th>          
                          <th>Remarks</th>          
                          <th>Marked by</th>            

                      </tr>     
                      <?php
                      $NO = 0;
                      foreach ($rows2 as $att):
                          $NO += 1;
                          ?>
                          <tr>
                              <td><?= esc($NO) ?></td>
                              <td><?= esc(($att->month)) ?></td>
                              <td>
                                 <a href="<?=ROOT?>/admin/viewusers/<?=$att->id?>" class="text-primary">
                                  <?php if (!empty($att->image)): ?>                  
                                  <img src="<?=get_profile_image($att->image)?>" alt="" style="width:80px;max-width:80px;height:80px;object-fit: SPAN;" class="rounded">          
                                  <?php elseif(!empty($att->gender)):?>
                                  <img src="<?=ROOT?>/assets/images/<?=$att->gender?>.jpg" alt="" style="width:80px;max-width:80px;height:80px;object-fit: SPAN;" class="rounded">
                                <?php else:?>
                                  <img src="<?=ROOT?>/assets/images/no-image.jpg" alt="" style="width:80px;max-width:80px;height:80px;object-fit: SPAN;" class="rounded">
                                <?php endif ;?></a>
                              </td>

                              <td><?= esc($att->firstname . ' ' . $att->lastname) ?></td>
                              <td><?= esc($att->category_id) ?></td>
                              <td <?php
                                  if ($att->status == "PRESENT") {
                                      echo 'class="text-success text-center"';
                                  } else {
                                      echo 'class="text-danger text-center"';
                                  }
                                  ?>><?php echo $att->status; ?>
                              </td>

                              <td >
                                  <?php if(!empty($att->comment)):?>
                                      <p class="text-center text-muted fst-italic alert alert-info py-1"><?= $att->comment; ?></p>
                                  <?php endif;?>
                              </td>
                              
                              <td><?= $att->marked_by ?></td>

                          </tr>
                      <?php endforeach; ?>
                      

                  </table>
          </div>
      </div>

      <?php else: ?>
        
      <div class="alert alert-danger text-center mt-5">Record not found</div>
                
      <?php endif; ?>
      </div>
  </div>
     
  </div>

</div>