<?php

namespace Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CalculatorControllerTest extends WebTestCase
{
    public function testCalculatorFormSubmissionWithValidInput()
    {
        $client  = static::createClient();
        $crawler = $client->request('GET', '/');

        $form = $crawler->selectButton('Submit')->form();
        $form['calculator[firstNumber]']  = 5;
        $form['calculator[secondNumber]'] = 3;
        $form['calculator[operator]']     = '+';

        $client->submit($form);

        $this->assertSame(200, $client->getResponse()->getStatusCode());
        $this->assertStringContainsString('Result: 8', $client->getResponse()->getContent());
    }
}
