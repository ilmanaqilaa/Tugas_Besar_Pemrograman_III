<div class="container pt-5">
    <h3><?= $title ?></h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item"><a>Data Peminjam</a></li>
            <li class="breadcrumb-item "><a href="<?= base_url('peminjam'); ?>">List Data</a></li>
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

                    <?php foreach ($peminjam as $peminjam): ?>

                    <div class="form-group row">
                        <label for="id_peminjam" class="col-sm-2 col-form-label">id_peminjam</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="id_peminjam" name="id_peminjam" value=" <?= $peminjam['id_peminjam']; ?>" readonly>
                            <small class="text-danger">
                                <?php echo form_error('id_peminjam') ?>
                            </small>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="nama" class="col-sm-2 col-formlabel">nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama" name="nama" value=" <?= $peminjam['nama']; ?>">
                            <small class="text-danger">
                                <?php echo form_error('nama') ?>
                            </small>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="jk" class="col-sm-2 col-formlabel">Jenis Kelamin</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="jk" name="jk">
                                <option value="Laki-laki" selected disabled>Pilih</option>
                                <option value="Laki-laki" <?php if ($peminjam['jk'] == "Laki-laki") : echo "selected"; endif; ?>>Laki-laki</option>
                                <option value="Perempuan" <?php if ($peminjam['jk'] == "Perempuan") : echo "selected"; endif; ?>>Perempuan</option>
                            </select>
                            <small class="text-danger">
                                <?php echo form_error('jk') ?>
                            </small>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="no_telp" class="col-sm-2 col-formlabel">no_telp</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" id="no_telp" name="no_telp" rows="3"><?= $peminjam['no_telp']; ?></textarea>
                            <small class="text-danger">
                                <?php echo form_error('no_telp') ?>
                            </small>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="alamat" class="col-sm-2 col-form-label">alamat</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $peminjam['alamat']; ?>">
                            <small class="text-danger">
                                <?php echo form_error('alamat') ?>
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