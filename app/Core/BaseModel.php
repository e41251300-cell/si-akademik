<?php
// Parent class: semua Model/Repository butuh akses PDO
abstract class BaseModel
{
    public function __construct(protected PDO $pdo) {}
}
