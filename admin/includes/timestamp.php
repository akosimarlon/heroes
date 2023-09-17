<?php
    include('timezone.php');
?>  
    <p class="text-center">
    <span style="font-size: 17px; font-weight: normal;">
        <!-- <i class="fas fa-clock fa-sm text-dark-50"></i>  -->
        <span><?php echo $timestamp = date("h:i:s"); ?></span>
        <span><?php echo $timestamp = date("A"); ?></span>
        <span>|</span>
        <!-- <i class="fas fa-calendar fa-sm text-dark-50"></i>  -->
        <span><?php echo $timestamp = date("l, d F Y"); ?> </span> 
    </span>
    </p>
<?php
    //echo $timestamp = "<big><b>".date("h:i:s A")."</b></big>"; 
    //echo $timestamp = "</br>";
    //echo $timestamp = date("l, d F Y");
?>