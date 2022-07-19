<nav class="navbar navbar-expand-md bg-dark navbar-dark shadow bg-body ">
    <!-- Brand -->
    <a class="navbar-brand" href="#">Rest Client - PEMROGRAMAN III</a>

    <!-- Toggler/collapsibe Button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar links -->
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav">
            <li class="nav-item">
            <a class="nav-link" href="<?= base_url('data_peminjaman'); ?>">Data Peminjaman</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="<?= base_url('peminjam'); ?>">Peminjam</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="<?= base_url('buku'); ?>">Buku</a>
            </li>
        </ul>
    </div>
</nav>