<div class="d-flex justify-content-between align-items-center mb-3">
    <h3><?= e($title) ?></h3>
    <a href="<?= url('mahasiswa/create') ?>" class="btn btn-primary">+ Tambah</a>
</div>

<form method="get" action="<?= url('mahasiswa') ?>" class="input-group mb-3">
    <input type="text" name="q" value="<?= e($keyword) ?>" class="form-control" placeholder="Cari nama atau NIM...">
    <button class="btn btn-outline-secondary">Cari</button>
</form>

<table class="table table-bordered table-striped bg-white">
    <thead class="table-primary">
        <tr><th>No</th><th>NIM</th><th>Nama</th><th>Email</th><th>Prodi</th><th>Angkatan</th><th>Aksi</th></tr>
    </thead>
    <tbody>
    <?php if (!$mahasiswa): ?>
        <tr><td colspan="7" class="text-center">Data tidak ditemukan.</td></tr>
    <?php endif; ?>
    <?php foreach ($mahasiswa as $i => $m): ?>
        <tr>
            <td><?= $i + 1 ?></td>
            <td><?= e($m['nim']) ?></td>
            <td><?= e($m['nama']) ?></td>
            <td><?= e($m['email']) ?></td>
            <td><?= e($m['prodi_nama']) ?></td>
            <td><?= e((string)$m['angkatan']) ?></td>
            <td class="d-flex gap-1">
                <a href="<?= url('mahasiswa/edit/' . $m['id']) ?>" class="btn btn-sm btn-warning">Ubah</a>
                <form method="post" action="<?= url('mahasiswa/destroy/' . $m['id']) ?>"
                      onsubmit="return confirm('Yakin hapus data ini?')">
                    <button class="btn btn-sm btn-danger">Hapus</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
