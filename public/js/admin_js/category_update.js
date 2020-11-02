$(".updateCategoryStatus").click(function(){
    var status = $(this).text();
    var categoryId = $(this).attr('category_id');
    $.ajax({
        type:'post',
        url:'update-category-status',
        data:{
            _token: $('meta[name="csrf-token"]').attr('content'),
            status:status,
            category_id:categoryId
        },
        success:function(resp){
            console.log(resp); 
            if(resp['status']==0){
                $("#category-"+categoryId).html('<a class="updateCategoryStatus" id="category-'+categoryId+'" href="javascript:void(0)" category_id="'+categoryId+'">Inactive</a>');
            }
            if(resp['status']==1){
                $("#category-"+categoryId).html('<a class="updateCategoryStatus" id="category-'+categoryId+'" href="javascript:void(0)" category_id="'+categoryId+'">Active</a>');
            }
        },error:function(err){
            console.error(err);
        }
    });
});