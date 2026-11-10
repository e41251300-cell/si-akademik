<?php
// Controller TIDAK menulis SQL; hanya memanggil repository
class MahasiswaController extends BaseController
{
    public function __construct(
        private MahasiswaRepository $repo,
        private ProdiRepository $prodiRepo
    ) {}

    public function index(): void
    {
        $keyword = trim($_GET['q'] ?? '');
        $this->view('mahasiswa/index', [
            'title'     => 'Daftar Mahasiswa',
            'mahasiswa' => $this->repo->all($keyword),
            'keyword'   => $keyword,
        ]);
    }

    public function create(): void
    {
        $this->view('mahasiswa/form', [
            'title'  => 'Tambah Mahasiswa',
            'action' => 'mahasiswa/store',
            'row'    => ['nim' => '', 'nama' => '', 'email' => '', 'prodi_id' => '', 'angkatan' => date('Y')],
            'prodi'  => $this->prodiRepo->all(),
        ]);
    }

    public function store(): void
    {
        $this->repo->create($this->input());
        $this->redirect('mahasiswa');
    }

    public function edit(int $id): void
    {
        $row = $this->repo->find($id);
        if ($row === null) {
            $this->redirect('mahasiswa');
        }
        $this->view('mahasiswa/form', [
            'title'  => 'Ubah Mahasiswa',
            'action' => "mahasiswa/update/{$id}",
            'row'    => $row,
            'prodi'  => $this->prodiRepo->all(),
        ]);
    }

    public function update(int $id): void
    {
        $this->repo->update($id, $this->input());
        $this->redirect('mahasiswa');
    }

    public function destroy(int $id): void
    {
        $this->repo->delete($id);
        $this->redirect('mahasiswa');
    }

    /** Ambil + validasi sederhana input form */
    private function input(): array
    {
        $data = [
            'nim'      => trim($_POST['nim'] ?? ''),
            'nama'     => trim($_POST['nama'] ?? ''),
            'email'    => trim($_POST['email'] ?? ''),
            'prodi_id' => (int)($_POST['prodi_id'] ?? 0),
            'angkatan' => (int)($_POST['angkatan'] ?? date('Y')),
        ];
        if ($data['nim'] === '' || $data['nama'] === '') {
            $this->redirect('mahasiswa/create');
        }
        return $data;
    }
}
