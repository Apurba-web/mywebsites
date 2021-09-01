<!DOCTYPE html>
<html lang="en">
<head>
<body>
  <table id="main" border="0" cellspacing="0">
    <tr>
      <td id="header">
        <h1>PHP with Ajax</h1>
      </td>
    </tr>
    <tr>
      <td id="table-load">
        <input type="button" id="load-button" value="Load Date">
      </td>
    </tr>
    <tr>
      <td id="table-data">
        <table border="1" width="100%" cellspacing="0" cellpadding="10ox">
          <tr>
            <th>GRN</th>
            <th>Name</th>
          </tr>
          <tr>
            <td allign="centre">1</td>
            <td>Test Data</td>
          </tr>
        </table>
      </td>
    </tr>
  </table>

  <script type="text/javascript" src = "../js/jquery.js"></script>

  <script type="text/javascript">

          $(document).ready(function(){
            $("#load-button").on("click",function(e){
                $.ajax({
                  url : "ajax-load.php",
                  type : "POST",
                  success : function(data){
                    $("#table-data").html(data);
                  }
                });
            });
          });
  </script>
  
</body>
</head>
