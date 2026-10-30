<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response
            ->assertOk()
            ->assertSee('Good morning, Farhad')
            ->assertSee('Recent orders')
            ->assertSee('Revenue overview')
            ->assertSee(now()->format('l, F j'))
            ->assertSee('data-theme-toggle', false)
            ->assertSee('northstar-theme', false)
            ->assertSee('data-sidebar-toggle', false);
    }
}
