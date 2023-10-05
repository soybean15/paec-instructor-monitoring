<?php

namespace Tests\Feature;

use App\Http\Managers\SubjectManager;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SampleTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_if_adding_2_numbers_is_correct(){

        $manager = new SubjectManager();

        $result = $manager->add2Numbers(2,3);

        $this->assertEquals(5,$result );


    }
}
