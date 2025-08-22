<?php if ($pager->hasPreviousPage($pagerGroup)): ?>
  <li class="page-item">
    <a class="page-link" href="<?= $pager->getPreviousPageURI($pagerGroup) ?>" aria-label="Previous">
      <span aria-hidden="true">&laquo;</span>
    </a>
  </li>
<?php endif; ?>

<?php foreach ($pager->links($pagerGroup) as $link): ?>
  <li class="page-item <?= $link['active'] ? 'active' : '' ?>">
    <a class="page-link" href="<?= $link['uri'] ?>">
      <?= esc($link['title']) ?>
    </a>
  </li>
<?php endforeach; ?>

<?php if ($pager->hasNextPage($pagerGroup)): ?>
  <li class="page-item">
    <a class="page-link" href="<?= $pager->getNextPageURI($pagerGroup) ?>" aria-label="Next">
      <span aria-hidden="true">&raquo;</span>
    </a>
  </li>
<?php endif; ?>
