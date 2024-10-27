describe('Login Access Control', () => {
  it('should redirect to login if user is not logged in when accessing products page', () => {
      cy.visit('http://localhost/codespaceproject/products.php'); // Try to access products page
      cy.url().should('include', '/login.php'); // Verify redirected to login
      cy.get('form').within(() => {
          cy.get('input[name="email"]').type('123@gmail.com'); // Enter email
          cy.get('input[name="password"]').type('123'); // Enter password
          cy.get('button[type="submit"]').click(); // Submit login form
      });
      cy.url().should('include', '/products.php'); // Verify now on products page
  });
});
