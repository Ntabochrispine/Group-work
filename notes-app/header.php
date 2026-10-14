<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$current = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? htmlspecialchars($pageTitle) . ' — ' : ''; ?>InkNotes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500;9..144,700&family=Source+Sans+3:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <?php if (!empty($extraCss)): ?>
        <link rel="stylesheet" href="<?php echo htmlspecialchars($extraCss); ?>">
    <?php endif; ?>
</head>
<body>
<nav class="navbar navbar-expand-lg app-nav">
    <div class="container">
        <a class="navbar-brand" href="index.php">InkNotes</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link <?php echo $current === 'index.php' ? 'active' : ''; ?>" href="index.php">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $current === 'create_note.php' ? 'active' : ''; ?>" href="create_note.php">New Note</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<main class="container py-4">
<?php if (!empty($_SESSION['flash'])): ?>
    <div class="alert alert-<?php echo htmlspecialchars($_SESSION['flash']['type']); ?> alert-dismissible fade show" role="alert">
        <?php echo htmlspecialchars($_SESSION['flash']['message']); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <?php unset($_SESSION['flash']); ?>
<?php endif; ?>
