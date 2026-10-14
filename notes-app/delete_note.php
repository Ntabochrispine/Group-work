<?php
require_once 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['id']) || !ctype_digit($_POST['id'])) {
    $_SESSION['flash'] = ['type' => 'warning', 'message' => 'Invalid delete request.'];
    header('Location: index.php');
    exit;
}

$id = (int)$_POST['id'];
$stmt = $pdo->prepare('DELETE FROM notes WHERE id = ?');
$stmt->execute([$id]);

$_SESSION['flash'] = ['type' => 'success', 'message' => 'Note deleted.'];
header('Location: index.php');
exit;