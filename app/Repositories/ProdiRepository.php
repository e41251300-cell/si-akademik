<?php
class ProdiRepository extends BaseModel
{
    public function all(): array
    {
        return $this->pdo->query("SELECT * FROM prodi ORDER BY nama")->fetchAll();
    }
}
