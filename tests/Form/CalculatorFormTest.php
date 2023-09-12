<?php

namespace Form;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CalculatorFormTest extends WebTestCase
{
    public function testCalculatorFormSubmission()
    {
        $client  = static::createClient();
        $crawler = $client->request('GET', '/');

        $form = $crawler->selectButton('Submit')->form();
        $form['calculator[firstNumber]'] = 5;
        $form['calculator[secondNumber]'] = 3;
        $form['calculator[operator]'] = '+'; // Valid operator
        $client->submit($form);

        $this->assertTrue($client->getResponse()->isSuccessful());
    }
}
