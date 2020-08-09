<?php

class FirstCest
{
    public function _before(AcceptanceTester $I)// like setUp()
    {
    }

    public function frontpageWorks(AcceptanceTester $I)
    {
    	// https://codeception.com/docs/03-AcceptanceTests
    	// https://codeception.com/docs/modules/PhpBrowser#Actions
      $I->amOnPage('/');
      $I->see('Home');
    }

    public function brokenLinks(AcceptanceTester $I) {
    	$I->amOnPage('/');
      $I->click('About', '#w0');
      //$I->dontSee("uy");
      $I->see("Not Found");
    }
}
