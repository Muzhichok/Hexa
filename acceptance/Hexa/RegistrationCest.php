<?php
namespace Hexa;
use \AcceptanceTester;
use \Faker\Factory;
use \Page\Hexa\Registration;

class RegistrationCest extends Registration
{
    public function _before(AcceptanceTester $I)
    {
    }

    public function _after(AcceptanceTester $I)
    {
    }

    // tests
    public function impossibleRegistrationWithEmptyFields(AcceptanceTester $I)
    {
        $this->registration($I, '', '', '', '', '', '');
        $I->seeElement(Registration::$errorFirstNameEmpty);
        $I->seeElement(Registration::$errorLastNameEmpty);
        $I->seeElement(Registration::$errorEmailEmpty);
        $I->seeElement(Registration::$errorLoginEmpty);
        $I->seeElement(Registration::$errorPasswordEmpty);
    }

    public function impossibleRegistrationWithLongFields(AcceptanceTester $I)
    {
        #35 symbols in variable $thfivesymbols
        $thfivesymbols = 'asdfghjklqasdfghjklqasdfghjklqasdfg';
        $this->registration($I, $thfivesymbols, $thfivesymbols, $thfivesymbols,
            $thfivesymbols . $thfivesymbols . '@' . $thfivesymbols . '.com',
            $thfivesymbols . $thfivesymbols,
            $thfivesymbols . $thfivesymbols);
        $I->dontSeeElement(Registration::$errorFirstNameLong);
        $I->dontSeeElement(Registration::$errorLastNameLong);
        $I->dontSeeElement(Registration::$errorLoginLong);
        $I->dontSeeElement(Registration::$errorEmailLong);
        $I->dontSeeElement(Registration::$errorPasswordLong);
        $I->seeElement(Registration::$errorEmailInvalid);
    }

    public function impossibleRegistrationWithLoginAlreadyExist(AcceptanceTester $I)
    {
        $this->registration($I, 'Test', 'Test', 'admin', 'mail@mail.com', '123456', '123456');
        $I->see('The login is not unique');
    }

    public function impossibleRegistrationWithEmailAlreadyExist(AcceptanceTester $I)
    {
        $this->registration($I, 'Test', 'Test', 'Test', 'admin@example.com', '123456', '123456');
        $I->see('The email is not unique');
    }

    public function impossibleRegistrationIfPasswordMismatch(AcceptanceTester $I)
    {
        $this->registration($I, 'Test', 'Test', 'Test', 'mail@mail12.com', '123456', '654321');
        $I->see('The passwords doesn\'t match');
    }

    public function impossibleRegistrationWithCyrillicInPassword(AcceptanceTester $I)
    {
        $this->registration($I, 'Test', 'Test', 'Test', 'mail@mail12.com', 'пароль', 'пароль');
        $I->see('Password should includes numbers and latin letters only');
    }

    public function registrationWithValidData(AcceptanceTester $I)
    {
        $facker = Factory::create();
        $firstName = $facker->firstName;
        $lastName = $facker->lastName;
        $login = $facker->userName;
        $email = $facker->email;
        $password = $facker->password();
        $this->registration($I, $firstName, $lastName, $login, $email, $password, $password);
        $I->see('Registration Successful');
    }
}
