<?php $col1 = $c[0] ?? "dark"; $col2 = $c[1] ?? $col1; $col3 = $c[2] ?? "dark"; ?>
<div class="breadcrumbs mb-2 d-flex align-items-center">
    <?php foreach($crumbs as $key=>$c){ 
    if($key == count($crumbs)-1){ ?>
    <div class="text-<?= $col3 ?>"><?php echo $c['title']; ?></div>
    <?php }else{ ?>
    <a class="text-<?= $col1 ?> d-block" style="text-decoration:none;"
        href="<?php echo $c['link'] ?>"><?php echo $c['title']; ?></a>
    <i class="bi bi-chevron-right text-<?= $col2 ?> mx-2 "></i>
    <?php }} ?>
</div>