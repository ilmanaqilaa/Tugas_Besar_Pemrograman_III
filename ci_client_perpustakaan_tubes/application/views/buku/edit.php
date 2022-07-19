<div class="container pt-5">
    <h3><?= $title ?></h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item"><a>Data Buku</a></li>
            <li class="breadcrumb-item "><a href="<?= base_url('buku'); ?>">List Data</a></li>
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

                    <?php foreach ($buku as $buku): ?>

                    <div class="form-group row">
                        <label for="id_buku" class="col-sm-2 col-form-label">id_buku</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="id_buku" name="id_buku" value=" <?= $buku['id_buku']; ?>" readonly>
                            <small class="text-danger">
                                <?php echo form_error('id_buku') ?>
                            </small>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="nama_buku" class="col-sm-2 col-formlabel">nama_buku</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama_buku" name="nama_buku" value=" <?= $buku['nama_buku']; ?>">
                            <small class="text-danger">
                                <?php echo form_error('nama_buku') ?>
                            </small>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="halaman_buku" class="col-sm-2 col-formlabel">halaman_buku</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" id="halaman_buku" name="halaman_buku" rows="3"><?= $buku['halaman_buku']; ?></textarea>
                            <small class="text-danger">
                                <?php echo form_error('halaman_buku') ?>
                            </small>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="penerbit" class="col-sm-2 col-form-label">penerbit</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="penerbit" name="penerbit" value="<?= $buku['penerbit']; ?>">
                            <small class="text-danger">
                                <?php echo form_error('penerbit') ?>
                            </small>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="tahun_terbit" class="col-sm-2 col-form-label">tahun_terbit</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="tahun_terbit" name="tahun_terbit" value="<?= $buku['tahun_terbit']; ?>">
                            <small class="text-danger">
                                <?php echo form_error('tahun_terbit') ?>
                            </small>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="id_jenis_buku" class="col-sm-2 col-form-label">id_jenis_buku</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="id_jenis_buku" name="id_jenis_buku" value="<?= $buku['id_jenis_buku']; ?>">
                            <small class="text-danger">
                                <?php echo form_error('id_jenis_buku') ?>
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