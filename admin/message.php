<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
<?php
if(isset($_SESSION['message'])){
    ?>  
    <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            
            
        <?php 
            if($_SESSION['message_type'] == "warning"){
                ?><img src="..." class="rounded me-2" alt="..."><?php    
            }
            if($_SESSION['message_type'] == "success"){
                ?><img src="..." class="rounded me-2" alt="..."><?php    
            }
            if($_SESSION['message_type'] == "primary"){
                ?><img src="..." class="rounded me-2" alt="..."><?php    
            }
            if($_SESSION['message_type'] == "danger"){
                ?><img src="..." class="rounded me-2" alt="..."><?php    
            }
            if($_SESSION['message_type'] == "info"){
                ?><img src="..." class="rounded me-2" alt="..."><?php    
            }
        ?>
        <strong class="me-auto">Bootstrap</strong>
            <small>11 mins ago</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
            <div class="toast-body">
                <strong> <?= $_SESSION['message']; ?> </strong> 
            </div>
        </div>
    <?php
    unset($_SESSION['message']);
    unset($_SESSION['message_type']);
}
?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
<script>

// window.setTimeout(function() {
//     $(".alert").fadeTo(500, 0).slideUp(500, function(){
//         $(this).remove(); 
//     });
// }, 3000);
    $(document).ready(function(){
        var toastElList = [].slice.call(document.querySelectorAll('.toast'))
        var toastList = toastElList.map(function (toastEl) {
        return new bootstrap.Toast(toastEl, option)
        })
    });
    

</script>

