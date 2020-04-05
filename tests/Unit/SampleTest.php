<?php

namespace tests\Unit;

use PHPUnit\Framework\TestCase;
use frontend\models\ContactForm;

class SampleComponentTest extends TestCase {

	public function testSample()
    {
    	$contact = new ContactForm();
      // $this->assertTrue(1 == 1);
      $this->assertInstanceOf(get_class($contact), $contact);
      $this->assertTrue($contact->sendTrue());
    }
}