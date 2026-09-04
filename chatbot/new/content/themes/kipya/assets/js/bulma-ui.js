/**
 * Bulma UI helpers for Kipya theme.
 * Replaces Bootstrap data-bs-* behaviors (modal/offcanvas/accordion).
 */

(function () {
  function qs(sel, root) {
    return (root || document).querySelector(sel);
  }
  function qsa(sel, root) {
    return Array.from((root || document).querySelectorAll(sel));
  }

  function setBodyScrollLocked(locked) {
    document.documentElement.classList.toggle("is-clipped", !!locked);
  }

  // -------------------------
  // Bulma Modal
  // -------------------------
  function openModal(modal) {
    if (!modal) return;
    modal.classList.add("is-active");
    setBodyScrollLocked(true);
  }

  function closeModal(modal) {
    if (!modal) return;
    modal.classList.remove("is-active");
    if (qsa(".modal.is-active").length === 0) {
      setBodyScrollLocked(false);
    }
  }

  function bindModal(modal) {
    qsa(".modal-background, .modal-close, [data-bulma-close]", modal).forEach((el) => {
      el.addEventListener("click", () => closeModal(modal));
    });
  }

  // Triggers: [data-bulma-modal="#id"] or [data-bulma-modal="id"]
  // Uses event delegation to handle dynamically added content (shortcodes, ajax, etc.)
  function wireModals() {
    console.log("[bulma-ui] wireModals() called");
    
    // Bind close handlers for any existing modals
    const modals = qsa(".modal");
    console.log("[bulma-ui] Found", modals.length, "modals");
    modals.forEach((modal) => bindModal(modal));

    // Use event delegation for trigger clicks (handles dynamic content)
    document.addEventListener("click", (e) => {
      const trigger = e.target.closest("[data-bulma-modal]");
      console.log("[bulma-ui] Click detected, trigger:", trigger);
      if (!trigger) return;

      const raw = trigger.getAttribute("data-bulma-modal") || "";
      console.log("[bulma-ui] Modal ID raw:", raw);
      const selector = raw.startsWith("#") ? raw : `#${raw}`;
      console.log("[bulma-ui] Modal selector:", selector);
      const modal = qs(selector);
      console.log("[bulma-ui] Found modal element:", modal);
      if (!modal) return;

      e.preventDefault();
      // Ensure this modal has close handlers bound
      bindModal(modal);
      console.log("[bulma-ui] Opening modal");
      openModal(modal);
    });
  }

  // ESC closes active modal/drawer
  function wireEscape() {
    document.addEventListener("keydown", (e) => {
      if (e.key !== "Escape") return;
      const activeModal = qs(".modal.is-active");
      if (activeModal) closeModal(activeModal);

      const activeDrawer = qs(".kpy-drawer.is-active");
      if (activeDrawer) activeDrawer.classList.remove("is-active");
      const overlay = qs(".kpy-drawer-overlay.is-active");
      if (overlay) overlay.classList.remove("is-active");

      if (!qs(".modal.is-active") && !qs(".kpy-drawer.is-active")) {
        setBodyScrollLocked(false);
      }
    });
  }

  // -------------------------
  // Simple Drawer (Bulma-ish)
  // -------------------------
  function openDrawer(drawer) {
    if (!drawer) return;
    drawer.classList.add("is-active");
    const overlay = qs(".kpy-drawer-overlay");
    if (overlay) overlay.classList.add("is-active");
    setBodyScrollLocked(true);
  }

  function closeDrawer(drawer) {
    if (!drawer) return;
    drawer.classList.remove("is-active");
    const overlay = qs(".kpy-drawer-overlay");
    if (overlay) overlay.classList.remove("is-active");
    if (qsa(".modal.is-active").length === 0) setBodyScrollLocked(false);
  }

  // Triggers: [data-bulma-drawer="#id"] or [data-bulma-drawer="id"]
  function wireDrawers() {
    qsa("[data-bulma-drawer]").forEach((trigger) => {
      const raw = trigger.getAttribute("data-bulma-drawer") || "";
      const selector = raw.startsWith("#") ? raw : `#${raw}`;
      const drawer = qs(selector);
      if (!drawer) return;

      trigger.addEventListener("click", (e) => {
        e.preventDefault();
        openDrawer(drawer);
      });
    });

    qsa("[data-bulma-drawer-close]").forEach((btn) => {
      btn.addEventListener("click", (e) => {
        e.preventDefault();
        const drawer = btn.closest(".kpy-drawer");
        closeDrawer(drawer);
      });
    });

    const overlay = qs(".kpy-drawer-overlay");
    if (overlay) {
      overlay.addEventListener("click", () => {
        const drawer = qs(".kpy-drawer.is-active");
        closeDrawer(drawer);
      });
    }
  }

  // -------------------------
  // Accordion (Bulma style)
  // -------------------------
  // Markup:
  // .kpy-accordion-item
  //   button.kpy-accordion-trigger[data-accordion-target="#panelId"]
  //   div.kpy-accordion-panel#panelId
  function wireAccordions() {
    qsa(".kpy-accordion-trigger").forEach((btn) => {
      btn.addEventListener("click", (e) => {
        e.preventDefault();
        const targetSel = btn.getAttribute("data-accordion-target");
        if (!targetSel) return;
        const panel = qs(targetSel);
        if (!panel) return;

        const item = btn.closest(".kpy-accordion-item");
        const root = btn.closest(".kpy-accordion");

        // close siblings
        if (root) {
          qsa(".kpy-accordion-item.is-active", root).forEach((sib) => {
            if (sib === item) return;
            sib.classList.remove("is-active");
            const sibPanelSel = qs(".kpy-accordion-trigger", sib)?.getAttribute("data-accordion-target");
            const sibPanel = sibPanelSel ? qs(sibPanelSel) : null;
            if (sibPanel) sibPanel.hidden = true;
          });
        }

        const isOpen = item?.classList.contains("is-active");
        item?.classList.toggle("is-active", !isOpen);
        panel.hidden = isOpen;
      });
    });

    // initialize panels that aren't active as hidden
    qsa(".kpy-accordion-panel").forEach((p) => {
      const parentItem = p.closest(".kpy-accordion-item");
      const open = parentItem?.classList.contains("is-active");
      p.hidden = !open;
    });
  }

  document.addEventListener("DOMContentLoaded", function () {
    wireModals();
    wireDrawers();
    wireAccordions();
    wireEscape();
  });
})();

