<?php
if(isset($_SESSION['message'])){
    ?>  
        <?php 
            if($_SESSION['message_type'] == "warning"){
                ?><div class="alert alert-warning alert-dismissible fade show" role="alert"><?php    
            }
            if($_SESSION['message_type'] == "success"){
                ?><div class="alert alert-success alert-dismissible fade show" role="alert"><?php    
            }
            if($_SESSION['message_type'] == "primary"){
                ?><div class="alert alert-primary alert-dismissible fade show" role="alert"><?php    
            }
            if($_SESSION['message_type'] == "danger"){
                ?><div class="alert alert-danger alert-dismissible fade show" role="alert"><?php    
            }
            if($_SESSION['message_type'] == "info"){
                ?><div class="alert alert-info alert-dismissible fade show" role="alert"><?php    
            }
        ?>
        <strong>Hey!</strong> <?= $_SESSION['message']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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
