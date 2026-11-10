<h3><?= e($title) ?></h3>
<form method="post" action="<?= url($action) ?>" class="card card-body">
    <div class="mb-3">
        <label class="form-label">NIM</label>
        <input type="text" name="nim" class="form-control" value="<?= e($row['nim']) ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Nama</label>
        <input type="text" name="nama" class="form-control" value="<?= e($row['nama']) ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" value="<?= e($row['email']) ?>">
    </div>
    <div class="mb-3">
        <label class="form-label">Program Studi</label>
        <select name="prodi_id" class="form-select" required>
            <option value="">-- Pilih Prodi --</option>
            <?php foreach ($prodi as $p): ?>
                <option value="<?= $p['id'] ?>" <?= (int)$row['prodi_id'] === (int)$p['id'] ? 'selected' : '' ?>>
                    <?= e($p['nama']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Angkatan</label>
        <input type="number" name="angkatan" class="form-control" value="<?= e((string)$row['angkatan']) ?>" required>
    </div>
    <div class="d-flex gap-2">
        <button class="btn btn-primary">Simpan</button>
        <a href="<?= url('mahasiswa') ?>" class="btn btn-secondary">Batal</a>
    </div>
</form>
