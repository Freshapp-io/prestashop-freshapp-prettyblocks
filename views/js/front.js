/**
 * FreshApp PrettyBlocks
 *
 * @author    FreshApp.io
 * @copyright 2026 FreshApp.io
 * @license   Proprietary - see LICENSE file
 */

/* FreshApp PrettyBlocks — Front JS */
(function () {
  'use strict';

  /**
   * Tabs : activation au clic
   */
  function initTabs() {
    document.querySelectorAll('.fa-tabs').forEach(function (tabsEl) {
      var nav = tabsEl.querySelector('.fa-tabs-nav');
      if (!nav) return;

      nav.addEventListener('click', function (e) {
        var btn = e.target.closest('.fa-tab-btn');
        if (!btn) return;

        var panelId = btn.getAttribute('aria-controls');
        if (!panelId) return;

        // Désactiver tous les onglets du groupe
        var items  = nav.querySelectorAll('.fa-tab-item');
        var panels = tabsEl.querySelectorAll('.fa-tab-panel');

        items.forEach(function (li) {
          li.classList.remove('active');
          var b = li.querySelector('.fa-tab-btn');
          if (b) { b.setAttribute('aria-selected', 'false'); }
        });
        panels.forEach(function (p) {
          p.classList.remove('active');
          p.hidden = true;
        });

        // Activer l'onglet cliqué
        var parentItem = btn.closest('.fa-tab-item');
        if (parentItem) { parentItem.classList.add('active'); }
        btn.setAttribute('aria-selected', 'true');

        var panel = document.getElementById(panelId);
        if (panel) {
          panel.classList.add('active');
          panel.hidden = false;
        }
      });
    });
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initTabs);
  } else {
    initTabs();
  }
})();
