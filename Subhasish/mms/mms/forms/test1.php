
<style>
.table{width: 1000px;height: 200px;border-collapse:collapse;}
.table th { background-color:#000;color:white;width:50%; }
.table td, .table th { width:100px;padding:5px;border:1px solid #000; }
.table-wrap{max-height:200;width:100%;overflow-y:auto;overflow-x:hidden;}
.table-dalam{height:300px;width:100%;border-collapse:collapse;}
.td-nya{width: 100%;border-left:1px solid white;border-right:1px solid grey;border-bottom:1px solid grey;}

</style>

<table class="table">
 <thead>
    <tr>
    <th>Judul1</th>
    <th>Judul2</th>
    <th>Judul3</th>
    <th>Judul4</th>
    </tr>
 </thead>
 <tbody>
  <tr>
   <td colspan="4">
    <div class="table-wrap" >
    <table class="table-dalam">
  <tbody>
  <?php foreach(range(1,10) as $i): ?>
   <tr >
   <td class="td-nya">td1</td>
   <td class="td-nya">td2</td>
   <td class="td-nya">td3</td>
   <td class="td-nya">td4</td>
   </tr>
  <?php endforeach;?>

  </tbody>
    </table>
    </div>
   </td>
  </tr>
 </tbody>
</table>
