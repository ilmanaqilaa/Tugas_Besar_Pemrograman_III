<div class="container pt-5">
    <h3><?= $title ?></h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item"><a>Data Peminjaman</a></li>
            <li class="breadcrumb-item "><a href="<?= base_url('transaction'); ?>">List Data</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail Data</li>
        </ol>
    </nav>
    <div class="row mt-3">
        <div class="col-md-6 mx-auto">

            <div class="card">
                <div class="card-header bg-info">
                    Detail Data Peminjaman
                </div>

                <div class="card-body">
                <?php foreach ($transaction as $transaction): ?>
                    <h5 class="card-title"><b>Id Transaksi :</b><br> <?= $transaction['transaction_id'] ?> </h5>
                    <p class="card-text"><b>Id Buku :</b><br><?= $transaction['book_id'] ?></p>
                    <p class="card-text"><b>Id Petugas :</b><br><?= $transaction['officer_id'] ?></p>
                    <p class="card-text"><b>Id Peminjam :</b><br><?= $transaction['borrower_id'] ?></p>
                    <p class="card-text"><b>Tanggal Pinjam :</b><br><?= $transaction['borrow_date'] ?></p>
                    <p class="card-text"><b>tanggal Kembali :</b><br><?= $transaction['return_date'] ?></p>
                    <h6 class="card-subtitle mb-2 text-muted"><b>Status :</b><br><?= $transaction['status'] ?></h6>
                    <p></p>
                    <a href="<?= base_url(); ?>mahasiswa" class="btn btn-primary">Kembali</a>
                    <?php endforeach; ?>
                </div>
            </div>

        </div>
    </div>
</div>