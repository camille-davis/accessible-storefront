jQuery(function ($) {
  /*
  // TODO put this back in functions.php if parentheses stop appearing.
  function enqueue_accessible_storefront_scripts() {
    wp_enqueue_script( 'accessible-storefront-functions', get_stylesheet_directory_uri('') . '/assets/js/accessible-storefront.js', array(), null );
  }
  add_action( 'wp_enqueue_scripts', 'enqueue_accessible_storefront_scripts' );
  */

  // Add parentheses to item count in header cart link.
  const cartLinkObserver = new MutationObserver((mutationRecord) => {
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
  });
});
