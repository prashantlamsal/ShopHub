<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('shows success alert when session has success message', function () {
    $response = $this->withSession(['success' => 'Test success message'])
                     ->get('/');

    $response->assertStatus(200);
    $response->assertSee('Test success message');
    $response->assertSee('alert-success');
});

it('shows error alert when session has error message', function () {
    $response = $this->withSession(['error' => 'Test error message'])
                     ->get('/');

    $response->assertStatus(200);
    $response->assertSee('Test error message');
    $response->assertSee('alert-error');
});

it('shows warning alert when session has warning message', function () {
    $response = $this->withSession(['warning' => 'Test warning message'])
                     ->get('/');

    $response->assertStatus(200);
    $response->assertSee('Test warning message');
    $response->assertSee('alert-warning');
});

it('shows info alert when session has info message', function () {
    $response = $this->withSession(['info' => 'Test info message'])
                     ->get('/');

    $response->assertStatus(200);
    $response->assertSee('Test info message');
    $response->assertSee('alert-info');
}); 