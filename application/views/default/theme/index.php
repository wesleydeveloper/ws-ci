<?php
$this->load->view('default/theme/_parts/header');
?>
<main>
    <?= $view_content ?>
</main>
<?php
$this->load->view('default/theme/_parts/sidebar');
$this->load->view('default/theme/_parts/footer');
?>
