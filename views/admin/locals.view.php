<?php $this->view('admin/admin-header',$data) ?>

<?php

use model\Auth;
$categories = get_categories();
$roles = get_roles();

include('stat.inc.php'); 

?>

  <div class="content-body">
  <div class="container-fluid pagetitle">
      <h1>Members</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?=ROOT?>/admin/dashboard">Dashboard</a></li>
          <li class="breadcrumb-item active">Locals</li>
        </ol>
        <label class="fw-bolder badge text-secondary"><?=strtoupper('District Membership Overview')?></label>
        <ul class="breadcrumb bg-light my-0 py-0">

          <li class="card-title mx-auto d-flex">
            <div class="card-icon rounded-circle text-primary fw-bolder">
              <i class="bi bi-people-fill px-2 fs-6"></i></div>Total <b class="mx-2 mb-0 text-danger"><?=$resAllMembers['num'] ?? 0?></b>
              <div class="filter col float-end">
              <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                  <h6>Members</h6>
                    </li>

                    <li><a class="dropdown-item" href="#"><label class="col-6">Users </label><span class="col-6 text-primary fw-bold"><?=$resUsers['num']?></span></a></li>
                    <li><a class="dropdown-item" href="#"><label class="col-6">Admin </label><span class="col-6 text-primary fw-bold"><?=$resAdmin['num']?></span></a></li>
                    <li><a class="dropdown-item" href="#"><label class="col-6">Membs. </label><span class="col-6 text-primary fw-bold"><?=$resMember['num']?></span></a></li>
                    <li><a class="dropdown-item" href="#"><label class="col-6">Elds </label><span class="col-6 text-primary fw-bold"><?=$resElder['num']?></span></a></li>
                    <li><a class="dropdown-item" href="#"><label class="col-6">Dcnss. </label><span class="col-6 text-primary fw-bold"><?=$resDeaconess['num']?></span></a></li>
                    <li><a class="dropdown-item" href="#"><label class="col-6">Dcns. </label><span class="col-6 text-primary fw-bold"><?=$resDeacon['num']?></span></a></li>
                    <li><a class="dropdown-item" href="#"><label class="col-6">Children </label><span class="col-6 text-primary fw-bold"><?=$resChild['num']?></span></a></li>
                    <li><a class="dropdown-item" href="#"><label class="col-6">Visitors </label><span class="col-6 text-primary fw-bold"><?=$resVisitor['num']?></span></a></li>
                    <li><a class="dropdown-item" href="#"><label class="col-6">Ps. & Wife </label><span class="col-6 text-primary fw-bold">2</span></a></li>
                    <li><a class="dropdown-item" href="#"><label class="col-6 fw-bolder text-danger">TOTAL </label><span class=" col-6 text-danger fw-bold" style="border-bottom:2px solid red"><?=$resAllMembers['num']?></span></a></li>
                  </ul>
                </div>
          </li>

          <li class="card-title mx-auto d-flex">
            <div class="card-icon rounded-circle text-primary fw-bolder mx-auto"><i class="bx bx-male px-1 fs-6"></i></div>Males <b class="mx-3 text-danger"><?=$resMale['num'] ?? 0?></b>
            <div class="filter col float-end">
            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
              <li class="dropdown-header text-start"><h6>Male</h6></li>
              <li><a class="dropdown-item" href="#"><label class="col-6">Adult</label><span class="col-6  text-primary fw-bolder"><?=$resMaleAdult ?? 0?></span></a></li>
              <li class="mb-0 pb-0"><a class="dropdown-item" href="#"><label class="col-6">Child</label><span class="col-6  text-primary fw-bolder border-bottom"><?=$resMaleChild['num'] ?? 0?></span></a></li>
              <li><a class="dropdown-item" href="#"><label class="col-6 text-danger">Total</label><span class="col-6  text-danger fw-bolder" style="border-bottom:2px solid red; border-top:2px solid red;"><?=$resMale['num'] ?? 0?></span></a></li>
            </ul>              
          </div>
          </li>

          <li class="card-title mx-auto d-flex">
            <div class="card-icon rounded-circle text-primary fw-bolder mx-auto">
              <i class="bx bx-female px-1 fs-6"></i>
            </div>Females <b class="mx-3 text-danger"><?=$resFemale['num'] ?? 0?></b>
            <div class="filter col float-end">
            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
              <li class="dropdown-header text-start">
                <h6>Female</h6>
              </li>

              <li><a class="dropdown-item" href="#">
                <label class="col-6">Adult</label><span class="col-6 fw-bolder text-primary"><?=$resFemaleAdult ?? 0?></span></a>
              </li>
              <li class="mb-0 pb-0"><a class="dropdown-item" href="#">
                <label class="col-6">Child</label><span class="col-6  text-primary fw-bolder border-bottom text-primary"><?=$resFemaleChild['num'] ?? 0?></span></a>
              </li>
              <li><a class="dropdown-item" href="#">
                <label class="col-6 text-danger">Total</label><span class="col-6  text-danger fw-bolder" style="border-bottom:2px solid red"><?=$resFemale['num'] ?? 0?></span></a>
              </li>
              </ul>
              </div>
          </li>

          <li class="card-title mx-auto d-flex">
              <ul class="nav nav-tabs fw-bolder border-bottom rounded mb-0">

                <li class="nav-item">
                  <button style="border-radius: 50px; padding-top: 1px; padding-bottom: 1px;" class="nav-link border " data-bs-toggle="dropdown" id="tabular-tab" title="Tabular Views">
                    <i class="text-info bi bi-list toggle-sidebar-btn"></i> Tabular<i class="bi bi-caret-down-fill"></i>
                  </button>
                  <ul class="dropdown-menu dropdown-menu-start dropdown-menu-arrow">

                    <li class="nav-item">
                      <button onclick="set_tab(this.getAttribute('data-bs-target'))" style="border-radius: 50px; padding-top: 1px; padding-bottom: 1px;" class="nav-link active border " data-bs-toggle="tab" data-bs-target="#tabular-view" id="tabular-view-tab" title="Tabular View"><i class="text-info bi bi-list toggle-sidebar-btn"></i>All Members</button>
                    </li>

                    <?php if(!empty($categories)):?>
                     <?php foreach($categories as $cat):?>
                      <li class="nav-item">                 
                        <label onclick="set_tab(this.getAttribute('data-bs-target'))" style="border-radius: 50px; padding-top: 1px; padding-bottom: 1px;" class="nav-link" data-bs-toggle="tab" data-bs-target="#tabular-<?=$cat->slug?>" id="tabular-<?=$cat->slug?>-tab"><i class="bi bi-house text-info"></i><?=$cat->category?></label>             
                      </li>
                    <?php endforeach;?>
                    <?php endif;?>
                  </ul>
                </li>

                <li class="nav-item">
                  <button style="border-radius: 50px; padding-top: 1px; padding-bottom: 1px;" class="nav-link border " data-bs-toggle="dropdown" id="leaders-tab" title="Grid View">
                    <i class="text-info bi bi-grid"></i> Grid<i class="bi bi-caret-down-fill"></i>
                  </button>
                  <ul class="dropdown-menu dropdown-menu-start dropdown-menu-arrow">

                    <li class="nav-item">
                      <button onclick="set_tab(this.getAttribute('data-bs-target'))" style="border-radius: 50px; padding-top: 1px; padding-bottom: 1px;" class="nav-link border " data-bs-toggle="tab" data-bs-target="#grid-view" id="grid-view-tab" title="Grid View"><i class="text-info bi bi-grid"></i>All Members</button>
                    </li>

                    <?php if(!empty($categories)):?>
                     <?php foreach($categories as $cat):?>
                      <li class="nav-item">                 
                        <label onclick="set_tab(this.getAttribute('data-bs-target'))" style="border-radius: 50px; padding-top: 1px; padding-bottom: 1px;" class="nav-link" data-bs-toggle="tab" data-bs-target="#grid-<?=$cat->slug?>" id="grid-<?=$cat->slug?>-tab"><i class="bi bi-house text-info"></i><?=$cat->category?></label>             
                      </li>
                    <?php endforeach;?>
                    <?php endif;?>
                  </ul>
                </li>

                <li class="nav-item">
                  <button style="border-radius: 50px; padding-top: 1px; padding-bottom: 1px;" class="nav-link border " data-bs-toggle="dropdown" id="leaders-tab" title="Officers">
                    <i class="bx bx-street-view text-info"></i> Officers<i class="bi bi-caret-down-fill"></i>
                  </button>
                  <ul class="dropdown-menu dropdown-menu-start dropdown-menu-arrow">

                     <li class="nav-item">
                      <button onclick="set_tab(this.getAttribute('data-bs-target'))" style="border-radius: 50px; padding-top: 1px; padding-bottom: 1px;" class="nav-link border " data-bs-toggle="tab" data-bs-target="#officers" id="officers-tab" title="Officers"><i class="text-info bi bi-grid"></i>All Officers</button>
                    </li>

                    <?php if(!empty($categories)):?>
                     <?php foreach($categories as $cat):?>
                      <li class="nav-item">                 
                        <label onclick="set_tab(this.getAttribute('data-bs-target'))" style="border-radius: 50px; padding-top: 1px; padding-bottom: 1px;" class="nav-link" data-bs-toggle="tab" data-bs-target="#officers_<?=$cat->slug?>" id="officers_<?=$cat->slug?>-tab"><i class="bx bx-street-view text-info"></i> <?=$cat->category?></label>             
                      </li>
                    <?php endforeach;?>
                    <?php endif;?>
                  </ul>
                </li>
              </ul>
            </li>

          <li class="card-title">
            <?php if(user_can('edit_slider_images')):?> 

                <a href="<?=ROOT?>/membersignup">
                  <button class="btn btn-primary btn-md float-end" title="register new member">+ New Member</button>
                </a>
            <?php endif;?>
          </li>
        </ul>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">

        <div class="col">

          <div class="card">
            <div class="card-body">
              <!-- Bordered Tabs -->
              <div class="tab-content">
        <!-- Profile overview -->

                 <div class="tab-pane fade tabular-view pt-3 show" id="tabular-view">
                  <!-- Profile Edit Form -->

                      <?php include views_path('admin/tabular-view/tabular') ?>
                  <!-- End Profile Edit Form -->

                </div>

                <?php if(!empty($categories)):?>
                 <?php foreach($categories as $cat):?>
                <div class="tab-pane fade tabular-<?=$cat->slug?> pt-3 show " id="tabular-<?=$cat->slug?>">
                  <!-- Change Password Form -->
                    
                    <?php include views_path('admin/tabular-view/'.$cat->slug) ?>

                </div>
                <?php endforeach;?>
                <?php endif;?>

                <div class="tab-pane fade grid-view pt-3 show" id="grid-view">
                  <!-- Profile Edit Form -->

                      <?php include views_path('admin/locals-view/grid') ?>
                  <!-- End Profile Edit Form -->

                </div>

                <?php if(!empty($categories)):?>
                 <?php foreach($categories as $cat):?>
                <div class="tab-pane fade grid-<?=$cat->slug?> pt-3 show " id="grid-<?=$cat->slug?>">
                  Change Password Form
                    
                    <?php include views_path('admin/locals-view/'.$cat->slug) ?>

                </div>
                <?php endforeach;?>
                <?php endif;?>

                <div class="tab-pane fade officers pt-3 show " id="officers">
                  <!-- Change Password Form -->
                    
                    <?php include views_path('admin/leaders-view/officers') ?>

                </div>


                <?php if(!empty($categories)):?>
                 <?php foreach($categories as $cat):?>
                <div class="tab-pane fade officers_<?=$cat->slug?> pt-3 show " id="officers_<?=$cat->slug?>">
                  <!-- Change Password Form -->
                    
                    <?php include views_path('admin/leaders-view/'.$cat->slug) ?>

                </div>
                <?php endforeach;?>
                <?php endif;?>
                                 
                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
    </section>
  </div>

    

<script>
  
  
  var tab = sessionStorage.getItem("tab") ? sessionStorage.getItem("tab"): "#profile-overview";
  var uploading = false;

  function show_tab(tab_name)
  {
    const someTabTriggerEl = document.querySelector(tab_name +"-tab");
    const tab = new bootstrap.Tab(someTabTriggerEl);

    tab.show();

  }

  function set_tab(tab_name)
  {
    tab = tab_name;
    sessionStorage.setItem("tab", tab_name);
  }

  
  window.onload = function(){

    show_tab(tab);
  }

  
  /*function handle_result(result)
  {

    console.log(result);
    var obj = JSON.parse(result);
    if(typeof obj == 'object'){
      //object was created

      if(typeof obj.errors == 'object')
      {
        //we have errors
        display_errors(obj.errors);
        alert("Please correct the errors on the page");
      }else{
        //save complete
        alert(obj.message);
        window.location.reload();

      }
    }
  }

  function display_errors(errors){

    for(key in errors){

      document.querySelector(".js-error-"+key).innerHTML = errors[key];
    }
  }
*/
</script>

<?php $this->view('admin/admin-footer',$data) ?>