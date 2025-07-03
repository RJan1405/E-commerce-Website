
$(document).ready(function (){
    $('.delete_product_btn').click(function (e) { 
        e.preventDefault();

        // Get the product ID from the button's value
        var id = $(this).val();  
        // Now you can implement your delete logic here, e.g., showing a confirmation dialog
       //alert(id);

        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              $.ajax({
                method: "POST",
                url: "code.php",
                data: {
                    'product_id':id,
                    'delete_product_btn':true
                },
               
                success: function (response) {
                  
                    if(response == 200){

                        
                        swal("Success!", "Product deleted Successfully!", "success");
                        $("#products_table").load(location.href + " #products_table");
                    }
                    else if(response==500){

                        swal("Error!", "Something went wrong!", "error");

                    }
                    
                }
              });
            } 
          }); 
         
    });
    $('.delete_category_btn').click(function (e) { 
      e.preventDefault();

      // Get the product ID from the button's value
      var id = $(this).val();  
      // Now you can implement your delete logic here, e.g., showing a confirmation dialog
     //alert(id);

      swal({
          title: "Are you sure?",
          text: "Once deleted, you will not be able to recover",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            $.ajax({
              method: "POST",
              url: "code.php",
              data: {
                  'category_id':id,
                  'delete_category_btn':true
              },
             
              success: function (response) {
                
                  if(response == 200){

                      
                      swal("Success!", "Category deleted Successfully!", "success");
                      $("#category_table").load(location.href + " #category_table");
                  }
                  else if(response==500){

                      swal("Error!", "Something went wrong!", "error");

                  }
                  
              }
            });
          } 
        }); 
       
  });
});
