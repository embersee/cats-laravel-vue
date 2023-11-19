<?php
namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Breed;
use Tests\TestCase;

class CatTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_cat(): void
    {
        // созданим породу для кошки
        $breed = Breed::factory()->create();

        $response = $this->postJson('/api/cats', [
            'name' => 'Whiskers',
            'age' => 3,
            'breed_id' => $breed->id,
            'image' => 'https://http.cat/images/202.jpg'
        ]);

        $response->assertStatus(201);
        $response->assertJsonPath('name', 'Whiskers');
    }
}
