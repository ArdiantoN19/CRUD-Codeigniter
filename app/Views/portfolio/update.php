<?= $this->extend('layouts/main'); ?>
<?= $this->section('content'); ?>
    <?php if(service('validation')->getErrors()): ?>
    <div class="alert alert-danger">
        <?= session()->getFlashdata('error'); ?>
        <?= validation_list_errors(); ?>
    </div>
    <?php endif; ?>

    <!-- form update -->
    <form method="post" action="<?= base_url('portfolio/update/'.$portfolio->id);?>" enctype="multipart/form-data">
    <?= csrf_field() ?>
        <input type="hidden" name="_method" value="put">
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" class="form-control" name="title" value="<?= set_value('title', $portfolio->title);?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="4"><?= set_value('description', $portfolio->description);?></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Image</label>
            <input type="file" class="form-control" name="image">
        </div>
        <div class="mb-3">
            <?php if($portfolio->image):?>
            <img src="<?= base_url($portfolio->image);?>" width="50%" alt="<?= $portfolio->title;?>">
            <?php endif;?>
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
        <a class="btn btn-secondary" href="<?= base_url('portfolio');?>">Back</a>
    </form>

<?= $this->endSection(); ?>