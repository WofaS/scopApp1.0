<?php $this->view('admin/admin-header',$data) ?>
  <?php if(!empty($row)):?>

    <?php

  $categories = get_categories();
  $positions = get_positions();
  $localPositions = get_local_positions();
  $roles = get_roles();
  $maritalStatus = get_marital_status();
  
      $dob = $row->dob;
      $today = date("Y-m-d");
      $diff = date_diff(date_create($dob), date_create($today));
      $age = $diff->format('%Y,%m years');

  ?>

  <div class="pagetitle">
      <h1>Profile</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?=ROOT?>/admin/dashboard">Dashboard</a></li>
          <li class="breadcrumb-item"><?=esc(ucfirst(set_value('role',$row->role_name ?? '')))?></li>
          <li class="breadcrumb-item">Admin Profile</li>
          <li class="breadcrumb-item active"><?=esc($row->firstname)?> <?=esc($row->lastname)?></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-md-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
              <?php if(!empty($row->image)):?>              
            <img src="<?=get_profile_image($row->image)?>" class="w-100 rounded-circle" style="object-fit: fill; width: 90px; max-width:90px;height:90px;">
          <?php elseif(!empty($row->gender)):?>
            <img src="<?=ROOT?>/assets/images/<?=($row->gender)?>.jpg" class="rounded-circle" style="object-fit: fill; width: 90px; max-width:90px;height:90px;">
          <?php else:?>
            <img src="<?=get_profile_image($row->image)?>" class="rounded-circle" style="object-fit: fill; width: 90px; max-width:90px;height:90px;">
          <?php endif;?>
              <h2 class="text-center"><?=esc($row->firstname)?> <?=esc($row->lastname)?></h2>
              <h3><?=esc(set_value('role',$row->role_name ?? ''))?></h3>
              <h3><?=esc($row->phone )?></h3>
              <small><?=esc($row->job )?></small>
              <small><?=$age?></small>

              <div class="social-links mt-2">
                <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
          </div>

        </div>

        <div class="col-md-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <!-- <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button onclick="set_tab(this.getAttribute('data-bs-target'))" class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-edit" id="profile-edit-tab">Edit Profile</button>
                </li>

              </ul> -->
        <!-- Profile overview -->

                <div class="tab-pane fade profile-edit pt-3 show active" id="profile-edit">
                  <!-- Profile Edit Form -->

                  <form method="post" enctype="multipart/form-data">

                    <div class="row mb-3 ">
                      <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                      <div class="col-md-8 col-lg-9">
                        <label class="d-flex rounded js-profile-image-input" title="Click to Upload new profile image">
                          <input class="js-profile-image-input" onchange="load_image(this.files[0])" type="file" name="image" style="display: none;">
                          <img class="js-image-preview bg-light shadow rounded text-center my-auto" src="<?=ROOT?>/<?=$row->image?>" alt="Profile photo" style="width:200px;max-width:200px;height:200px;object-fit: cover; font-size: 18px">
                          <div class="js-filename m-2 ">Selected File: None</div>
                        </label>
                        <div class="pt-2">
                          <label class="btn btn-primary btn-sm" title="Upload new profile image" >
                            <i class="text-white bi bi-upload"></i>
                            <input class="js-profile-image-input" onchange="load_image(this.files[0])" type="file" name="image" style="display: none;">
                          </label>

                          <?php if(!empty($errors['image'])):?>
                            <small class="js-error-image text-danger"><?=$errors['image']?></small>
                          <?php endif;?>
                        </div>
                      </div>

                    </div>                      
                      <div class="row mb-3 col-12">
                        <div class="row mb-3">
                          <label for="firstname" class="col-md-4 col-lg-3 col-form-label">First Name</label>
                          <div class="col-md-8 col-lg-9">
                            <input name="firstname" type="text" class="form-control" id="firstname" value="<?=set_value('firstname',$row->firstname)?>">
                          </div>

                          <?php if(!empty($errors['firstname'])):?>
                            <small class="js-error-firstname text-danger"><?=$errors['firstname']?></small>
                          <?php endif;?>
                          <small class="js-error-firstname text-danger"></small>
                        </div>

                        <div class="row mb-3">
                          <label for="lastname" class="col-md-4 col-lg-3 col-form-label">Last Name</label>
                          <div class="col-md-8 col-lg-9">
                            <input name="lastname" type="text" class="form-control" id="lastname" value="<?=set_value('lastname',$row->lastname)?>">
                          </div>

                          <?php if(!empty($errors['lastname'])):?>
                            <small class="js-error-lastname text-danger"><?=$errors['lastname']?></small>
                          <?php endif;?>
                          <small class="js-error-lastname text-danger"></small>
                        </div>

                        <div class="row mb-3">
                          <label for="Job" class="col-md-4 col-lg-3 col-form-label">Job</label>
                          <div class="col-md-8 col-lg-9">
                            <input name="job" type="text" class="form-control" id="Job" value="<?=set_value('job',$row->job)?>">
                          </div>
                        </div>

                        <div class="row mb-3">
                          <label for="dob" class="col-md-4 col-lg-3 col-form-label">dob</label>
                          <div class="col-md-8 col-lg-9">
                            <input name="dob" type="date" class="form-control" id="dob" value="<?=set_value('dob',$row->dob)?>">
                          </div>

                          <?php if(!empty($errors['dob'])):?>
                            <small class="js-error-dob text-danger"><?=$errors['dob']?></small>
                          <?php endif;?>
                          <small class="js-error-dob text-danger"></small>
                        </div>

                        <div class="row mb-3">
                          <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                          <div class="col-md-8 col-lg-9">
                            <input name="phone" type="text" class="form-control" id="Phone" value="<?=set_value('phone',$row->phone)?>">
                          </div>

                          <?php if(!empty($errors['phone'])):?>
                            <small class="js-error-phone text-danger"><?=$errors['phone']?></small>
                          <?php endif;?>
                          <small class="js-error-phone text-danger"></small>
                        </div>

                        <div class="row mb-3">
                          <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                          <div class="col-md-8 col-lg-9">
                            <input name="email" type="email" class="form-control" id="Email" value="<?=set_value('email',$row->email)?>">
                          </div>

                          <?php if(!empty($errors['email'])):?>
                            <small class="js-error-email text-danger"><?=$errors['email']?></small>
                          <?php endif;?>
                          <small class="js-error-email text-danger"></small>
                        </div>

                        <div class="row mb-3">
                          <label for="residence" class="col-md-4 col-lg-3 col-form-label">Residence</label>
                          <div class="col-md-8 col-lg-9">
                            <input name="residence" type="text" class="form-control" id="residence" value="<?=set_value('residence',$row->residence)?>">
                          </div>

                          <?php if(!empty($errors['residence'])):?>
                            <small class="js-error-residence text-danger"><?=$errors['residence']?></small>
                          <?php endif;?>
                          <small class="js-error-residence text-danger"></small>
                        </div>

                        <div class="row mb-3">
                          <label for="hometown" class="col-md-4 col-lg-3 col-form-label">Hometown</label>
                          <div class="col-md-8 col-lg-9">
                            <input name="hometown" type="text" class="form-control" id="hometown" value="<?=set_value('hometown',$row->hometown)?>">
                          </div>

                          <?php if(!empty($errors['hometown'])):?>
                            <small class="js-error-hometown text-danger"><?=$errors['hometown']?></small>
                          <?php endif;?>
                          <small class="js-error-hometown text-danger"></small>
                        </div>

                        <div class="row mb-3">
                          <label for="MotherName" class="col-md-4 col-lg-3 col-form-label">Mother's Name</label>
                          <div class="col-md-8 col-lg-9">
                            <input name="mother_name" type="text" class="form-control" id="MotherName" value="<?=set_value('mother_name',$row->mother_name)?>">
                          </div>

                          <?php if(!empty($errors['mother_name'])):?>
                            <small class="js-error-mother_name text-danger"><?=$errors['mother_name']?></small>
                          <?php endif;?>
                          <small class="js-error-mother_name text-danger"></small>
                        </div>

                        <div class="row mb-3">
                          <label for="FatherName" class="col-md-4 col-lg-3 col-form-label">Father's Name</label>
                          <div class="col-md-8 col-lg-9">
                            <input name="father_name" type="text" class="form-control" id="FatherName" value="<?=set_value('father_name',$row->father_name)?>">
                          </div>

                          <?php if(!empty($errors['father_name'])):?>
                            <small class="js-error-father_name text-danger"><?=$errors['father_name']?></small>
                          <?php endif;?>
                          <small class="js-error-father_name text-danger"></small>
                        </div>

                        <br>
                          <h4>End of Personal details</h4>                  

                    <div class="js-prog progress my-4 hide">
                      <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">Saving.. 50%</div>
                    </div>
                    </div>

                    <div class="text-center">
                      <a href="<?=ROOT?>/admin/locals">
                        <button type="button" class="btn btn-primary  float-start">Back</button>
                      </a>
                      <button type="button" onclick="save_profile(event)" type="submit" class="btn btn-danger float-end">Save Changes</button>
                    </div>
                  </form><!-- End Profile Edit Form -->

                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
    </section>

  <?php else:?>

    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                That profile was not found!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>

  <?php endif;?>

<script>
  
  
  var tab = sessionStorage.getItem("tab") ? sessionStorage.getItem("tab"): "#profile-overview";

 /* function show_tab(tab_name)
  {
    const someTabTriggerEl = document.querySelector(tab_name +"-tab");
    const tab = new bootstrap.Tab(someTabTriggerEl);

    tab.show();

  }*/

  /*function set_tab(tab_name)
  {
    tab = tab_name;
    sessionStorage.setItem("tab", tab_name);
  }*/

  function load_image(file)
  {

    document.querySelector(".js-filename").innerHTML = "Selected File: " + file.name;

    var mylink = window.URL.createObjectURL(file);
    document.querySelector(".js-image-preview").src = mylink;
  }

  window.onload = function(){

    /*show_tab(tab);*/
  }

  //upload functions
  function save_profile(e)
  {

    var form = e.currentTarget.form;
    var inputs = form.querySelectorAll("input,textarea,select,radio");
    var obj = {};
    var image_added = false;

    for (var i = 0; i < inputs.length; i++) {
      var key = inputs[i].name;

      if(key == 'image'){
        if(typeof inputs[i].files[0] == 'object'){
          obj[key] = inputs[i].files[0];
          image_added = true;
        }
      }else{
        obj[key] = inputs[i].value;
      }
    }
 
    //validate image
    if(image_added){

      var allowed = ['jpg','jpeg','png'];
      if(typeof obj.image == 'object'){
        var ext = obj.image.name.split(".").pop();
      }

      if(!allowed.includes(ext.toLowerCase())){
        alert("Only these file types are allowed in profile image: "+ allowed.toString(","));
        return;
      }
    }

    send_data(obj);

  }

  function send_data(obj, progbar = 'js-prog')
  {

    var prog = document.querySelector("."+progbar);
    prog.children[0].style.width = "0%";
    prog.classList.remove("hide");

    var myform = new FormData();
    for(key in obj){
      myform.append(key,obj[key]); 
    }

    var ajax = new XMLHttpRequest();

    ajax.addEventListener('readystatechange',function(){

      if(ajax.readyState == 4){

        if(ajax.status == 200){
          //everything went well
          //alert("upload complete");
          handle_result(ajax.responseText);
        }else{
          //error
          alert("an error occurred");
        }
      }
    });

    ajax.upload.addEventListener('progress',function(e){

      var percent = Math.round((e.loaded / e.total) * 100);
      prog.children[0].style.width = percent + "%";
      prog.children[0].innerHTML = "Saving.. " + percent + "%";

    });

    ajax.open('post','',true);
    ajax.send(myform);

  }

  function handle_result(result)
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
        alert("Profile saved successfully!");
        window.location.reload();

      }
    }
  }

  function display_errors(errors){

    for(key in errors){

      document.querySelector(".js-error-"+key).innerHTML = errors[key];
    }
  }

</script>

<?php $this->view('admin/admin-footer',$data) ?>