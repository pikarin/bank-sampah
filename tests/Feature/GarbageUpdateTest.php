<?php

namespace Tests\Feature;

use App\Garbage;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GarbageUpdateTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function admins_can_update_existed_garbage()
    {
        $this->logInAdmin();

        $garbage = factory(Garbage::class)->create($this->validData());

        $response = $this->put(route('garbage.update', $garbage), [
            'name' => 'updated name',
            'description' => 'updated description',
            'buy_price' => 1500,
            'sell_price' => 1800,
        ]);

        $response->assertRedirect(route('garbage.index'))
            ->assertSessionHas('success', __('garbage.update.success'));

        tap($garbage->fresh(), function ($garbage) {
            $this->assertEquals('updated name', $garbage->name);
            $this->assertEquals('updated description', $garbage->description);
            $this->assertEquals(1500, $garbage->buy_price);
            $this->assertEquals(1800, $garbage->sell_price);
        });
    }

    /** @test */
    public function name_is_required_when_updating_garbage()
    {
        $this->withExceptionHandling()->logInAdmin();

        $garbage = factory(Garbage::class)->create([
            'name' => 'Old name'
        ]);

        $response = $this->from(route('garbage.edit', $garbage))
            ->sendUpdateRequest($garbage, ['name' => '']);

        $response->assertRedirect(route('garbage.edit', $garbage));
        $response->assertSessionHasErrors('name');

        $this->assertEquals('Old name', $garbage->fresh()->name);
    }

    /** @test */
    public function buying_price_is_required_when_updating_garbage()
    {
        $this->withExceptionHandling()->logInAdmin();

        $garbage = factory(Garbage::class)->create([
            'buy_price' => 1000
        ]);

        $response = $this->from(route('garbage.edit', $garbage))
            ->sendUpdateRequest($garbage, ['buy_price' => '']);

        $response->assertRedirect(route('garbage.edit', $garbage));
        $response->assertSessionHasErrors('buy_price');

        $this->assertEquals(1000, $garbage->fresh()->buy_price);
    }

    /** @test */
    public function buying_price_must_be_numeric_when_updating_garbage()
    {
        $this->withExceptionHandling()->logInAdmin();

        $garbage = factory(Garbage::class)->create([
            'buy_price' => 1000
        ]);

        $response = $this->from(route('garbage.edit', $garbage))
            ->sendUpdateRequest($garbage, ['buy_price' => 'not numeric']);

        $response->assertRedirect(route('garbage.edit', $garbage));
        $response->assertSessionHasErrors('buy_price');

        $this->assertEquals(1000, $garbage->fresh()->buy_price);
    }

    /** @test */
    public function selling_price_is_required_when_updating_garbage()
    {
        $this->withExceptionHandling()->logInAdmin();

        $garbage = factory(Garbage::class)->create([
            'sell_price' => 1200
        ]);

        $response = $this->from(route('garbage.edit', $garbage))
            ->sendUpdateRequest($garbage, ['sell_price' => '']);

        $response->assertRedirect(route('garbage.edit', $garbage));
        $response->assertSessionHasErrors('sell_price');

        $this->assertEquals(1200, $garbage->fresh()->sell_price);
    }

    /** @test */
    public function selling_price_must_be_numeric_when_updating_garbage()
    {
        $this->withExceptionHandling()->logInAdmin();

        $garbage = factory(Garbage::class)->create([
            'sell_price' => 1200
        ]);

        $response = $this->from(route('garbage.edit', $garbage))
            ->sendUpdateRequest($garbage, ['sell_price' => 'not numeric']);

        $response->assertRedirect(route('garbage.edit', $garbage));
        $response->assertSessionHasErrors('sell_price');

        $this->assertEquals(1200, $garbage->fresh()->sell_price);
    }

    /** @test */
    public function guests_cannot_update_garbage()
    {
        $this->withExceptionHandling();
        $this->assertGuest();

        $garbage = factory(Garbage::class)->create();

        $response = $this->put(route('garbage.update', $garbage), []);

        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function admins_cannot_update_non_existing_garbage()
    {
        $this->withExceptionHandling()->logInAdmin();

        $response = $this->sendUpdateRequest('not-existed-garbage');

        $response->assertNotFound();
    }

    protected function sendUpdateRequest($garbage, $data = [])
    {
        return $this->put(
            route('garbage.update', $garbage),
            $this->validData($data)
        );
    }

    protected function validData($overrides = [])
    {
        return array_merge([
            'name' => 'updated name',
            'description' => 'updated description',
            'buy_price' => 1500,
            'sell_price' => 1800,
        ], $overrides);
    }
}
