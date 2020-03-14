describe('Login Action', () => {

  beforeEach(() => {
    window.localStorage.clear();
    cy.visit('/')
  })

  it('should show error message when user login fail', () => {
    cy.doLogin('email@fake.com', 'nabby27');

    cy.contains('Email o contraseña incorrectos');
  });

  it('should redirect to dashboard when login success', () => {
    cy.doLogin('icordobadonet@gmail.com', '123456');

    cy.url().should('eq', Cypress.config().baseUrl + '/home');
  });

  it('should redirect to login when user go to home and is not logged', () => {
    cy.visit('/home');

    cy.url().should('eq', Cypress.config().baseUrl + '/login');
  });

  it('should redirect to home if user si logged and go to login', () => {
    cy.doLogin('icordobadonet@gmail.com', '123456');
    cy.url().should('eq', Cypress.config().baseUrl + '/home');
    cy.visit('/login');

    cy.url().should('eq', Cypress.config().baseUrl + '/home');
  });

})
