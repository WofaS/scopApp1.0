<?php
  use \Model\Auth;
  $categories = get_categories();

  
  
?>

<div class="pagetitle rounded p-0 border-bottom">
   <nav>   
        <label class="fw-bolder badge text-primary"><?=strtoupper('District Membership Overview')?></label>
        
        <ul class="breadcrumb my-0 py-0">

          <li class="card-title mx-auto d-flex">
            <div class="card-icon rounded-circle text-primary fw-bolder" >

          <?php

           $num = 0;  
           $numM = 0; 
           $numV = 0; 
           $numMM = 0; 
           $numMF = 0; 

           foreach ($data['row'] as $row){

                 if(!empty($row->category_id)){

                      $dob = $row->dob;
                      $today = date("Y-m-d");
                      $diff = date_diff(date_create($dob), date_create($today));
                      $age = $diff->format('%Y');

                      $num += 1;

                    $totalT = $num ;

                    if($row->role_name !='visitor'){

                      $numM += 1;

                      $totalM =$numM;

                      if($row->gender ==='male')
                      $numMM += 1;

                      $totalMM =$numMM;

                      if($row->gender ==='female')
                      $numMF += 1;

                      $totalMF =$numMF;

                    }

                    if($row->role_name === 'visitor')
                      $numV += 1;

                    $totalV = $numV ;
                  }
                }
                ?>
              <i class="bi bi-people-fill"></i></div>Total  <b class="mx-2 mb-0 text-danger"><?=$totalT ?? 0?></b>

              <div class="filter col float-end">
              <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                  <h6></h6>
                    </li>

                    <li><a class="dropdown-item" href="#"><label class="col-6">Members </label><span class="col-6 text-info fw-bold"><?=$totalM ?></span></a></li>
                    <li><a class="dropdown-item" href="#"><label class="col-6">Visitors </label><span class="col-6 text-info fw-bold"><?=$totalV ?></span></a></li>
                    <li><a class="dropdown-item" href="#"><label class="col-6 fw-bolder text-danger">TOTAL </label><span class=" col-6 text-danger fw-bold" style="border-bottom:2px solid red"><?=$totalT?></span></a></li>
                  </ul>
                </div>
          </li>
          
          <li class="card-title mx-auto d-flex">
            <div class="card-icon rounded-circle text-primary fw-bolder mx-auto" ><i class="bx bx-male"></i></div>Members <b class="mx-3 text-danger"><?=$totalM ? : 0?></b>
            <div class="filter col float-end">
            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
            <li class="dropdown-header text-start">
              <h6></h6>
                </li>

                <li><a class="dropdown-item" href="#"><label class="col-6">Male </label><span class="col-6 text-info fw-bold"><?=$totalMM ?></span></a></li>
                <li><a class="dropdown-item" href="#"><label class="col-6">Female </label><span class="col-6 text-info fw-bold"><?=$totalMF ?></span></a></li>
                <li><a class="dropdown-item" href="#"><label class="col-6 fw-bolder text-danger">TOTAL </label><span class=" col-6 text-danger fw-bold" style="border-bottom:2px solid red"><?=$totalM?></span></a></li>
              </ul>
            </div>
          </li>
          <li class="card-title mx-auto d-flex">
            <div class="card-icon rounded-circle text-primary fw-bolder mx-auto" ><i class="bx bx-female"></i></div>Visitors <b class="mx-3 text-danger"><?=$totalV ?? 0?></b>
          </li>
        </ul>
      </nav>
    </div><!-- End Page Title -->

<section class="mt-2 pt-1">
<div class="container-fluid" data-aos="fade-up">

  

<?php if(!empty($data['row'])):?>
        <div class="card-body">
             
            <div class="section-header d-flex justify-content-between align-items-center mb-2">
              <h5 class="text-muted"><?=strtoupper(esc('Sampa District - Membership'))?></h5>
              <p class="col-6">Note: <span class="fst-italic">These are all members of the district who have been registered so far.It comprises children, officers, non-officers and 'visitors'.</span></p>
            </div>      
            <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
              
              <div class="dataTable-container">

              <table class="table table-striped table-borderless border-bottom table-hover datatable dataTable-loading" >
              <thead>
                <tr class="" style="background: lightgray;">
                  <th scope="col" data-sortable="" ><a href="#" class="dataTable-sorter">#</a></th>
                  <th scope="col" data-sortable="" ><a href="#" class="dataTable-sorter">PHOTO</a></th>
                  <th scope="col" data-sortable="" ><a href="#" class="dataTable-sorter">NAME</a></th>
                  <th scope="col" data-sortable="" ><a href="#" class="dataTable-sorter">M.STATUS</a></th>
                  <th scope="col" data-sortable="" ><a href="#" class="dataTable-sorter">DOB</a></th>
                  <th scope="col" data-sortable="" ><a href="#" class="dataTable-sorter">ROLE</a></th>
                  <th scope="col" data-sortable="" ><a href="#" class="dataTable-sorter"><i class="bx bxs-phone-incoming fw-bolder text-danger"></i> PHONE</a></th>
                  <th scope="col" data-sortable="" ><a href="#" class="dataTable-sorter"><i class="bi bi-pin-map fw-bolder text-danger"></i> RESIDENCE</a></th>
                  <th scope="col" data-sortable="" ><a href="#" class="dataTable-sorter"><i class="bi bi-pin-map fw-bolder text-danger fw-bolder"></i> LOCAL</a></th>
                  <th scope="col" data-sortable="" >
                    <a href="<?=ROOT?>/admin/excel/print_members"><button class="btn btn-success btn-sm"><i class="bi bi-file-earmark-excel p-0"></i> Download Excel</button>
                    </a>ACTION</th>
                </tr>
              </thead>
              <tbody>
                  
                  

                <?php $id = 0;?>
                <?php foreach ($data['row'] as $row):?>

                <?php if(!empty($row->category_id)):?>

                  <?php

                      $dob = $row->dob;
                      $today = date("Y-m-d");
                      $diff = date_diff(date_create($dob), date_create($today));
                      $age = $diff->format('%Y');

                      $mydob = get_date_month_day($row->dob);
                      $today = date('m d');

                      $id += 1;
                  ?>
                <tr>                        
                  <th scope="row"><a href="<?=ROOT?>/admin/profile/<?=$row->id?>"><?=$id?></a></th>
                  <td>
                    <a href="<?=ROOT?>/admin/profile/<?=$row->id?>" class="text-primary">
                    <?php if(!empty($row->image)):?>
                      <img src="<?=get_profile_image($row->image)?>" alt="" style="width:40px;max-width:40px;height:40px;object-fit: SPAN;" class="rounded">
                    <?php elseif($row->gender ==="female" AND $age < 13):?>
                      <img src="<?=ROOT?>/assets/images/girl-avatar2.jpg" alt="" style="width:40px;max-width:40px;height:40px;object-fit: SPAN;" class="rounded">
                    <?php elseif($row->gender ==="female" AND $age > 13 OR $age === 13):?>
                      <img src="<?=ROOT?>/assets/images/female.jpg" alt="" style="width:40px;max-width:40px;height:40px;object-fit: SPAN;" class="rounded">
                    <?php elseif($row->gender === "male" AND $age < 13):?>
                      <img src="<?=ROOT?>/assets/images/boy-avatar2.jpg" alt="" style="width:40px;max-width:40px;height:40px;object-fit: SPAN;" class="rounded">
                      <?php elseif($row->gender === "male" AND $age > 13 OR $age === 13):?>
                      <img src="<?=ROOT?>/assets/images/male.jpg" alt="" style="width:40px;max-width:40px;height:40px;object-fit: SPAN;" class="rounded">
                    <?php endif;?>
                   </a>
                  <?php if(Auth::is_admin()):?>
                  <?php if($age > 1 AND $mydob === $today):?>
                  <strong class="badge bg-info"><?=$age?> yrs</strong>
                <?php elseif($age > 1 AND $mydob !== $today):?>
                  <strong class="badge bg-secondary"><?=$age?> yrs</strong>
                <?php elseif($age < 2 AND $mydob === $today):?>
                  <strong class="badge bg-info"><?=$age?> yr</strong>
                <?php else:?>
                  <strong class="badge bg-secondary"><?=$age?> yr</strong>
                <?php endif;?>
                <?php endif;?>
                  </td>
                  <th><a href="<?=ROOT?>/admin/profile/<?=$row->id?>"><?=$row->firstname?> <?=$row->lastname?> <small class="fst-italic text-muted">(<?=ucfirst($row->role_name ?? '')?>)</small></a></th>
                  <td><span class=""><?=ucfirst($row->marital_status_id ?? 'Unknown')?></span></td>
                  <td><span class=""><?=get_date($row->dob ?? 'Unknown')?></span></td>
                  <td><span class=""><?=ucfirst($row->role_name ? :'Unknown')?></span></td>
                  <td><span class=""><?=$row->phone ?? 'Unknown'?></span></td>
                  <td><p class="fst-italic"><?=$row->residence?></p></td>          
                  <td><p class="fst-italic"><?=$row->category_id ?? 'Unknown'?></p></td>
                  <td colspan="3">
                    <a href="<?=ROOT?>/admin/profile/<?=$row->id?>">
                      <i class="bi bi-eye-fill btn btn-sm btn-outline-secondary"></i> 
                    </a>

                    <a href="<?=ROOT?>/admin/profile/<?=$row->id?>">
                      <i class="bi bi-pencil-square btn btn-sm btn-outline-primary"></i> 
                    </a>

                    <a href="<?=ROOT?>/admin/delete/<?=$row->id?>">
                      <i class="bi bi-trash-fill btn btn-sm btn-outline-danger"></i>
                    </a>
                  </td>
                </tr>
                <?php endif;?>
                <?php endforeach;?>
              </tbody>
            </table>
          </div>
        </div>
        </div>
      </div>
    </section>
  <?php else:?>
    <div class="alert alert-danger">No records to show</div>
  <?php endif;?>
      <!-- End Profile Edit Form -->