<?php
    require 'layouts/header.php';
    
   //  require "js/tasks_api.js";
?>
<!-- <script src=" ../js/projects_api.js"></script> -->
<script src="../js/projects_manager.js"></script>

<div id="left_block">
   <div id="search_select">
      <div id="create_something" onclick="modal_create_project()">
      <div class="create"><img src="/img/group 189.svg" alt=""></div>
   </div>
      <form action="">
         <select name="" id="">
            <option value="">Статус</option>
            <option value="">Создан</option>
            <option value="">В процессе</option>
            <option value="">Завершен</option>
         </select>
      </form>
   </div>

   
   
   <div id="infoRows" class="scroll_div">
        
   </div>
   <div class="hv2vx"></div>   
   <div id="paginate">
      
   </div> 
</div>
<script>
   // if(sessionStorage.getItem('role') != 'admin'){
   //    location.href = sessionStorage.getItem('role')+'tasks.php';
   // }
</script>
<script src="../js/script.js"></script>
</body>
</html>