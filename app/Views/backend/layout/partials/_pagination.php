<?php if ($pager->getPageCount('default') > 1): ?>
  <nav aria-label="Navigasi halaman">
    <ul class="pagination justify-content-center">

      <!-- Tombol Sebelumnya -->
      <?php if ($pager->hasPrevious('default')) : ?>
        <li class="page-item">
          <a class="page-link" href="<?= $pager->getPreviousPageURI('default') ?>" aria-label="Sebelumnya">
            <span aria-hidden="true">&laquo;</span>
          </a>
        </li>
      <?php else : ?>
        <li class="page-item disabled">
          <span class="page-link" aria-hidden="true">&laquo;</span>
        </li>
      <?php endif ?>

      <!-- Nomor Halaman -->
      <?php foreach ($pager->links('default') as $link): ?>
        <?php if ($link['active']) : ?>
          <li class="page-item active">
            <span class="page-link"><?= esc($link['title']) ?></span>
          </li>
        <?php else : ?>
          <li class="page-item">
            <a class="page-link" href="<?= $link['uri'] ?>"><?= esc($link['title']) ?></a>
          </li>
        <?php endif ?>
      <?php endforeach ?>

      <!-- Tombol Berikutnya -->
      <?php if ($pager->hasNext('default')) : ?>
        <li class="page-item">
          <a class="page-link" href="<?= $pager->getNextPageURI('default') ?>" aria-label="Berikutnya">
            <span aria-hidden="true">&raquo;</span>
          </a>
        </li>
      <?php else : ?>
        <li class="page-item disabled">
          <span class="page-link" aria-hidden="true">&raquo;</span>
        </li>
      <?php endif ?>

    </ul>
  </nav>
<?php endif ?>
