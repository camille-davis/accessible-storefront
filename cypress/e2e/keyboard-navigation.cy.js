describe("Keyboard navigation", () => {
  it("Focused elements are visible when tabbing through the page", () => {
    cy.visit("/");

    let tabCount = 0;
    const tabThroughElements = (tabCount) => {
      if (tabCount > 100) { // Tab limit to prevent infinite loop
        return;
      }

      // Tab to the next element.
      cy.press(Cypress.Keyboard.Keys.TAB);
      cy.then(() => {

        // If no element is focused, stop tabbing.
        if (Cypress.$(":focus").length === 0) {
          return;
        }

        // Verify focused element is visible.
        cy.focused().should("be.visible");

        // Continue tabbing.
        tabThroughElements(tabCount + 1);
      });
    };

    tabThroughElements(tabCount);
  });
});
