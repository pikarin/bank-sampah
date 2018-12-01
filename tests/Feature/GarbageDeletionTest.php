<?php

namespace Tests\Feature;

use App\Garbage;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GarbageDeletionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function admins_can_delete_existed_garbage()
    {
        $this->logInAdmin();

        $garbage = factory(Garbage::class)->create();

        $response = $this->delete(route('garbage.destroy', $garbage));

        $response->assertRedirect(route('garbage.index'))
            ->assertSessionHas('success', __('garbage.delete.success'));

        $this->assertFalse($garbage->exists());
    }

    /** @test */
    public function admins_cannot_delete_non_existed_garbage()
    {
        $this->withExceptionHandling()->logInAdmin();

        $garbage = factory(Garbage::class)->create();

        $this->delete(route('garbage.destroy', 'non-existed-garbage'))
            ->assertNotFound();

        $this->assertTrue($garbage->exists());
    }
}
