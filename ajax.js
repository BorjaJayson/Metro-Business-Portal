$(document).ready(function() {
  
  $("#tob").change(function() {
    
    var maincat_ID = $(this).val();
    
    if(maincat_ID != "") {
      
      $.ajax({
        
        url:"get-cat.php",
        data:{c_id:maincat_ID},
        type:'POST',
        
        success:function(response) {
          
          var resp = $.trim(response);
          $("#bsc").html(resp);
        }
      });
    } else {
      
      $("#bsc").html("<option value=''> -- Select -- </option>");
    
    }
  });
});

$(document).ready(function() {
  
  $("#etob").change(function() {
    
    var maincat_ID = $(this).val();
    
    if(maincat_ID != "") {
      
      $.ajax({
        
        url:"get-cat.php",
        data:{c_id:maincat_ID},
        type:'POST',
        
        success:function(response) {
          
          var resp = $.trim(response);
          $("#ebsc").html(resp);
        }
      });
    } else {
      
      $("#ebsc").html("<option value=''> -- Select -- </option>");
    
    }
  });
});