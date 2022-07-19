<div class="container pt-5">
    <h3><?= $title ?></h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item"><a>Data Buku</a></li>
            <li class="breadcrumb-item "><a href="<?= base_url('buku'); ?>">List Data</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail Data</li>
        </ol>
    </nav>
    <div class="row mt-3">
        <div class="col-md-6 mx-auto">

            <div class="card">
                <div class="card-header bg-info">
                    Detail Data buku
                </div>

                <div class="card-body">
                <?php foreach ($buku as $buku): ?>
                    <h5 class="card-title"><b>ID buku :</b><br> <?= $buku['id_buku'] ?> </h5>
                    <p class="card-text"><b>Nama :</b><br><?= $buku['nama_buku'] ?></p>
                    <p class="card-text"><b>Halaman Buku :</b><br><?= $buku['halaman_buku'] ?></p>
                    <p class="card-text"><b>Penerbit :</b><br><?= $buku['penerbit'] ?></p>
                    <p class="card-text"><b>Tahun Terbit :</b><br><?= $buku['tahun_terbit'] ?></p>
                    <p class="card-text"><b>ID Jenis Buku :</b><br><?= $buku['id_jenis_buku'] ?></p>
                    <p></p>
                    <a href="<?= base_url(); ?>buku" class="btn btn-primary">Kembali</a>
                    <?php endforeach; ?>
                </div>
            </div>

        </div>
    </div>
</div>