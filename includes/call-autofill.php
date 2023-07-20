<!-- Call List Autofill jQuery -->
<script type="text/javascript">
   $(document).ready(function(){
        $('#p_number').on('blur',function(){
            var number = $('#p_number').val();
            var entry_by = '<?php echo $_SESSION['userRel']; ?>';
            $.post('includes/call-autofill-num.php',{number: number,entry_by:entry_by}, function(data){
                let rish = JSON.parse(data);

                if(rish.result == 1){
                    $('#p_name').val(rish.name);
                    if(rish.job_role!=""){
                        $("#job_role option[value='"+rish.job_role+"']").attr("selected","selected");
                    }
                    $("#p_type option[value='"+rish.type+"']").attr("selected","selected");
                }
            });
            
        })
   });
</script>