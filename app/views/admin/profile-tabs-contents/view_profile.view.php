
  <?php
  use \Model\Auth;
  $app = get_app_details();

  foreach ($app as $app) {
    $company_name = $app->church_name;
  }

?>

 <!-- Profile Edit Form -->   
  <?php if(!empty($row)):?>                   
        <div class="row mb-3 col-12">
          <div class=" px-3 py-2 rounded" style="">
            <div class="row d-flex mx-0 px-0">
              <div class="col-9 my-auto">
                <h4 class="border-bottom fw-bolder text-center mx-auto">About <?=ucfirst($row->firstname)?> <?=ucfirst($row->lastname)?></h4>

               <?php if(!empty($row->role_name)):?>
               <?php if(!($row->role_name === "Supplier")):?>
                <p class="small fst-italic border-bottom"><?= ucfirst($row->firstname ).' '. ucfirst($row->lastname)?> <?='('.ucfirst($row->role_name ? :'No role').') of '.ucfirst($company_name). ', ' .ucfirst($row->category_name). ' Branch serves in the company as '?> <?=$row->localposition_name ? :'Not available'?><?='. '.ucfirst($row->firstname). ' was born on the '.get_date($row->dob).' to '.$row->mother_name.' (Mother) and '. $row->father_name." (Father). Currently ".$row->firstname. ' stays at '.$row->residence.' in Sampa-Jaman North District of the Bono Region, Ghana.'?></p>

              <?php else:?>
                <p class="small fst-italic border-bottom"><?= ucfirst($row->firstname ).' '. ucfirst($row->lastname)?> <?='('.ucfirst($row->role_name ? :'No role').') of '.ucfirst($company_name). ', ' .ucfirst($row->category_name). ' Branch is a highly esteemed '?> <?=$row->role_name ? :'Not available'?><?=' of the company. '.ucfirst($row->firstname). ' was born on the '.get_date($row->dob).' to '.$row->mother_name.' (Mother) and '. $row->father_name." (Father). Currently ".$row->firstname. ' stays at '.$row->residence.' in Sampa-Jaman North District of the Bono Region, Ghana.'?></p>
              <?php endif;?>
              <?php endif;?>
              </div>
              <div class="col float-end my-auto">
                <a href="<?=ROOT?>/admin/profile_edit/<?=$row->id?>">
                  <img src="<?=get_avatar($row->image)?>" class="w-100 rounded border mx-auto" style="object-fit: fill; width: 180px; max-width:180px;height:150px; border: 2px solid black;" alt="">
                </a>
              <div class="badge bg-info text-light"><?=$age_month?></div>
            </div> 
            <br>
            
            </div>
           <div class="table table-hover mx-0 px-3 rounded mb-3 mt-2" id="profile-overview">            
                
                <div class="row d-flex">
                <div class="col-lg-6 px-2">
                <table class="table-borderless table-striped px-3 rounded">
                  <tbody>
                    <!-- personal Details -->
                    <h5 class="text-info">Personal Details</h5><hr>

                  <tr class="row d-flex">
                    <th class="col-4">Name: </th>
                    <td class="col-8"><?=esc($row->firstname ? :'Not available')?> <?=esc($row->lastname ? :'Not available')?></td>
                  </tr>              

                  <tr class="row d-flex">
                    <?php if(!empty($row->role_name)):?>
                    <th class="col-4">Role: </th>
                    <td class="col-8">
                      <?=esc($row->role_name ? :'Not available')?> 
                    <?php if(!($row->role_name === "Supplier") AND !empty($row->localposition_id)):?>
                      <span class="fst-italic text-muted">(<?=($row->localposition_name ? :'No position')?>)</span>
                    <?php endif;?>
                    </td>
                    <?php endif;?>
                  </tr>

                  <tr class="row d-flex">
                    <th class="col-4">DOB: </th>
                    <td class="col-8"><?=esc(get_date($row->dob ? :'Not available'))?></td>
                  </tr>

                  <tr class="row d-flex">
                    <th class="col-4">Gender: </th>
                    <td class="col-8"><?=esc($row->gender ? :'Not available')?></td>
                  </tr>

                   <tr class="row d-flex">
                    <th class="col-4">Contact: </th>
                    <td class="col-8"><?=esc($row->phone ? :'Not available')?></td>
                  </tr>

                  <tr class="row d-flex">
                    <th class="col-4">Email: </th>
                    <td class="col-8"><?=esc($row->email ? :'Not available')?></td>
                  </tr>

                  <tr class="row d-flex">
                    <th class="col-4">M Status: </th>
                    <td class="col-8"><?=esc($row->marital_status_id ? :'Not available')?></td>
                  </tr>
                  
                  <?php if($row->marital_status_id === 'Married'):?>
                  <tr class="row d-flex">
                    <th class="col-4">Spouse Name: </th>
                    <td class="col-8"><?=esc($row->spouse_name ? :'Not available')?>
                      <span class="fst-italic text-muted">(<?=esc($row->spouse_phone ? :'Contact Unknowm')?>)</span>
                    </td>
                  </tr>

                  

                  <?php if(!empty($row->children)):?> 
                  <tr class="row">
                    <th class="col-4">Children </th>
                    <td class="col-8"><?=esc($row->children ? :'Not available')?></td>
                  </tr>
                  <?php endif;?> 
                <?php endif;?>

                  <tr class="row d-flex">
                    <th class="col-4">Residence: </th>
                    <td class="col-8"><?=esc($row->residence ? :'Not available')?></td>
                  </tr>

                  <tr class="row d-flex">
                    <th class="col-4">GPS Address: </th>
                    <td class="col-8"><?=esc($row->gps_address ? :'Not available')?></td>
                  </tr>
                </tbody>
              </table>
                </div>

            <!-- Other Details -->
                <div class="col-lg-6 px-2">
                <table class="table-borderless table-striped px-3 rounded">
                    <tbody>

                    <h5 class="text-info">Other Details</h5><hr>

                  <tr class="row d-flex">
                    <?php if(!empty($row->role_name)):?>
                     <th class="col-4">Position: </th>
                     <td class="col-8"><?=esc($row->role_name ? :'Not available')?></td>
                   <?php endif;?>
                  </tr>

                  <tr class="row">
                    <th class="col-4 ">Hometown:</th>
                    <td class="col-8 text-wrap"><?=esc($row->hometown ? :'Not available')?></td>
                  </tr>

                  <tr class="row">
                    <th class="col-4">Father:</th>
                    <td class="col-8 text-wrap"><?=esc($row->father_name ? :'Not available')?> <span class="fst-italic text-muted">(<?=esc($row->father_phone ? :'Contact Unknowm')?>)</span>
                    </td>
                  </tr>

                  <tr class="row">
                    <th class="col-4">Mother:</th>
                    <td class="col-8 text-wrap"><?=esc($row->mother_name ? :'Not available')?> <span class="fst-italic text-muted">(<?=esc($row->mother_phone ? :'Contact Unknowm')?>)</span>
                    </td>
                  </tr>

                  <tr class="row">
                    <th class="col-4 text-wrap">Emergency Contact Person:</th>
                    <td class="col-8 text-wrap"><?=esc($row->emergecy_name ? :'Not available')?> <span class="fst-italic text-muted">(<?=esc($row->emergecy_contact ? :'Contact Unknowm')?>)</span>
                    </td>
                  </tr>
                  
                  <tr class="row">
                    <th class="col-4">Registered on:</th>
                    <td class="col-8 text-wrap"><?=get_date($row->date ?? '<div class="text-danger fs-5 fw-lighter">Not available</div>')?></td>
                  </tr>
                </tbody>
              </table>
                </div>
                </div>

            
          </div>
        </div>
      </div>
      <?php endif;?>