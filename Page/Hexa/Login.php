<?php
namespace Page\Hexa;

class Login
{
    // include url of current page
    public static $URL = 'http://task.hexa.com.ua/login';

    /**
     * Declare UI map for this page here. CSS or XPath allowed.
     * public static $usernameField = '#username';
     * public static $formSubmitButton = "#mainForm input[type=submit]";
     */

    public static $loginHeaderName = ".//h1[contains(text(),'Login')]";
    public static $loginInputField = ".//input[@name='login']";
    public static $passwordInputField = ".//input[@name='password']";
    public static $signInButton = ".//*[@id='sign-in']";

    #info button for login field
    public static $infoButtonLoginField = ".//div[@class='field-info']";

    #tooltip for login field
    public static $infoTextLoginField = ".//div[@class='field-info-text'][contains(text(),'Enter your login name if you want Log In into your own profile')]";

    #info button for password field
    public static $infoButtonPasswordField = ".//div//span[@class='field-info']";

    #tooltip for password field
    public static $infoTextPasswordField = ".//div[@class='field-info-text'][contains(text(),'Password includes numbers and latin letters')]";

    #link to register page
    public static $registerLink = ".//a[@class='register_href']";

    #error for login field
    public static $errorLogin = ".//div[@class='error'][contains(text(),'Please, enter your login')]";
    #error for password field
    public static $errorPassword = ".//div[@class='error'][contains(text(),'Please, enter your password')]";




    protected function login(\AcceptanceTester $I, $login, $password)
    {
        $I->amOnUrl(self::$URL);
        $I->fillField(self::$loginInputField, $login);
        $I->fillField(self::$passwordInputField, $password);
        $I->click(self::$signInButton);
    }

    protected function clickOnInfoAboutLoginField(\AcceptanceTester $I)
    {
        $I->amOnUrl(self::$URL);
        $I->click(self::$infoButtonLoginField);
    }

    protected function clickOnInfoAboutPasswordField(\AcceptanceTester $I)
    {
        $I->amOnUrl(self::$URL);
        $I->click(self::$infoButtonPasswordField);
    }

    protected function openRegistrationPage(\AcceptanceTester $I)
    {
        $I->amOnUrl(self::$URL);
        $I->click(self::$registerLink);
    }


}
