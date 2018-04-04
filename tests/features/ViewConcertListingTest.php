<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ViewConcertListingTest extends TestCase
{
/** @test */
function user_can_view_a_concert_listing()
{
    //Arrange
    $concert = Concert::create([
       'title' => 'The Red Chord',
        'subtitle' => 'with Animosity and Lethagy',
        'date' => \Carbon\Carbon::parse('December 13, 2016 8:00pm'),
        'ticket_price' => 3250,
        'venue' => 'The Mosh Pit',
        'venue_address' => '123 Example Lane',
        'city' => 'Laraville',
        'state' => 'ON',
        'zip' => '17916',
        'additional_information' => 'For tickets, call (555) 555-555'
    ]);

    //Act
    $this->visit('/conserts/'.$concert->id);

    //Assert
    $this->see('The Red Chord');
    $this->see('with Animosity and Lethagy');
    $this->see('December 13, 2016');
    $this->see('8:00pm');
    $this->see('32.50');
    $this->see('The Mosh Pit');
    $this->see('123 Example Lane');
    $this->see('Laraville');
    $this->see('ON');
    $this->see('17916');
    $this->see('For tickets, call (555) 555-555');
}
}