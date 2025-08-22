<?php

use CodeIgniter\Pager\Pager;
use CodeIgniter\Pager\PagerRenderer;

if (! function_exists('backend_pagination')) {
    /**
     * Render pagination ala template backend (tanpa view pager CI).
     *
     * Pakai di view:
     *   <?= isset($pager) ? backend_pagination($pager, 'default', 'sm', 'end') : '' ?>
     *
     * @param Pager|PagerRenderer $pager
     * @param string $group  Group name (untuk Pager manager)
     * @param string $size   '', 'sm', 'lg'
     * @param string $align  'start' | 'center' | 'end'
     */
    function backend_pagination($pager, string $group = 'default', string $size = 'sm', string $align = 'end'): string
    {
        $isRenderer = $pager instanceof PagerRenderer;

        // Ambil angka halaman & jumlah halaman
        $current = $isRenderer ? $pager->getCurrentPage()
                               : $pager->getCurrentPage($group);

        $count   = $isRenderer ? $pager->getPageCount()
                               : $pager->getPageCount($group);

        if ($count <= 1) {
            return '';
        }

        // Cek prev/next (untuk Pager manager kita bandingkan angka halaman)
        $hasPrev = $current > 1;
        $hasNext = $current < $count;

        // Dapatkan URI prev/next (manager butuh $group)
        $prevUri = $isRenderer ? $pager->getPreviousPageURI()
                               : $pager->getPreviousPageURI($group);

        $nextUri = $isRenderer ? $pager->getNextPageURI()
                               : $pager->getNextPageURI($group);

        // Ambil link angka
        $numberLinks = $isRenderer ? $pager->links()
                                   : $pager->links($group);

        // Pastikan $numberLinks adalah array agar tidak error
        if (!is_array($numberLinks)) {
            $numberLinks = [];
        }

        // --- Render HTML ---
        $sizeClass  = $size === 'lg' ? ' pagination-lg' : ($size === 'sm' ? ' pagination-sm' : '');
        $alignClass = $align === 'center' ? ' justify-content-center'
                    : ($align === 'start' ? ' justify-content-start' : ' justify-content-end');

        $html  = '<nav aria-label="Page navigation"><ul class="pagination' . $sizeClass . $alignClass . '">';

        // Previous
        if ($hasPrev) {
            $html .= '<li class="page-item"><a class="page-link" href="' . esc($prevUri) . '">Previous</a></li>';
        } else {
            $html .= '<li class="page-item disabled"><span class="page-link" tabindex="-1" aria-disabled="true">Previous</span></li>';
        }

        // Numbered pages
        foreach ($numberLinks as $link) {
            if (!empty($link['active'])) {
                $html .= '<li class="page-item active" aria-current="page"><span class="page-link">' . esc($link['title']) . '</span></li>';
            } else {
                $html .= '<li class="page-item"><a class="page-link" href="' . esc($link['uri']) . '">' . esc($link['title']) . '</a></li>';
            }
        }

        // Next
        if ($hasNext) {
            $html .= '<li class="page-item"><a class="page-link" href="' . esc($nextUri) . '">Next</a></li>';
        } else {
            $html .= '<li class="page-item disabled"><span class="page-link" tabindex="-1" aria-disabled="true">Next</span></li>';
        }

        $html .= '</ul></nav>';

        return $html;
    }
}
