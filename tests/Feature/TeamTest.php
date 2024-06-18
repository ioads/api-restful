<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Team;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TeamTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_teams_index_route_returns_a_successful_response(): void
    {
        $user = User::factory()->create();
        $token = $user->createToken('TestToken')->plainTextToken;

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'X-Authorization' => $token,
            'Accept' => 'application/json',
            'Content-Type' => 'application/json'
        ])->get('/api/teams');

        $response->assertStatus(200)
                ->assertJsonStructure([
                    [
                        'id',
                        'api_id',
                        'conference',
                        'division',
                        'city',
                        'name',
                        'full_name',
                        'abbreviation',
                    ]
                ]);

        $user->delete();
    }

    public function test_if_user_without_privilege_can_not_delete_a_team()
    {
        $team = Team::first();
        $user = User::factory()->create(['role' => 'user']);
        $token = $user->createToken('TestToken')->plainTextToken;

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'X-Authorization' => $token,
            'Accept' => 'application/json',
            'Content-Type' => 'application/json'
        ])->delete('/api/teams/'.$team->id);

        $response->assertStatus(403);

        $user->delete();
    }

    public function test_if_user_with_privilege_can_delete_a_team()
    {
        $team = Team::first();
        $user = User::factory()->create(['role' => 'admin']);
        $token = $user->createToken('TestToken')->plainTextToken;

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'X-Authorization' => $token,
            'Accept' => 'application/json',
            'Content-Type' => 'application/json'
        ])->delete('/api/teams/'.$team->id);

        $response->assertStatus(200);

        $user->delete();
    }
}
