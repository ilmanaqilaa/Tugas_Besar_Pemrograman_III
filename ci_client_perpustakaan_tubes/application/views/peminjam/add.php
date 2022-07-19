<div class="container pt-5">
    <h3><?= $title ?></h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item"><a>Data Peminjam</a></li>
            <li class="breadcrumb-item "><a href="<?= base_url('peminjam'); ?>">List Data</a></li>
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
                        <label for="id_peminjam" class="col-sm-2 col-form-label">id_peminjam</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="id_peminjam" name="id_peminjam" value="<?= set_value('id_peminjam'); ?>">
                            <small class="text-danger">
                                <?php echo form_error('id_peminjam') ?>
                            </small>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="nama" class="col-sm-2 col-form-label">nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama" name="nama" value=" <?= set_value('nama'); ?>">
                            <small class="text-danger">
                                <?php echo form_error('nama') ?>
                            </small>
                        </div>
                    </div>

                    <div class="form-group row">
                    <label for="jenis_kelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="jenis_kelamin" name="jk">
                                <option value="Laki-laki" selected disabled>Pilih</option>
                                <option value="Laki-laki" <?php if (set_value('jenis_kelamin') == "Laki-laki") : echo "selected"; endif; ?>>Laki-laki</option>
                                <option value="Perempuan" <?php if (set_value('jenis_kelamin') == "Perempuan") : echo "selected"; endif; ?>>Perempuan</option>
                            </select>
                            <small class="text-danger">
                                <?php echo form_error('jenis_kelamin') ?>
                            </small>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="no_telp" class="col-sm-2 col-form-label">no_telp</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="no_telp" name="no_telp" value=" <?= set_value('no_telp'); ?>">
                            <small class="text-danger">
                                <?php echo form_error('no_telp') ?>
                            </small>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="alamat" class="col-sm-2 col-form-label">alamat</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="alamat" name="alamat" value="<?= set_value('alamat'); ?>">
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
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>