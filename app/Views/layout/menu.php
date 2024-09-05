<?= $this->extend('layout/main') ?>

<?= $this->section('menu') ?>

<li class="has-submenu">
    <a href="<?= site_url('layout/index'); ?>"><i class="mdi mdi-home"></i>Home</a>
</li>
<li class="has-submenu">
    <a href="<?= site_url('maps/index'); ?>"><i class="mdi mdi-google-maps"></i>Maps</a>
</li>
<li class="has-submenu">
    <a href="#"><i class="mdi mdi-chart-timeline"></i>About Web</a>
</li>
<li class="has-submenu">
    <a href="#"><i class="mdi mdi-clipboard-text"></i>Print</a>
</li>
<!-- <li class="has-submenu">
    <a href="#"><i class="mdi mdi-layers"></i>Advanced UI</a>
    <ul class="submenu">
        <li><a href="advanced-highlight.html">Highlight</a></li>
        <li><a href="advanced-rating.html">Rating</a></li>
        <li><a href="advanced-alertify.html">Alertify</a></li>
        <li><a href="advanced-rangeslider.html">Range Slider</a></li>
    </ul>
</li> -->


<?= $this->endSection() ?>