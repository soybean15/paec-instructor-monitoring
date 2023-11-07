<?php

namespace Tests\Feature;

use App\Http\Managers\TeacherManager;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SettingsTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_if_settings_return_school_year(){

        $manager =new TeacherManager();

        $response = $manager->getSetting('school_year_start');

        $this->assertEquals(6, $response);

    }

    public function test_if_settings_return_school_Name(){

        $manager =new TeacherManager();

        $response = $manager->getSetting('school_name');

        $this->assertEquals('NEUST Peñaranda Off Campus', $response);

    }
}
