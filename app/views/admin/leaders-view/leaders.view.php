
<section class="mt-2 pt-1">
<div class="container-fluid" data-aos="fade-up">

<div class="row g-5">
<div class="mt-3 row d-flex mx-0 justify-content-center table rounded shadow table py-3 " style="height:fit-content;">
<h4 class="text-muted border-bottom">ALL LEADERS IN <?=strtoupper(APP_NAME)?></h4>

<?php foreach($data['row'] as $row):?>

<?php if(!empty($row->position_id)):?>

<?php
    $mydob = get_date_month_day($row->dob);
    $today = date('m d');
  ?>
<div class="col py-2" style="">
<div class="container bg-secondary rounded shadow" style="width:160px; height: fit-content;">
<?php if($mydob ===$today):?>

    <div class="row justify-content-center rounded mb-0 pb-0  bg-info" style="width:157.5px;">
    <a href="<?=ROOT?>/admin/profile/<?=$row->id?>">
    <?php if(!empty($row->image)):?>              
    <img src="<?=get_profile_image($row->image)?>" class="w-100 rounded border mx-auto" style="object-fit: fill; width: 140px; max-width:140px;height:105px;">
    <?php elseif(!empty($row->gender)):?>
    <img src="<?=ROOT?>/assets/images/<?=($row->gender)?>.jpg" class="w-100 rounded border" style="object-fit: fill; width: 140px; max-width:140px;height:105px;">
    <?php else:?>
    <img src="<?=get_profile_image($row->image)?>" class="w-100 rounded border" style="object-fit: fill; width: 140px; max-width:140px;height:105px;">
    <?php endif;?>
    </a>
    <div class='badge'>      
      <div class="badge bg-light text-danger" href="#">Happy birthday <?=$row->firstname?></div>
      
    </div>
    </div>

  <?php else:?>

    <div class="row justify-content-center rounded mb-0 pb-0" style="width:157.5px;">
    <a href="<?=ROOT?>/admin/profile/<?=$row->id?>">
    <?php if(!empty($row->image)):?>              
    <img src="<?=get_profile_image($row->image)?>" class="w-100 rounded border mx-auto" style="object-fit: fill; width: 140px; max-width:140px;height:105px;">
    <?php elseif(!empty($row->gender)):?>
    <img src="<?=ROOT?>/assets/images/<?=($row->gender)?>.jpg" class="w-100 rounded border" style="object-fit: fill; width: 140px; max-width:140px;height:105px;">
    <?php else:?>
    <img src="<?=get_profile_image($row->image)?>" class="w-100 rounded border" style="object-fit: fill; width: 140px; max-width:140px;height:105px;">
    <?php endif;?>
    </a>
    </div>
  <?php endif;?>
<div class="row bg-dark text-white px-3 text-wrap rounded mb-0 pb-4" style="width:160px; height: 100px;">
<div class="text-center fw-bolder px-0 mx-0 mb-0 pb-0" style="font-size:11px"><b><?=ucfirst(substr($row->firstname ?? '',0,1))?>. <?=$row->lastname ?? ''?></b>
<div><span class="fst-italic text-muted">(<?=ucfirst($row->role_name ?? '')?>) - <?=$row->category_id ?? 'Unknown'?></span></div></div>
<div class="text-center small text-warning" style="font-size: 10px;"><b><?=$row->position_id ?? ''?></b><br>
<u class="text-danger fw-bolder fst-italic"><?=$row->phone ? :'Unknown contact'?></u><br>
</div>

<div class="text-center fw-bolder px-0 mx-0 text-light" style="font-size:9px;">

<span class="social float-end mb-3">
<a href="<?=ROOT?>/admin/profile/<?=$row->id?>">
  <i class="bi bi-eye-fill text-light py-0 px-1"></i>
</a>
<?php if(user_can('edit_slider_images')):?>
<a href="<?=ROOT?>/admin/profile/<?=$row->id?>">
  <i class="bi bi-pencil-fill text-light py-0 px-1 "></i>
</a>
<a href="<?=ROOT?>/admin/delete/<?=$row->id?>">
  <i class="bi bi-trash-fill text-danger"></i>
</a>
<?php endif;?>
</span>

</div>

</div>  
</div>  
    
</div>
<?php endif;?>
<?php endforeach;?>

</div>
   
</div>
</div>
</section>