<?php

declare(strict_types=1);

/**
 * PDOインスタンスを取得する関数
 */
function connect(): PDO{
    try {
        $pdo = new PDO('mysql:host=localhost; dbname=conpas; charset=utf8mb4', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        return $pdo;
    }catch (PDOException $e) {
        echo '接続失敗';
    }
}
/**
 * HTMLエスケープする関数
 */
function escape(?string $value)
{
    return htmlspecialchars(strval($value), ENT_QUOTES | ENT_HTML5, 'UTF-8');
}

/**
 * LIKE演算子のワイルドカードをエスケープする関数
 */
function escapeLike(?string $value)
{
    return preg_replace('/([_%#])/u', '#${1}', $value);
}
