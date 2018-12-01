<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GarbageCreationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function admins_can_add_new_garbage_item()
    {
        $this->logInAdmin();

        $response = $this->post(route('garbage.store'), [
            'name' => 'Garbage name',
            'description' => 'Garbage description',
            'buy_price' => 1500,
            'sell_price' => 2000,
        ]);

        $response->assertRedirect(route('garbage.index'))
            ->assertSessionHas('success', __('garbage.success.create'));

        $this->assertDatabaseHas('garbages', [
            'name' => 'Garbage name',
            'description' => 'Garbage description',
            'buy_price' => 1500,
            'sell_price' => 2000,
        ]);
    }

    /** @test */
    public function name_is_required_when_creating_new_garbage()
    {
        $this->withExceptionHandling()->logInAdmin();

        $this->from(route('garbage.create'));

        $response = $this->post(route('garbage.store'), $this->validData([
            'name' => '',
        ]));

        $response->assertRedirect(route('garbage.create'))
            ->assertSessionHasErrors('name');

        $this->assertDatabaseMissing('garbages', [
            'description' => 'Garbage description',
            'buy_price' => 1500,
            'sell_price' => 2000,
        ]);
    }

    /** @test */
    public function buying_price_is_required_when_creating_garbage()
    {
        $this->withExceptionHandling()->logInAdmin();

        $this->from(route('garbage.create'));

        $response = $this->post(route('garbage.store'), $this->validData([
            'buy_price' => '',
        ]));

        $response->assertRedirect(route('garbage.create'))
            ->assertSessionHasErrors('buy_price');

        $this->assertDatabaseMissing('garbages', [
            'name' => 'Garbage name',
            'description' => 'Garbage description',
            'sell_price' => 2000,
        ]);
    }

    /** @test */
    public function buying_price_must_be_a_number_when_creating_garbage()
    {
        $this->withExceptionHandling()->logInAdmin();

        $this->from(route('garbage.create'));

        $response = $this->post(route('garbage.store'), $this->validData([
            'buy_price' => 'not a number',
        ]));

        $response->assertRedirect(route('garbage.create'))
            ->assertSessionHasErrors('buy_price');

        $this->assertDatabaseMissing('garbages', [
            'buy_price' => 'not a number',
        ]);
    }

    /** @test */
    public function selling_price_is_required_when_creating_garbage()
    {
        $this->withExceptionHandling()->logInAdmin();

        $this->from(route('garbage.create'));

        $response = $this->post(route('garbage.store'), $this->validData([
            'sell_price' => '',
        ]));

        $response->assertRedirect(route('garbage.create'))
            ->assertSessionHasErrors('sell_price');

        $this->assertDatabaseMissing('garbages', [
            'name' => 'Garbage name',
            'description' => 'Garbage description',
            'buy_price' => 1500,
        ]);
    }

    /** @test */
    public function selling_price_must_be_a_number_when_creating_garbage()
    {
        $this->withExceptionHandling()->logInAdmin();

        $this->from(route('garbage.create'));

        $response = $this->post(route('garbage.store'), $this->validData([
            'sell_price' => 'not a number',
        ]));

        $response->assertRedirect(route('garbage.create'))
            ->assertSessionHasErrors('sell_price');

        $this->assertDatabaseMissing('garbages', [
            'sell_price' => 'not a number',
        ]);
    }

    /** @test */
    public function guests_cannot_create_garbage()
    {
        $this->withExceptionHandling();
        $this->assertGuest();

        $response = $this->post(route('garbage.store'), []);

        $response->assertRedirect(route('login'));
    }

    protected function validData($overrides = [])
    {
        return array_merge([
            'name' => 'Garbage name',
            'description' => 'Garbage description',
            'buy_price' => 1500,
            'sell_price' => 2000,
        ], $overrides);
    }
}
