<?php $this->view('admin/admin-header',$data) ?>

 <?php
  use \Model\Auth;
  $categories = get_categories();
  $app = get_app_details();

?>

  
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-6 col-md-10 d-flex flex-column align-items-center justify-content-center">

          <div class="d-flex justify-content-center py-4">
            <?php if($app):?>
            <?php foreach($app as $row):?>
            <a href="<?=ROOT?>" class="logo d-flex align-items-center w-auto">
              <img src="<?=get_image($row->image)?>" alt="">
              <span class="mb-0" >||<?=$row->appname?></span>
            </a>
          <?php endforeach;?>
          <?php else:?>
            <a href="<?=ROOT?>" class="logo d-flex align-items-center w-auto">
              <img src="<?=ROOT?>/assets/images/cop logo.png" alt="">
              <span class="mb-0" >||<?=APP_NAME?></span>
            </a>
          <?php endif;?>
          </div><!-- End Logo -->

          <div class="card mb-5 p-3">

            <div class="card-body">

              <div class="pt-2 pb-2">
                <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                <p class="text-center small">Enter your personal details to create account</p>
              </div>

              <form method="post" class="row g-3 needs-validation" novalidate>
                <div class="col-lg-6">
                  <label for="firstname" class="form-label">First Name</label>
                  <input value="<?=set_value('firstname')?>" type="text" name="firstname" class="form-control <?=!empty($errors['firstname']) ? 'border-danger':'';?>" id="firstname" required>
                  <div class="invalid-feedback">Please, enter your first name!</div>
                  <?php if (!empty($errors['firstname'])):?>
                    <div class="text-danger"><small><?=$errors['firstname']?></small></div>
                  <?php endif;?>
                </div>

                <div class="col-lg-6">
                  <label for="lastname" class="form-label">Last Name</label>
                  <input value="<?=set_value('lastname')?>" type="text" name="lastname" class="form-control <?=!empty($errors['lastname']) ? 'border-danger':'';?>" id="lastname" required>
                  <div class="invalid-feedback">Please, enter your last name!</div>
                  <?php if (!empty($errors['lastname'])):?>
                    <div class="text-danger"><small><?=$errors['lastname']?></small></div>
                  <?php endif;?>
                </div>

                <div class="col-12">
                  <label for="youremail" class="form-label">Email</label>
                  <div class="input-group has-validation">
                    <span class="input-group-text" id="inputGroupPrepend">@</span>
                    <input value="<?=set_value('email')?>" type="email" name="email" class="form-control <?=!empty($errors['email']) ? 'border-danger':'';?>" id="youremail" required>
                    <div class="invalid-feedback">Please enter a valid email.</div>
                  </div>
                    <?php if (!empty($errors['email'])):?>
                    <div class="text-danger"><small><?=$errors['email']?></small></div>
                  <?php endif;?>
                </div>

                <!-- <div class="col-6">
                  <label for="yourPassword" class="form-label">Password</label>
                  <div class="input-group has-validation">
                    <i class="bx bx-lock input-group-text fs-4" id="inputGroupPrepend"></i>
                  <input value="<?=set_value('password')?>" type="password" name="password" class="form-control <?=!empty($errors['password']) ? 'border-danger':'';?>" id="yourPassword" required>
                  <div class="invalid-feedback">Please enter your password!</div>
                </div>
              </div>

              <div class="col-6">
                  <label for="yourPassword" class="form-label">Retype Password</label>
                  <div class="input-group has-validation">
                    <i class="bx bx-lock input-group-text fs-4" id="inputGroupPrepend"></i>
                  <input value="<?=set_value('retype_password')?>" type="password" name="retype_password" class="form-control <?=!empty($errors['password']) ? 'border-danger':'';?>" id="yourPassword" required>
                  <div class="invalid-feedback">Please retype your password!</div>
                </div>
                <?php if (!empty($errors['password'])):?>
                    <div class="text-danger"><small><?=$errors['password']?></small></div>
                  <?php endif;?>
              </div> -->

              <div class="col-6">
                  <label for="phone" class="form-label">Phone Number</label>
                  <div class="input-group has-validation">
                    <i class="bx bx-phone input-group-text fs-4" id="inputGroupPrepend"></i>
                  <input value="<?=set_value('phone')?>" type="text" name="phone" class="form-control <?=!empty($errors['phone']) ? 'border-danger':'';?>" id="phone" required>
                  <div class="invalid-feedback">Please retype your phone!</div>
                </div>
                <?php if (!empty($errors['phone'])):?>
                    <div class="text-danger"><small><?=$errors['phone']?></small></div>
                  <?php endif;?>
              </div>

              <div class="col-6 ">
                  <label for="yourPassword" class="form-label">Gender</label>
                  <div class="input-group has-validation">
                    <i class="bi bi-gender-ambiguous input-group-text fs-4" id="inputGroupPrepend"></i>
                    <select <?=set_value('gender')?> class="form-select <?=!empty($errors['gender']) ? 'border-danger':'';?>" name="gender"  required>
                      <option value="">--Select Gender--</option>
                      <option value="female" <?=set_value('gender') == 'female' ? 'selected' : '' ?> >female</option>
                      <option value="male" <?=set_value('gender') == 'male' ? 'selected' : '' ?>>male</option>
                    </select>
                    <div class="invalid-feedback">Gender is required.</div>
                </div>                
                <?php if (!empty($errors['gender'])):?>
                    <div class="text-danger"><small><?=$errors['gender']?></small></div>
                  <?php endif;?>
              </div>

              <div class="col-6 ">
                  <label for="yourPassword" class="form-label">Marital Status</label>
                  <div class="input-group has-validation">
                    <i class="bi bi-gender-ambiguous input-group-text fs-4" id="inputGroupPrepend"></i>
                    <select <?=set_value('marital_status_id')?> class="form-select <?=!empty($errors['marital_status_id']) ? 'border-danger':'';?>" name="marital_status_id"  required>
                      <option value="">--Select Marital Status--</option>
                      <option value="single">single</option>
                      <option value="married">married</option>
                      <option value="complicated">complicated</option>
                      <option value="widowed">widowed</option>
                      <option value="divorced">divorced</option>
                    </select>                    
                    <div class="invalid-feedback">Marital Status is required.</div>
                </div>                
                <?php if (!empty($errors['marital_status_id'])):?>
                    <div class="text-danger"><small><?=$errors['marital_status_id']?></small></div>
                  <?php endif;?>
              </div>

              <div class="col-6">
                  <label for="yourDateofBirth" class="form-label">Date of Birth</label>
                  <div class="input-group has-validation">
                    <i class="bx bx-calendar input-group-text fs-4" id="inputGroupPrepend"></i>
                  <input value="<?=set_value('dob')?>" type="date" name="dob" class="form-control <?=!empty($errors['dob']) ? 'border-danger':'';?>" id="dob" required>
                  <div class="invalid-feedback">Please enter your dob!</div>
                </div>
                <?php if (!empty($errors['dob'])):?>
                    <div class="text-danger"><small><?=$errors['dob']?></small></div>
                  <?php endif;?>
              </div>

              <div class="col-12 ">
                <label for="Gender" class="form-label">Local Assembly</label>
                <div class="input-group has-validation">
                    <select name="category_id" id="inputState" class="form-select <?=!empty($errors['category_id']) ? 'border-danger':'';?>">
                      
                      <option value="" selected="">---Select Assembly---</option>
                      <?php if(!empty($categories)):?>
                        <?php foreach($categories as $cat):?>
                          <option <?=set_select('category_id',$cat->category)?> value="<?=$cat->category?>"><?=esc($cat->category)?></option>
                        <?php endforeach;?>
                      <?php endif;?>

                    </select>

                    <?php if(!empty($errors['category_id'])):?>
                      <small class="text-danger"><?=$errors['category_id']?></small>
                    <?php endif;?>
                  <div class="invalid-feedback">Category is required.</div>
                </div>
                </div>

              <div class="col-12">
                  <label for="residence" class="form-label">Residencial Address</label>
                  <div class="input-group has-validation">
                    <i class="bx bxs-map input-group-text fs-4" id="inputGroupPrepend"></i>
                  <input value="<?=set_value('residence')?>" type="text" name="residence" class="form-control <?=!empty($errors['residence']) ? 'border-danger':'';?>" id="residence" required>
                  <div class="invalid-feedback">Please enter your residence location!</div>
                </div>
                <?php if (!empty($errors['job'])):?>
                    <div class="text-danger"><small><?=$errors['job']?></small></div>
                  <?php endif;?>
              </div>


              <div class="col-6">
                  <label for="hometown" class="form-label">Home Town</label>
                  <div class="input-group has-validation">
                    <i class="bx bxs-map input-group-text fs-4" id="inputGroupPrepend"></i>
                  <input value="<?=set_value('hometown')?>" type="text" name="hometown" class="form-control <?=!empty($errors['hometown']) ? 'border-danger':'';?>" id="hometown" required>
                  <div class="invalid-feedback">Please enter your hometown location!</div>
                </div>
                <?php if (!empty($errors['hometown'])):?>
                    <div class="text-danger"><small><?=$errors['hometown']?></small></div>
                  <?php endif;?>
              </div>

              <div class="col-6">
                  <label for="job" class="form-label">Occupation</label>
                  <div class="input-group has-validation">
                    <i class="bx bx-briefcase input-group-text fs-4" id="inputGroupPrepend"></i>
                  <input value="<?=set_value('job')?>" type="text" name="job" class="form-control <?=!empty($errors['job']) ? 'border-danger':'';?>" id="job" required>
                  <div class="invalid-feedback">Please enter your job/occupation!</div>
                </div>
                <?php if (!empty($errors['job'])):?>
                    <div class="text-danger"><small><?=$errors['job']?></small></div>
                  <?php endif;?>
              </div>

              <div class="col-6">
                  <label for="father_name" class="form-label">Father's Name</label>
                  <div class="input-group has-validation">
                    <i class="bx bx-male input-group-text fs-4" id="inputGroupPrepend"></i>
                  <input value="<?=set_value('father_name')?>" type="text" name="father_name" class="form-control <?=!empty($errors['father_name']) ? 'border-danger':'';?>" id="father_name" required>
                  <div class="invalid-feedback">Please enter father's name!</div>
                </div>
                <?php if (!empty($errors['father_name'])):?>
                    <div class="text-danger"><small><?=$errors['father_name']?></small></div>
                  <?php endif;?>
              </div>

              <div class="col-6">
                  <label for="father_phone" class="form-label">Father's Phone</label>
                  <div class="input-group has-validation">
                    <i class="bx bx-phone input-group-text fs-4" id="inputGroupPrepend"></i>
                  <input value="<?=set_value('father_phone')?>" type="text" name="father_phone" class="form-control <?=!empty($errors['father_phone']) ? 'border-danger':'';?>" id="father_phone">
                  <div class="invalid-feedback">Please enter father's phone!</div>
                </div>
                <?php if (!empty($errors['father_phone'])):?>
                    <div class="text-danger"><small><?=$errors['father_phone']?></small></div>
                  <?php endif;?>
              </div>

              <div class="col-6">
                  <label for="mother_name" class="form-label">Mother's Name</label>
                  <div class="input-group has-validation">
                    <i class="bx bx-female input-group-text fs-4" id="inputGroupPrepend"></i>
                  <input value="<?=set_value('mother_name')?>" type="text" name="mother_name" class="form-control <?=!empty($errors['mother_name']) ? 'border-danger':'';?>" id="mother_name" required>
                  <div class="invalid-feedback">Please enter mother's name!</div>
                </div>
                <?php if (!empty($errors['mother_name'])):?>
                    <div class="text-danger"><small><?=$errors['mother_name']?></small></div>
                  <?php endif;?>
              </div>



              <div class="col-6">
                  <label for="mother_phone" class="form-label">Mother's Phone</label>
                  <div class="input-group has-validation">
                    <i class="bx bx-phone input-group-text fs-4" id="inputGroupPrepend"></i>
                  <input value="<?=set_value('mother_phone')?>" type="text" name="mother_phone" class="form-control <?=!empty($errors['mother_phone']) ? 'border-danger':'';?>" id="mother_phone">
                  <div class="invalid-feedback">Please enter Mother's name!</div>
                </div>
                <?php if (!empty($errors['mother_phone'])):?>
                    <div class="text-danger"><small><?=$errors['mother_phone']?></small></div>
                  <?php endif;?>
              </div>

                <div class="col-6 my-3">
                  <label for="residence" class="form-label">Role</label>
                  <select name="role" class="form-select" required>
                    <option value="">--Select Role--</option>
                <?php if(user_can('edit_slider_images')):?>
                    <option value="1">user</option>
                    <option value="2">admin</option>              
                    <option value="5">elder</option>              
                    <option value="6">deaconess</option>              
                    <option value="7">deacon</option>
                <?php endif;?>
                    <option value="4">member</option>              
                    <option value="8">child</option>              
                    <option value="9">visitor</option>              
                  </select>
                  <small class="error error-role_name w-100 text-danger"></small>
                </div>

                <div class="col-6 my-3">
                  <label for="position_id" class="form-label">Position</label>
                  <select name="position_id" class="form-select">
                    <option value="">--Select Position--</option>
                    <option value="Local Presiding">Local Presiding</option>
                    <option value="Local Secretary">Local Secretary</option>
                    <option value="Youth Ldr.">Youth Ldr.</option>              
                    <option value="Women's Ldr.">Women's Ldr.</option>              
                    <option value="PEMEM Leader">PEMEM Leader</option>              
                    <option value="Evg. Ministry Ldr.">Evg. Ministry Ldr.</option>              
                    <option value="CM Leader">CM Leader</option>             
                    <option value="HUM Coordi.">Hum Coordi.</option>              
                    <option value="Teens Coordi.">Teens Coordi.</option>       
                    <option value="SoM Coordi.">SoM Coordi.</option>       
                    <option value="MPWDs Coordi.">MPWDs Coordi.</option>       
                    <option value="Chaplaincy Coordi.">Chaplaincy Coordi.</option>       
                    <option value="Follow-Up Coordi.">Follow-Up Coordi.</option>       
                  </select>
                  <small class="error error-role_name w-100 text-danger"></small>
                </div>

                <div class="col-12 mb-3">
                  <div class="form-check">
                    <input <?=set_value('terms') ? 'checked':'' ?> class="form-check-input  <?=!empty($errors['terms']) ? 'border-danger':'';?>" name="terms" type="checkbox" value="1" id="acceptTerms" required>
                    <label class="form-check-label " for="acceptTerms">I agree and accept the <a href="#">terms and conditions</a></label>
                    <div class="invalid-feedback">You must agree before submitting.</div>
                  </div>
                  <?php if (!empty($errors['terms'])):?>
                    <div class="text-danger"><small><?=$errors['terms']?></small></div>
                  <?php endif;?>
                </div>
          
            <div class="col-12 my-3 text-center">
              <p class="small mb-0">Already have an account? <a href="<?=ROOT?>/login">Login</a></p>
            </div>

              <div class="row justify-content-center">
                <div class="col-4 ">
                <button class="btn btn-primary w-100" type="submit">Submit</button>
              </div>
              </div>
          </form>  

              <center class="my-2 w-100">
                <a href="<?=ROOT?>/admin/users">
                <button class="btn btn-danger ">Cancel</button></a>
              </center>              
            </div>
          </div>
        </div>
      </div>          
    </div>
<?php $this->view('admin/admin-footer',$data) ?>