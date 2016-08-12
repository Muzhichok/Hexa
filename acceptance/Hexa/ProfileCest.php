<?php
namespace Hexa;
use \AcceptanceTester;
use \Faker\Factory;
use Page\Hexa\Profile;

class ProfileCest extends Profile
{
    public function _before(AcceptanceTester $I)
    {
    }

    public function _after(AcceptanceTester $I)
    {
    }

    // tests
    /**
     * @before login
     * @after logout
     */
    public function profileCanNotBeEmpty(AcceptanceTester $I)
    {
        $this->changeProfileData($I, '', '', '', '', '', '');
        $I->canSeeElement(Profile::$errorFirstNameEmpty);
        $I->canSeeElement(Profile::$errorLastNameEmpty);
        $I->canSeeElement(Profile::$errorLoginEmpty);
        $I->canSeeElement(Profile::$errorEmailEmpty);
        #it would be better to separate data changing and password changing and check pass in other test
        $I->canSeeElement(Profile::$errorPasswordEmpty);
    }

    /**
     * @before login
     * @after logout
     */
    public function checkFieldsLengthInProfile(AcceptanceTester $I)
    {
        #35 symbols in variable $thfivesymbols
        $thfivesymbols = 'asdfghjklqasdfghjklqasdfghjklqasdfg';
        $this->changeProfileData($I, $thfivesymbols, $thfivesymbols, $thfivesymbols,
            $thfivesymbols . '@' . $thfivesymbols . $thfivesymbols . '.com',
            $thfivesymbols . $thfivesymbols,
            $thfivesymbols . $thfivesymbols);
        $I->canSeeElement(Profile::$errorFirstNameLong);
        $I->canSeeElement(Profile::$errorLastNameLong);
        $I->canSeeElement(Profile::$errorEmailLong);
        $I->canSeeElement(Profile::$errorLoginLong);
        $I->canSeeElement(Profile::$errorPasswordLong);
    }

    /**
     * @before login
     * @after logout
     */
    public function impossibleChangeLoginAndEmailWhichAlreadyExist(AcceptanceTester $I)
    {
        $this->changeProfileData($I, 'Test', 'Test', 'test', 'test@mail.com',
            '123456', '123456');
        $I->canSee('This login already exist');
        $I->canSee('This email already exist');
    }

    /**
     * @before login
     * @after logout
     */
    public function impossibleSaveEmailWithWrongFormat(AcceptanceTester $I)
    {
        $this->changeProfileData($I, 'Test', 'Test', 'Test', 'adminmail.com',
            '123456', '123456');
        $I->seeElement(Profile::$errorEmailInvalid);
    }

    /**
     * @before login
     * @after logout
     */
    public function impossibleSavePasswordWhenConfirmPasswordDifferent(AcceptanceTester $I)
    {
        $facker = Factory::create();
        $firstName = $facker->firstName;
        $lastName = $facker->lastName;
        $login = $facker->userName;
        $email = $facker->email;
        $password = $facker->password();
        $this->changeProfileData($I, $firstName, $lastName, $login, $email, $password, 'Otherpass');
        $I->see('The passwords doesn\'t match');
    }

    /**
     * @before login
     * @after logout
     */
    public function passwordCanNotContainCyrillic(AcceptanceTester $I)
    {
        $facker = Factory::create();
        $firstName = $facker->firstName;
        $lastName = $facker->lastName;
        $login = $facker->userName;
        $email = $facker->email;
        $this->changeProfileData($I, $firstName, $lastName, $login, $email, 'пароль', 'пароль');
        $I->see('Password can contains numbers and latin letters only');
    }

    /**
     * @before login
     * @after logout
     */
    public function changeProfileWithValidData(AcceptanceTester $I)
    {
        $facker = Factory::create();
        $firstName = $facker->firstName;
        $lastName = $facker->lastName;
        $login = $facker->userName;
        $email = $facker->email;
        $password = $facker->password();
        $this->changeProfileData($I, $firstName, $lastName, $login, $email, $password, $password);
        $I->seeElement(Profile::$firstNameInputField, [
            'value' => $firstName
        ]);
        $I->seeElement(Profile::$lastNameInputField, [
            'value' => $lastName
        ]);
        $I->seeElement(Profile::$loginField, [
            'value' => $login
        ]);
        $I->seeElement(Profile::$emailField, [
            'value' => $email
        ]);
        $I->dontSee($password);
    }
}
