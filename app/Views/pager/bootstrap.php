<?php

use CodeIgniter\Pager\PagerRenderer;

/**
 * @var PagerRenderer $pager
 */
$pager->setSurroundCount(1);
?>
<?php if ($pager->getLast() > 1) : ?>
<nav aria-label="Navigasi halaman">
    <ul class="pagination pagination-sm mb-0 flex-wrap">
        <li class="page-item <?= $pager->hasPrevious() ? '' : 'disabled' ?>">
            <a class="page-link" href="<?= $pager->hasPrevious() ? $pager->getPrevious() : '#' ?>">&laquo;</a>
        </li>
        <?php foreach ($pager->links() as $link) : ?>
            <li class="page-item <?= $link['active'] ? 'active' : '' ?>">
                <a class="page-link" href="<?= $link['uri'] ?>"><?= $link['title'] ?></a>
            </li>
        <?php endforeach ?>
        <li class="page-item <?= $pager->hasNext() ? '' : 'disabled' ?>">
            <a class="page-link" href="<?= $pager->hasNext() ? $pager->getNext() : '#' ?>">&raquo;</a>
        </li>
    </ul>
</nav>
<?php endif ?>
