<div class="container pt-5">
    <h3><?= $title ?></h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item"><a>Data Peminjaman</a></li>
            <li class="breadcrumb-item "><a href="<?= base_url('data_peminjaman'); ?>">List Data</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Data</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <?php
                    //create form
                    $attributes = array('method' => "post", "autocomplete" => "off");
                    echo form_open('', $attributes); ?>

                    <?php foreach ($data_peminjaman as $data_peminjaman): ?>

                    <div class="form-group row">
                        <label for="id_peminjaman" class="col-sm-2 col-form-label">id_peminjaman</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="id_peminjaman" name="id_peminjaman" value=" <?= $data_peminjaman['id_peminjaman']; ?>" readonly>
                            <small class="text-danger">
                                <?php echo form_error('id_peminjaman') ?>
                            </small>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="alasan_pinjam" class="col-sm-2 col-formlabel">alasan_pinjam</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="alasan_pinjam" name="alasan_pinjam" value=" <?= $data_peminjaman['alasan_pinjam']; ?>">
                            <small class="text-danger">
                                <?php echo form_error('alasan_pinjam') ?>
                            </small>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="tgl_pinjam" class="col-sm-2 col-formlabel">tgl_pinjam</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="tgl_pinjam" name="tgl_pinjam" value=" <?= $data_peminjaman['tgl_pinjam']; ?>">
                            <small class="text-danger">
                                <?php echo form_error('tgl_pinjam') ?>
                            </small>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="tgl_kembali" class="col-sm-2 col-formlabel">tgl_kembali</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" id="tgl_kembali" name="tgl_kembali" rows="3"><?= $data_peminjaman['tgl_kembali']; ?></textarea>
                            <small class="text-danger">
                                <?php echo form_error('tgl_kembali') ?>
                            </small>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="status" class="col-sm-2 col-formlabel">status</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="status" name="status">
                                <option value="Kembali" selected disabled>Pilih</option>
                                <option value="Kembali" <?php if ($data_peminjaman['status'] == "Kembali") : echo "selected"; endif; ?>>Kembali</option>
                                <option value="Dipinjam" <?php if ($data_peminjaman['status'] == "Dipinjam") : echo "selected"; endif; ?>>Dipinjam</option>
                            </select>
                            <small class="text-danger">
                                <?php echo form_error('status') ?>
                            </small>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                    <label for="id_peminjam" class="col-sm-2 col-form-label">ID PEMINJAM</label>
                    <div class="col-sm-5">
                            <select class="form-control" id="id_peminjam" name="id_peminjam">
                                <?php 
                                foreach ($data_peminjam as $row) :
                                ?>
                                <option value="<?= $row['id_peminjam'] ?>" <?php if ($data_peminjaman['nama'] == $row['nama']) : echo "selected"; endif; ?>> <?= $row['nama'] ?> </option>
                                <?php endforeach; ?>
                            </select>
                            <small class="text-danger">
                                <?php echo form_error('id_peminjam') ?>
                            </small>
                        </div>
                    </div>

                    <div class="form-group row">
                    <label for="id_buku" class="col-sm-2 col-form-label">id_buku</label>
                    <div class="col-sm-8">
                            <select class="form-control" id="id_buku" name="id_buku">
                                <?php 
                                foreach ($data_buku as $row) :
                                ?>
                                <option value="<?= $row['id_buku'] ?>" <?php if ($data_peminjaman['nama_buku'] == $row['nama_buku']) : echo "selected"; endif; ?>> <?= $row['nama_buku'] ?> </option>
                                <?php endforeach; ?>
                            </select>
                            <small class="text-danger">
                                <?php echo form_error('id_buku') ?>
                            </small>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-10 offset-md-2">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a class="btn btn-secondary" href="javascript:history.back()">Kembali</a>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>