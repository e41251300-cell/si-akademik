<?php
function base_path(): string
{
    return rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/');
}

function url(string $path = ''): string
{
    // spasi pada nama folder (mis. "acara 10") diubah jadi %20
    return str_replace(' ', '%20', base_path()) . '/' . ltrim($path, '/');
}

function e(?string $v): string
{
    return htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8');
}