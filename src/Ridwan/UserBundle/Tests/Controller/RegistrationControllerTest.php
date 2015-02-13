<?php

namespace Ridwan\UserBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RegistrationControllerTest extends WebTestCase
{
    public function testRegister()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/register');

        $this->assertTrue($crawler->filter('html:contains("Who are you?")')->count() == 1);

        //Check empty input
        $form = $crawler->selectButton('next')->form(array('fos_user_registration_form[type]' => 'volunteer'));
        $client->submit($form);
        $this->assertTrue($crawler->filter('html:contains("Who are you?")')->count() == 1);

        //Check wrong input 1
        $form = $crawler->selectButton('next')->form(array('fos_user_registration_form[type]' => 'volunteer'));
        $form = $crawler->selectButton('next')->form(array('fos_user_registration_form[username]' => 'naruto'));
        $form = $crawler->selectButton('next')->form(array('fos_user_registration_form[email]' => 'someone'));
        $form = $crawler->selectButton('next')->form(array('fos_user_registration_form[plainPassword][first]' => '12345'));
        $form = $crawler->selectButton('next')->form(array('fos_user_registration_form[plainPassword][second]' => '12345'));
        $client->submit($form);
        $this->assertTrue($crawler->filter('html:contains("Who are you?")')->count() == 1);

        //Check wrong input 2
        $form = $crawler->selectButton('next')->form(array('fos_user_registration_form[type]' => 'volunteer'));
        $form = $crawler->selectButton('next')->form(array('fos_user_registration_form[username]' => 'naruto'));
        $form = $crawler->selectButton('next')->form(array('fos_user_registration_form[email]' => 'someone@email.com'));
        $form = $crawler->selectButton('next')->form(array('fos_user_registration_form[plainPassword][first]' => '12345'));
        $form = $crawler->selectButton('next')->form(array('fos_user_registration_form[plainPassword][second]' => '123'));
        $client->submit($form);
        $this->assertTrue($crawler->filter('html:contains("Who are you?")')->count() == 1);


        //Check for existing username
        $form = $crawler->selectButton('next')->form(array('fos_user_registration_form[type]' => 'volunteer'));
        $form = $crawler->selectButton('next')->form(array('fos_user_registration_form[username]' => 'sasuke'));
        $form = $crawler->selectButton('next')->form(array('fos_user_registration_form[email]' => 'someone@email.com'));
        $form = $crawler->selectButton('next')->form(array('fos_user_registration_form[plainPassword][first]' => '12345'));
        $form = $crawler->selectButton('next')->form(array('fos_user_registration_form[plainPassword][second]' => '12345'));
        $client->submit($form);
        $this->assertTrue($crawler->filter('html:contains("Who are you?")')->count() == 1);

        //Check for existing email
        $form = $crawler->selectButton('next')->form(array('fos_user_registration_form[type]' => 'volunteer'));
        $form = $crawler->selectButton('next')->form(array('fos_user_registration_form[username]' => 'naruto'));
        $form = $crawler->selectButton('next')->form(array('fos_user_registration_form[email]' => 'sasuke@leaf.com'));
        $form = $crawler->selectButton('next')->form(array('fos_user_registration_form[plainPassword][first]' => '12345'));
        $form = $crawler->selectButton('next')->form(array('fos_user_registration_form[plainPassword][second]' => '12345'));
        $client->submit($form);
        $this->assertTrue($crawler->filter('html:contains("Who are you?")')->count() == 1);

        //Check for correct INPUT
        $form = $crawler->selectButton('next')->form(array('fos_user_registration_form[plainPassword][second]' => '123456','fos_user_registration_form[plainPassword][first]' => '123456','fos_user_registration_form[email]' => 'naruto@leaf.com','fos_user_registration_form[username]' => 'naruto','fos_user_registration_form[type]' => 'volunteer'));

        $client->submit($form);
        $crawler = $client->followRedirect();
        $this->assertTrue($crawler->filter('html:contains("Login")')->count() >0 );






    }
}
