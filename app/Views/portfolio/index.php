<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
    <!-- Menampilkan pesan sukses dari flashdata -->
    <?php if(session()->getFlashdata('success_message')): ?>
        <div class="alert alert-success mt-3">
            <?= session()->getFlashdata('success_message'); ?>
        </div>
    <?php endif; ?>

    <!-- Menampilkan list portfolio -->
    <?php if(count($portfolios) == 0): ?>
        <div class="alert alert-danger mt-3">
            Tidak ada data
        </div>
    <?php endif; ?>
    <div class="row gx-5 gy-5 mt-2">
        <?php foreach($portfolios as $portfolio): ?>
            <div class="col col-6">
                <div class="card">
                    <img src="<?= $portfolio->image; ?>" alt="<?= $portfolio->title; ?>" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title"><?= $portfolio->title; ?></h5>
                        <p class="card-text"><?= $portfolio->description; ?>
                        </p>
                        <a href="<?= base_url('/portfolio/update/'.$portfolio->id); ?>" class="btn btn-primary">Edit</a>
                        <button type="button" onclick="return deletePortfolio('<?= $portfolio->id ?>')" class="btn btn-danger">Delete</button>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?= $this->endSection() ?>
<!-- Script untuk menghapus data -->
<?= $this->section('scripts'); ?>
    <script>
        function deletePortfolio(id) {
            const isConfirm = confirm('Are you sure to delete this data?');
            if(isConfirm) {
                fetch(`/portfolio/delete/${id}`, {
                    method:'DELETE'
                }).then(() => {
                    location.reload();
                })
            }
        }
    </script>
<?= $this->endSection(); ?>