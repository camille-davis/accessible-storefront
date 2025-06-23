jQuery(function ($) {
  /*
   * Helper functions.
   */

  // Gets an element's height from its children.
  const getFullHeight = (element) => {
    let height = 0;
    let style = getComputedStyle(element);
    height += parseInt(style.paddingTop) + parseInt(style.paddingBottom);
    if (element.children.length > 0) {
      $(element)
        .children()
        .each(function () {
          height += this.offsetHeight;
          console.log(this.offsetHeight);
          console.log(getComputedStyle(this).height);
        });
    }
    return height;
  };

  // Applies styles during a duration
  const applyTempStyle = (element, styles, duration) => {
    window.requestAnimationFrame(() => {
      window.setTimeout(() => {
        styles.forEach((style) => {
          element.style[style.property] = style.value;
        });
      });
      window.setTimeout(() => {
        styles.forEach((style) => {
          element.style[style.property] = "";
        });
      }, duration);
    });
  };

  /*
   * Mobile menu
   */

  const menuToggle = document.querySelector("#site-navigation-menu-toggle");
  const menu = document.querySelector(
    "#site-navigation div.menu:last-child ul"
  );

  // Set aria-controls to refer to menu, not parent div.
  menu.setAttribute("id", "mobile-menu");
  menuToggle.setAttribute("aria-controls", menu.id);

  // Handle mobile menu css transitions.
  const menuToggleObserver = new MutationObserver((mutationRecord) => {
    // Opening menu
    if (mutationRecord[0].target.getAttribute("aria-expanded") === "true") {
      menu.style.maxHeight = "0";
      const transitionStyle = [
        {
          property: "maxHeight",
          value: getFullHeight(menu) + "px",
        },
      ];
      applyTempStyle(menu, transitionStyle, 300);
      return;
    }

    // Closing menu
    menu.style.maxHeight = getFullHeight(menu) + "px";
    const transitionStyle = [
      {
        property: "maxHeight",
        value: "0",
      },
    ];
    applyTempStyle(menu, transitionStyle, 300);
  });

  menuToggleObserver.observe(menuToggle, {
    attributes: true,
    attributeFilter: ["aria-expanded"],
  });

  /*
   * Footer search
   */

  const footerSearchContainer = document.querySelector(
    ".storefront-handheld-footer-bar li.search"
  );
  const footerSearchToggle = footerSearchContainer.children[0];
  const footerSearchWidget = footerSearchContainer.querySelector(".site-search");

  // Add footer search aria attributes.
  footerSearchWidget.setAttribute("id", "footer-search-widget");
  footerSearchToggle.setAttribute("role", "button");
  footerSearchToggle.setAttribute("aria-controls", footerSearchWidget.id);
  footerSearchToggle.setAttribute("aria-expanded", "false");

  // Handle footer search aria-expanded attribute.
  const footerSearchObserver = new MutationObserver((mutationRecord) => {
    // Opening footer search
    if (mutationRecord[0].target.classList.contains("active")) {
      footerSearchToggle.setAttribute("aria-expanded", "true");
      return;
    }

    // Closing footer search
    footerSearchToggle.setAttribute("aria-expanded", "false");
  });

  footerSearchObserver.observe(footerSearchContainer, {
    attributes: true,
    attributeFilter: ["class"],
  });

  /*
   * Add parentheses to item count in header cart link.
   */

  // Uncomment if it becomes necessary again.
  /*const cartLinkObserver = new MutationObserver((mutationRecord) => {
    const newCartLink = (function () {
      for (let i = 0; i < mutationRecord.length; i++) {
        for (let j = 0; j < mutationRecord[i].addedNodes.length; j++) {
          const node = mutationRecord[i].addedNodes[j];
          if (node.classList && node.classList.contains("cart-contents")) {
            return node;
          }
        }
      }
    })();
    if (newCartLink) {
      const count = newCartLink.querySelector(".count").textContent;
      newCartLink.querySelector(".count").textContent = "(" + count + ")";
    }
  });
  const targetNode = document.querySelector("#site-header-cart li:first-child");
  cartLinkObserver.observe(targetNode, {
    childList: true,
    subtree: true,
  });*/
});
