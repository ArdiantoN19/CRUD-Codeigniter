<?= $this->extend('layouts/main') ?>
<?= $this->section('content'); ?>
    <h1>Create Portfolio</h1>
    <!-- Menampilkan pesan error ketika data tidak valid -->
    <?php if(service('validation')->getErrors()): ?>
        <div class="alert alert-danger" role="alert">
            <?=service('validation')->listErrors(); ?>
        </div>
    <?php endif; ?>
    <form method="post" action="/portfolio/create" enctype="multipart/form-data">
    <?= csrf_field() ?>
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" class="form-control" name="title" value="<?= set_value('title', '');?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="4"><?= set_value('description', '');?></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Image</label>
            <input type="file" class="form-control" name="image">
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
        <a class="btn btn-secondary" href="<?= base_url('portfolio');?>">Back</a>
    </form>
<?= $this->endSection(); ?>