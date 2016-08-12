<?php
namespace Hexa;
use \AcceptanceTester;
use Page\Hexa\Login;

class AuthorizationCest extends Login
{

    // tests
    public function allElementsForAuthorizationFormIsPresent(AcceptanceTester $I)
    {
        $I->amOnUrl(Login::$URL);
        $I->canSeeElement(Login::$loginHeaderName);
        $I->canSeeElement(Login::$loginInputField);
        $I->canSeeElement(Login::$passwordInputField);
        $I->canSeeElement(Login::$infoButtonLoginField);
        $I->canSeeElement(Login::$infoButtonPasswordField);
        $I->canSeeElement(Login::$signInButton);
        $I->canSeeElement(Login::$registerLink);
    }

    public function checkInfoAboutLoginField(AcceptanceTester $I)
    {
        $this->clickOnInfoAboutLoginField($I);
        $I->seeElement(Login::$infoTextLoginField);
    }

    public function checkInfoAboutPasswordField(AcceptanceTester $I)
    {
        $this->clickOnInfoAboutPasswordField($I);
        $I->seeElement(Login::$infoTextPasswordField);
    }

    public function loginWithValidData(AcceptanceTester $I)
    {
        $this->login($I, 'admin', 'admin');
        $I->see('Profile info: Alex Administrator');
    }

    public function impossibleSignInWithEmptyLoginAndPasswordFields(AcceptanceTester $I)
    {
        $this->login($I, '', '');
        $I->canSeeInCurrentUrl('/login');
        $I->seeElement(Login::$errorLogin);
        $I->seeElement(Login::$errorPassword);
    }

    public function impossibleSignInWithEmptyLoginField(AcceptanceTester $I)
    {
        $this->login($I, '', 'admin');
        $I->canSeeInCurrentUrl('/login');
        $I->seeElement(Login::$errorLogin);
        $I->dontSeeElement(Login::$errorPassword);
    }

    public function impossibleSignInWithEmptyPasswordField(AcceptanceTester $I)
    {
        $this->login($I, 'admin', '');
        $I->canSeeInCurrentUrl('/login');
        $I->dontSeeElement(Login::$errorLogin);
        $I->seeElement(Login::$errorPassword);
    }

    public function impossibleSignInWithWrongPassword(AcceptanceTester $I)
    {
        $this->login($I, 'admin', '123456');
        $I->seeInCurrentUrl('/login');
        $I->canSee('Wrong password');
    }

    public function impossibleSignInWithWrongLogin(AcceptanceTester $I)
    {
        $this->login($I, 'Admin', 'admin');
        $I->seeInCurrentUrl('/login');
        $I->canSee('This user is not exist');
    }

    public function impossibleSignInWithEmailInLoginField(AcceptanceTester $I)
    {
        $this->login($I, 'admin@example.com', 'admin');
        $I->seeInCurrentUrl('/login');
        $I->canSee('Incorrect login');
    }


}
