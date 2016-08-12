# Hexa
some accepatance tests

1. For this tests use codeception (https://github.com/Codeception/Codeception)
2. Download folder Page/Hexa (https://github.com/Muzhichok/Hexa/tree/master/Page/Hexa) into folder tests/_support of your codeception
3. Download folder acceptance/Hexa (https://github.com/Muzhichok/Hexa/tree/master/acceptance/Hexa) into folder tests of your codeception (or download only folder "Hexa" with files into your codeception folders tests/acceptance)
4. Check your acceptance.suite.yml - Wbdriver module must be enabled with port and browser seted (check browser in not Firefox version 47.0 -  in this version webdriver is not working)
5. In tests I am using Facker (https://github.com/fzaninotto/Faker) for data generating
6. Run tests on machine with selenium server: ... run acceptance Hexa --html
7. Report with test result is generated in your codeception - tests/_output/report.html
