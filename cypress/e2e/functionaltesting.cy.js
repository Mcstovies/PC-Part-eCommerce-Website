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

describe('Add Product to Cart', () => {
  it('should add a product to the cart and show success message', () => {
      cy.visit('http://localhost/codespaceproject/products.php'); // Navigate to products page
      cy.url().should('include', '/login.php'); // Verify redirected to login
      cy.get('form').within(() => {
          cy.get('input[name="email"]').type('123@gmail.com'); // Enter email
          cy.get('input[name="password"]').type('123'); // Enter password
          cy.get('button[type="submit"]').click(); // Submit login form
      });
      cy.url().should('include', '/products.php'); // Verify now on products page
      cy.get('.card').first().within(() => {
          cy.get('button').contains('Add to Cart').click(); // Click on the first product's 'Add to Cart' button
      });
      cy.get('.alert').should('contain', 'Product added to cart!'); // Check success message
      cy.get('a').contains('View Cart').click(); // Navigate to cart page
      cy.get('.cart-item').should('have.length.greaterThan', 0); // Verify cart has at least 1 item
  });
});