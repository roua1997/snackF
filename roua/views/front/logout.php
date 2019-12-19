<?php
include dirname( __FILE__ ) . '/baseFront.php';
Config::unsetSession();
header( 'Location: login.php' );
?>
<script>
    window.location.replace("<?php echo curPageURL() . '/views/front' ?>");
</script>