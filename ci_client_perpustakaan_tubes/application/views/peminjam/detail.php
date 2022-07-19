<div class="container pt-5">
    <h3><?= $title ?></h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item"><a>Data Peminjam</a></li>
            <li class="breadcrumb-item "><a href="<?= base_url('peminjam'); ?>">List Data</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail Data</li>
        </ol>
    </nav>
    <div class="row mt-3">
        <div class="col-md-6 mx-auto">

            <div class="card">
                <div class="card-header bg-info">
                    Detail Data Peminjam
                </div>

                <div class="card-body">
                <?php foreach ($peminjam as $peminjam): ?>
                    <h5 class="card-title"><b>ID Peminjam :</b><br> <?= $peminjam['id_peminjam'] ?> </h5>
                    <p class="card-text"><b>Nama :</b><br><?= $peminjam['nama'] ?></p>
                    <p class="card-text"><b>No Telepon :</b><br><?= $peminjam['no_telp'] ?></p>
                    <p class="card-text"><b>Alamat :</b><br><?= $peminjam['alamat'] ?></p>
                    <p></p>
                    <a href="<?= base_url(); ?>peminjam" class="btn btn-primary">Kembali</a>
                    <?php endforeach; ?>
                </div>
            </div>

        </div>
    </div>
</div>