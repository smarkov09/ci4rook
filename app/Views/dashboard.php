<?= $this->extend('layouts/dashb');
$this->section('title') ?> Dashboard <?= $this->endSection() ?>
<?= $this->section('content'); ?>

base: <?php echo base_url().'/dashboard'; ?>
<hr>
site: <?php echo site_url().'dashboard'; ?>
<hr>
current: <?php echo current_url(); ?>

<?= $this->endSection(); ?>