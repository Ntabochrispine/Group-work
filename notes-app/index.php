<?php
require_once 'db.php';
session_start();

$stmt = $pdo->query('SELECT id, title, content, created_at, updated_at FROM notes ORDER BY updated_at DESC');
$notes = $stmt->fetchAll();

$pageTitle = 'Dashboard';
$extraCss = 'css/dashboard.css';
require 'header.php';

function preview($text, $limit = 140) {
    $text = trim(preg_replace('/\s+/', ' ', $text));
    if (strlen($text) <= $limit) {
        return $text;
    }
    return substr($text, 0, $limit) . '...';
}
?>

<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <h1 class="mb-1">Your notes</h1>
        <p class="text-muted mb-0"><?php echo count($notes); ?> saved <?php echo count($notes) === 1 ? 'note' : 'notes'; ?></p>
    </div>
    <a href="create_note.php" class="btn btn-accent">Write a new note</a>
</div>

<?php if (!$notes): ?>
    <div class="empty-state">
        <h2>No notes yet</h2>
        <p>Start with a title and a few lines. Your notebook is empty for now.</p>
        <a href="create_note.php" class="btn btn-ink">Create your first note</a>
    </div>
<?php else: ?>
    <div class="row g-4">
        <?php foreach ($notes as $note): ?>
            <div class="col-md-6 col-lg-4">
                <a class="note-card" href="view_note.php?id=<?php echo (int)$note['id']; ?>">
                    <h2><?php echo htmlspecialchars($note['title']); ?></h2>
                    <p><?php echo htmlspecialchars(preview($note['content'])); ?></p>
                    <span class="note-date">Updated <?php echo date('M j, Y', strtotime($note['updated_at'])); ?></span>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php require 'footer.php'; ?>
