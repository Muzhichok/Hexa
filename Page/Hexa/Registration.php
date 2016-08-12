<?php
namespace Page\Hexa;

class Registration
{
    // include url of current page
    public static $URL = 'http://task.hexa.com.ua/register';

    /**
     * Declare UI map for this page here. CSS or XPath allowed.
     * public static $usernameField = '#username';
     * public static $formSubmitButton = "#mainForm input[type=submit]";
     */

    #describe all elements, forms, buttons, errors etc
    public static $headerRegistrationForm = ".//h1[contains(text(),'Register')]";

    public static $firstNameInputField = ".//input[@name='first_name']";
    public static $lastNameInputField = ".//input[@name='last_name']";
    public static $loginField = ".//input[@name='login']";
    public static $emailField = ".//input[@name='email']";
    public static $passwordField = ".//input[@id='pwd1']";
    public static $repeatPasswordField = ".//input[@id='pwd2']";

    public static $registerButton = ".//*[@id='register']";

    #info buttons
    public static $infoButtonFirstNameField = ".//input[@name='first_name']/following-sibling::span[@class='field-info']";
    public static $infoButtonLastNameField = ".//input[@name='last_name']/following-sibling::span[@class='field-info']";
    public static $infoButtonLoginField = ".//input[@name='login']/following-sibling::span[@class='field-info']";
    public static $infoButtonEmailField = ".//input[@name='email']/following-sibling::span[@class='field-info']";
    public static $infoButtonPasswordField = ".//input[@id='pwd1']/following-sibling::span[@class='field-info']";
    public static $infoButtonRepeatPasswordField = ".//input[@id='pwd2']/following-sibling::span[@class='field-info']";

    #tooltips for info buttons
    public static $tooltipFirstNameField = ".//div[@class='field-info-text'][contains(text(),'Your first name, for example: Frank')]";
    public static $tooltipLastNameField = ".//div[@class='field-info-text'][contains(text(),'Your last name, for example: Willson')]";
    public static $tooltipLoginField = ".//div[@class='field-info-text'][contains(text(),'Enter your login name if you want Log In into your own profile')]";
    public static $tooltipEmailField = ".//div[@class='field-info-text'][contains(text(),'Your email, for example: johndoe@example.com')]";
    public static $tooltipPasswordField = ".//div[@class='field-info-text'][contains(text(),'Password includes numbers and latin letters')]";
    public static $tooltipRepeatPasswordField = ".//div[@class='field-info-text'][contains(text(),'Password must be the same as first')]";

    #errors
    public static $errorFirstNameEmpty = ".//div[@class='error'][contains(text(),'Please, enter your first name')]";
    public static $errorFirstNameLong = ".//div[@class='error'][contains(text(),'First name too long (more then 30 characters)')]";
    public static $errorLastNameEmpty = ".//div[@class='error'][contains(text(),'Please, enter your last name')]";
    public static $errorLastNameLong = ".//div[@class='error'][contains(text(),'Last name too long (more then 30 characters)')]";
    public static $errorLoginEmpty = ".//div[@class='error'][contains(text(),'Please, enter your login')]";
    public static $errorLoginLong = ".//div[@class='error'][contains(text(),'Login name too long (more then 30 characters)')]";
    public static $errorEmailEmpty = ".//div[@class='error'][contains(text(),'Please, enter your email')]";
    public static $errorEmailLong = ".//div[@class='error'][contains(text(),'Email too long (more then 100 characters)')]";
    public static $errorEmailInvalid = ".//div[@class='error'][contains(text(),'Invalid email. Please, enter correct email.')]";
    public static $errorPasswordEmpty = ".//div[@class='error'][contains(text(),'The password is too short (less then 3 characters)')]";
    public static $errorPasswordLong = ".//div[@class='error'][contains(text(),'Password too long (more then 50 characters)')]";


    protected function registration(\AcceptanceTester $I, $firstName, $lastName, $login, $email, $password, $repeatPassword)
    {
        $I->amOnUrl(self::$URL);
        $I->fillField(self::$firstNameInputField, $firstName);
        $I->fillField(self::$lastNameInputField, $lastName);
        $I->fillField(self::$loginField, $login);
        $I->fillField(self::$emailField, $email);
        $I->fillField(self::$passwordField, $password);
        $I->fillField(self::$repeatPasswordField, $repeatPassword);
        $I->click(self::$registerButton);

    }


}
