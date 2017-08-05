<?php
	$sidenav = wp_nav_menu( array(
        'theme_location' => 'main',
        'walker' => new Hn3j_Side_Walker(),
        'container' => '',
        'sub_menu' => true,
        'direct_parent' => true,
        'show_parent' => true,
        'items_wrap' => '%3$s',
        'echo' => false,
    ) );
    if ($sidenav) :
?>
<div class="left">
    <div class="box-show-z"></div>
    <?php echo $sidenav; ?>
</div>
<?php else : ?>
<script>
$(function(){
    $('.right').css({'width':'100%'});
});
</script>
<?php endif; ?>