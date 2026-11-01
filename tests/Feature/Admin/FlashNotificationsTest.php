<?php

namespace Tests\Feature\Admin;

use Flasher\Toastr\Laravel\Facade\Toastr;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class FlashNotificationsTest extends TestCase
{
    public function test_toastr_notifications_are_rendered_in_html_responses(): void
    {
        Route::middleware('web')->post('/_tests/toastr-notification', function () {
            Toastr::success('Employee added successfully');

            return redirect('/_tests/toastr-notification/result');
        });

        Route::middleware('web')->get('/_tests/toastr-notification/result', function () {
            return response('<!doctype html><html><head></head><body>Page content</body></html>');
        });

        $this->post('/_tests/toastr-notification')
            ->assertRedirect('/_tests/toastr-notification/result');

        $this->get('/_tests/toastr-notification/result')
            ->assertOk()
            ->assertSee('Employee added successfully')
            ->assertSee('/vendor/flasher/flasher.min.js');
    }
}
