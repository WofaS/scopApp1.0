<?php $this->view('admin/admin-header',$data) ?>
<?php
  use \Model\Auth;
  $categories = get_categories();

?>
        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
			<div class="container-fluid">
				<!-- Add Project -->
				
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Hi, welcome back!</h4>
                            <span>Datatable</span>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Table</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Datatable</a></li>
                        </ol>
                    </div>
                </div>
                <!-- row -->


                <div class="row"> 

                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="section-header d-flex justify-content-between align-items-center mb-2">
                                  <h5 class="col-6 text-muted"><?=strtoupper(esc('Sampa District - Membership'))?></h5>
                                  <p class="col-6 float-right">Note: 
                                    <span class="fst-italic">These are all members of the district who have been registered so far.It comprises children, officers, non-officers and 'visitors'.</span>
                                </p>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example6" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Image</th>
                                                <th>Full Name</th>
                                                <th>Role</th>
                                                <th>M.Status</th>
                                                <th>DOB</th>
                                                <th>Phone</th>
                                                <th>Residence</th>
                                                <th>Assembly</th>
                                                <th>
                                                    <a href="<?=ROOT?>/admin/excel/print_members"><button class="btn btn-success btn-sm"><i class="bi bi-file-earmark-excel p-0"></i> Download Excel</button>
                                                    </a><br>Action
                                                </th>
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
                                                <td><?=$id?></td>
                                                <td>
                                                    <a href="<?=ROOT?>/admin/viewusers/<?=$row->id?>" class="text-primary">
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
                                                   <?php if(Auth::is_admin()):?>
                                                      <?php if($age > 1 AND $mydob === $today):?>
                                                      <strong class="badge py-0 px-1 bg-info"><?=$age?> yrs</strong>
                                                    <?php elseif($age > 1 AND $mydob !== $today):?>
                                                      <strong class="badge py-0 px-1 bg-secondary"><?=$age?> yrs</strong>
                                                    <?php elseif($age < 2 AND $mydob === $today):?>
                                                      <strong class="badge py-0 px-1 bg-info"><?=$age?> yr</strong>
                                                    <?php else:?>
                                                      <strong class="badge py-0 px-1 bg-secondary"><?=$age?> yr</strong>
                                                    <?php endif;?>
                                                    <?php endif;?>
                                                   </a>
                                                </td>
                                                <td><a href="<?=ROOT?>/admin/viewusers/<?=$row->id?>">
                                                    <?=$row->firstname?> <?=$row->lastname?> <small class="fst-italic text-muted"></small>
                                                    </a>
                                                </td>
                                                <td>(<?=ucfirst($row->role_name ?? '')?>)</td>
                                                <td><?=ucfirst($row->marital_status_id ?? 'Unknown')?></td>
                                                <td><?=get_date($row->dob ?? 'Unknown')?></td>
                                                <td><?=$row->phone ?? 'Unknown'?></td>
                                                <td>
                                                    <span class="badge py-0 px-1 light badge py-0 px-1-danger text-wrap"><?=$row->residence?>
                                                    </span>
                                                </td>
                                                <td><?=$row->category_id ?? 'Unknown'?></td>
                                                <td>
                                                    <div class="dropdown ml-auto text-right">
                                                        <div class="btn-link" data-toggle="dropdown">
                                                            <svg width="24px" height="24px" viewbox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
                                                        </div>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item" href="<?=ROOT?>/admin/viewusers/<?=$row->id?>">
                                                              <i class="mr-2 bi bi-eye-fill text-secondary"></i>View Details 
                                                            </a>

                                                            <a class="dropdown-item" href="<?=ROOT?>/admin/profile/<?=$row->id?>">
                                                              <i class="mr-2 bi bi-pencil-square text-primary"></i>Edit Details 
                                                            </a>

                                                            <a class="dropdown-item" href="<?=ROOT?>/admin/delete/<?=$row->id?>">
                                                              <i class="mr-2 bi bi-trash-fill text-danger"></i>Delete
                                                            </a>
                                                        </div>
                                                    </div>
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

				</div>
            </div>
        </div>
                    

        <!--**********************************
            Content body end
        ***********************************-->

        <?php $this->view('admin/admin-footer',$data) ?>


       