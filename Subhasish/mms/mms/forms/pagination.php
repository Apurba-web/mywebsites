<?php

$host = "127.0.0.1";
$user = "admin";
$pwd="mc211196";
$dbname="mms";

$conn = mysqli_connect($host, $user, $pwd, $dbname) or die("Connection Failed");

$limit = 4;
$page = 0;
$output = '';

if(isset($_POST['page_no'])){
  $page = $_POST['page_no'];
 }else {
  $page = 1;
 }

 $start_from = ($page - 1) * $limit;
$query=  mysqli_query($conn,"SELECT GRN,i_name,s_name FROM GRNDETAILS ORDER BY GRN LIMIT $start_from , $limit ") or die("SQL Query Failed.");


$output .= '

<div class="c12-l-12 center">

  <table class = "table" width = 100%>';

   if (mysqli_num_rows($query) > 0) {
     while($row = mysqli_fetch_assoc($query)) {
     $output .= '
     <tr>
       <td style="width:15%">'.($row['GRN']).'</td>
       <td style="width:37%">'.($row['i_name']).'</td>
       <td style="width:40%">'.($row['s_name']).'</td>
       <td><a href="GRUpdate.php?id='.([$row]['GRN']).'data-toggle="tooltip" data-placement="top" title="Update">Edit</a></td>
       <td><a href="GRDelete.php?id='.([$row]['GRN']).'data-toggle="tooltip" data-placement="top" title="Trash">Delete</a></td>
      </tr>
     ';
    }
  } else {
    $outupt .= '<td> Data Not Found </td>';
  }
  $output .= '</table></div>';
  $output .= '<div class="c12-l-12 center">';

  //pagination
  $query=  mysqli_query($conn,"SELECT * FROM GRNDETAILS");
  $total_records = mysqli_num_rows($query);
  $total_pages = ceil($total_records/$limit);

  $output .= '<ul class = "pagination">';

  if($page > 1){
    $previous = $page - 1;
    $output .= '<li class = "page-item" id="1"><span class="page-link">First Page</span></li>';
    $output .= '<li class = "page-item" id="'.$previous.'"><span class="page-link"><i class="fa fa-arrow-left"></i></span></li>';
  }

  for($i=1; $i<=$total_pages; $i++){
    $active_class = "";
    if($i == $page){
      $active_class = "active";
    } else {
      $active_class = "";
    }
    $output .= '<li class="page-item '.$active_class.'" id="'.$i.'"><span class="page-link">'.$i.'</span></li>';
  }

  if($page < $total_pages){
    $page++;
    $output .= '<li class="page-item" id="'.$page.'"><span class="page-link"><i class="fa fa-arrow-right"></i></span></li>';
    $output .= '<li class="page-item" id="'.$total_pages.'"><span class="page-link">Last Page</span></li>';
  }

  $output .= '</ul></div>';

  echo $output;

  //<div class="table-responsive">

 ?>
