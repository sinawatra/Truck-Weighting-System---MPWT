<?php

namespace Tests\Feature;

use Illuminate\Http\Request;
use Tests\TestCase;

class TruckSearchRouteTest extends TestCase
{
    public function test_search_route_resolves_to_search_controller_action(): void
    {
        $request = Request::create('/api/trucks/search', 'GET', ['plate_number' => 'ABC']);
        $route = $this->app['router']->getRoutes()->match($request);

        $this->assertSame('App\Http\Controllers\TruckController@search', $route->getActionName());
    }
}
