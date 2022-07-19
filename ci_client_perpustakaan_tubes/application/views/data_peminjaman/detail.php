<div class="container pt-5">
    <h3><?= $title ?></h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item"><a>Data_Peminjaman</a></li>
            <li class="breadcrumb-item "><a href="<?= base_url('Data_Peminjaman'); ?>">List Data</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail Data</li>
        </ol>
    </nav>
    <div class="row mt-3">
        <div class="col-md-6 mx-auto">

            <div class="card">
                <div class="card-header bg-info">
                    Detail Data Data_Peminjaman
                </div>

                <div class="card-body">
                <?php foreach ($data_peminjaman as $data_peminjaman): ?>
                    <h5 class="card-title"><b>id_peminjaman :</b><br> <?= $data_peminjaman['id_peminjaman'] ?> </h5>
                    <p class="card-text"><b>Alasan Pinjam :</b><br><?= $data_peminjaman['alasan_pinjam'] ?></p>
                    <p class="card-text"><b>Tanggal Pinjam :</b><br><?= $data_peminjaman['tgl_pinjam'] ?></p>
                    <p class="card-text"><b>tgl_kembali :</b><br><?= $data_peminjaman['tgl_kembali'] ?></p>
                    <p class="card-text"><b>Status :</b><br><?= $data_peminjaman['status'] ?></p>
                    <p class="card-text"><b>ID Peminjam :</b><br><?= $data_peminjaman['id_peminjam'] ?></p>
                    <h6 class="card-subtitle mb-2 text-muted"><b>id_buku :</b><br><?= $data_peminjaman['id_buku'] ?></h6>
                    <p></p>
                    <a href="<?= base_url(); ?>mahasiswa" class="btn btn-primary">Kembali</a>
                    <?php endforeach; ?>
                </div>
            </div>

        </div>
    </div>
</div>