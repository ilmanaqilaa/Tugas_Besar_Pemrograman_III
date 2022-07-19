<div class="container pt-5">
    <h3><?= $title ?></h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item"><a>Data Buku</a></li>
            <li class="breadcrumb-item "><a href="<?= base_url('buku'); ?>">List Data</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add Data</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <?php
                    //create form
                    $attributes = array('method' => "post", "autocomplete" => "off");
                    echo form_open('', $attributes);
                    ?>
                    <div class="form-group row">
                        <label for="id_buku" class="col-sm-2 col-form-label">id_buku</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="id_buku" name="id_buku" value="<?= set_value('id_buku'); ?>">
                            <small class="text-danger">
                                <?php echo form_error('id_buku') ?>
                            </small>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="nama_buku" class="col-sm-2 col-form-label">nama_buku</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama_buku" name="nama_buku" value=" <?= set_value('nama_buku'); ?>">
                            <small class="text-danger">
                                <?php echo form_error('nama_buku') ?>
                            </small>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="halaman_buku" class="col-sm-2 col-form-label">halaman_buku</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="halaman_buku" name="halaman_buku" value=" <?= set_value('halaman_buku'); ?>">
                            <small class="text-danger">
                                <?php echo form_error('halaman_buku') ?>
                            </small>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="penerbit" class="col-sm-2 col-form-label">penerbit</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="penerbit" name="penerbit" value="<?= set_value('penerbit'); ?>">
                            <small class="text-danger">
                                <?php echo form_error('penerbit') ?>
                            </small>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="tahun_terbit" class="col-sm-2 col-form-label">tahun_terbit</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="tahun_terbit" name="tahun_terbit" value="<?= set_value('tahun_terbit'); ?>">
                            <small class="text-danger">
                                <?php echo form_error('tahun_terbit') ?>
                            </small>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="id_jenis_buku" class="col-sm-2 col-form-label">id_jenis_buku</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="id_jenis_buku" name="id_jenis_buku" value="<?= set_value('id_jenis_buku'); ?>">
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
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>