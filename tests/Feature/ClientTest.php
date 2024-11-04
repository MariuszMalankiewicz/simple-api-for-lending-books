<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Book;
use App\Models\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ClientTest extends TestCase
{
    use RefreshDatabase;

    public function test_clients_list()
    {
        Client::factory()->count(10)->create();

        $response = $this->getJson('/api/clients');

        $response->assertStatus(200)
                ->assertJsonCount(10);
    }

    public function test_client_details()
    {
        $client = Client::factory()->create();
        $books = Book::factory()->count(2)->create(['client_id' => $client->id, 'is_borrowed' => true]);

        $response = $this->getJson("/api/clients/{$client->id}");

        $response->assertStatus(200)
                ->assertJsonPath('id', $client->id)
                ->assertJsonCount(2, 'books');
    }
    public function test_create_client()
    {
        $data = ['first_name' => 'Jan', 'last_name' => 'Kowalski'];
    
        $response = $this->postJson('/api/clients', $data);
    
        $response->assertStatus(201)
                 ->assertJsonPath('first_name', 'Jan')
                 ->assertJsonPath('last_name', 'Kowalski');
    
        $this->assertDatabaseHas('clients', $data);
    }
    
    public function test_delete_client()
    {
        $client = Client::factory()->create();

        $response = $this->deleteJson("/api/clients/{$client->id}");

        $response->assertStatus(200)
                ->assertJson(['success' => 'Client deleted']);

        $this->assertDatabaseMissing('clients', ['id' => $client->id]);
    }


}
