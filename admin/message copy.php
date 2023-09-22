<?php
if(isset($_SESSION['message'])){
    ?>  
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <?php 
            if($_SESSION['message_type'] == "warning"){
                ?><div class="toast align-items-center text-white bg-warning border-0" role="alert" aria-live="assertive" aria-atomic="true"><?php    
            }
            if($_SESSION['message_type'] == "success"){
                ?><div class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true"><?php    
            }
            if($_SESSION['message_type'] == "primary"){
                ?><div class="toast align-items-center text-white bg-primary border-0" role="alert" aria-live="assertive" aria-atomic="true"><?php    
            }
            if($_SESSION['message_type'] == "danger"){
                ?><div class="toast align-items-center text-white bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true"><?php    
            }
            if($_SESSION['message_type'] == "info"){
                ?><div class="toast align-items-center text-white bg-info border-0" role="alert" aria-live="assertive" aria-atomic="true"><?php    
            }
        ?>
            <div class="d-flex">
                <div class="toast-body">
                    <strong> <?= $_SESSION['message']; ?> </strong> 
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
    <?php
    unset($_SESSION['message']);
    unset($_SESSION['message_type']);
}
?>

<script>

window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 3000);

</script>




