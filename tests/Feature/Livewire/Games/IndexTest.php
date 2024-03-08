<?php

namespace Tests\Feature\Livewire\Games;

use App\Livewire\Games\AllMatches;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class IndexTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(AllMatches::class)
            ->assertStatus(200);
    }
}
