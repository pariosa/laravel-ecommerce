$(".updateSectionStatus").click(function(){
    var status = $(this).text();
    var sectionId = $(this).attr('section_id');
    $.ajax({
        type:'post',
        url:'update-section-status',
        data:{
            _token: $('meta[name="csrf-token"]').attr('content'),
            status:status,
            section_id:sectionId
        },
        success:function(resp){
            console.log(resp); 
            if(resp['status']==0){
                $("#section-"+sectionId).html('<a class="updateSectionStatus" id="section-'+sectionId+'" href="javascript:void(0)" section_id="'+sectionId+'">Inactive</a>');
            }
            if(resp['status']==1){
                $("#section-"+sectionId).html('<a class="updateSectionStatus" id="section-'+sectionId+'" href="javascript:void(0)" section_id="'+sectionId+'">Active</a>');
            }
        },error:function(err){
            console.error(err);
        }
    });
});