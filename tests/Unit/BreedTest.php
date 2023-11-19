<?php
namespace Tests\Unit;

use App\Models\Breed;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BreedTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_breed(): void
    {
        $breed = Breed::factory()->create([
            'name' => 'Siamese',
            'description' => 'A Siamese cat',
            'average_life_expectancy' => 15
        ]);

        $this->assertDatabaseHas('breeds', [
            'name' => 'Siamese',
            'description' => 'A Siamese cat',
            'average_life_expectancy' => 15
        ]);
    }
}
