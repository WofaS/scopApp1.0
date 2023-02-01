<?php

use model\Auth;
  $categories = get_categories();
  $members = get_members();

  $current_month_day=date("m-d");
  $current_month=date("m");

  $birthdays= "select count(id) as num from members where date_format(dob, '%m-%d')='{$current_month_day}'";
  $birthdaysToday = query_row($birthdays);

  $birthdays_Coming="select count(id) as num from members where date_format(dob, '%m') = '{$current_month}' AND date_format(dob, '%m-%d') > '{$current_month_day}'";
  $birthdaysToCome = query_row($birthdays_Coming);

  $current_month_day=date("m-d");
  $birthdays="select count(id) as num from members where date_format(dob, '%m-%d')='{$current_month_day}'";
  $birthdaysToday = query_row($birthdays);

  
  $queryAllMembers = "select count(id) as num from members where disabled = '0'";
  $resAllMembers = query_row($queryAllMembers);

  $querySingle = "select count(id) as num from members where marital_status_id = 'Single'";
  $resSingle = query_row($querySingle);
  
  $queryMarried = "select count(id) as num from members where marital_status_id = 'Married'";
  $resMarried = query_row($queryMarried);

  $queryWidowed = "select count(id) as num from members where marital_status_id = 'Widowed'";
  $resWidowed = query_row($queryWidowed);

  $queryDivorced = "select count(id) as num from members where marital_status_id = 'Divorced'";
  $resDivorced = query_row($queryDivorced);

  $queryMale = "select count(id) as num from members where gender = 'male'";
  $resMale = query_row($queryMale);
  
  $queryMaleChild = "select count(id) as num from members where role = '8' AND gender = 'male'";
  $resMaleChild = query_row($queryMaleChild);

  $resMaleAdult = $resMale['num'] - $resMaleChild['num'];

  $queryFemale = "select count(id) as num from members where gender = 'female'";
  $resFemale = query_row($queryFemale);

  $queryFemaleChild = "select count(id) as num from members where role = '8' AND gender = 'female'";
  $resFemaleChild = query_row($queryFemaleChild);

  $resFemaleAdult = $resFemale['num'] - $resFemaleChild['num'];

  //usrs count
  $queryUsers = "select count(id) as num from members where role = '1'";
  $resUsers = query_row($queryUsers);

  //admin count
  $queryAdmin = "select count(id) as num from admin where role = '2'";
  $resAdmin = query_row($queryAdmin);

  //child count
  
  $queryMember = "select count(id) as num from members where role = '3'";
  $resMember = query_row($queryMember);

  $query1 = "select count(id) as num from members where category_id = '1'";
  $res1 = query_row($query1);



  $query2 = "select count(id) as num from members where category_id = '2'";
  $res2 = query_row($query2);

  $query6 = "select count(id) as num from members where category_id = '6'";
  $res6 = query_row($query6);

  $query7 = "select count(id) as num from members where category_id = '7'";
  $res7 = query_row($query7);

  $query8 = "select count(id) as num from members where category_id = 'Duadaso No.1'";
  $res8 = query_row($query8);

  $query9 = "select count(id) as num from members where category_id = 'Duadaso No.2'";
  $res9 = query_row($query9);

  $query10 = "select count(id) as num from members where category_id = '10'";
  $res10 = query_row($query10);

  $query1 = "select count(id) as num from members where category_id = '1'";
  $res1 = query_row($query1);

  $query3 = "select count(id) as num from members where category_id = '3'";
  $res3 = query_row($query3);

  $query4 = "select count(id) as num from members where category_id = '4'";
  $res4 = query_row($query4);

  $query5 = "select count(id) as num from members where category_id = '5'";
  $res5 = query_row($query5);

  $query11 = "select count(id) as num from members where category_id = '11'";
  $res11 = query_row($query11);

  $query12 = "select count(id) as num from members where category_id = '12'";
  $res12 = query_row($query12);

  $query14 = "select count(id) as num from members where category_id = '14'";
  $res14 = query_row($query14);
  
  $query13 = "select count(id) as num from members where category_id = '13'";
  $res13 = query_row($query13);

  $query15 = "select count(id) as num from members where category_id = '15'";
  $res15 = query_row($query15);

  $query16 = "select count(id) as num from members where category_id = '16'";
  $res16 = query_row($query16);
  

  $registered_thismonth="select count(id) as num from members where date_format(date, '%m') = '{$current_month}' ";
  $total_Registered_This_Month = query_row($registered_thismonth);

  