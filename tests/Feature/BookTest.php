<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Book;
use App\Models\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookTest extends TestCase
{
    use RefreshDatabase;

    public function test_books_list_with_pagination()
    {
        Book::factory()->count(25)->create();

        $response = $this->getJson('/api/books');

        $response->assertStatus(200)
                ->assertJsonCount(20, 'data');
    }
    public function test_book_details()
    {
        $book = Book::factory()->create();

        $response = $this->getJson("/api/books/{$book->id}");

        $response->assertStatus(200)
                ->assertJsonPath('id', $book->id)
                ->assertJsonPath('title', $book->title);
    }
    public function test_borrow_book()
    {
        $book = Book::factory()->create(['is_borrowed' => false]);
        $client = Client::factory()->create();
    
        $response = $this->postJson("/api/books/{$book->id}/borrow", ['client_id' => $client->id]);
    
        $response->assertStatus(200)
                 ->assertJson(['success' => 'Book borrowed successfully']);
    
        $this->assertDatabaseHas('books', [
            'id' => $book->id,
            'is_borrowed' => true,
            'client_id' => $client->id,
        ]);
    }

    public function test_return_book()
    {
        $client = Client::factory()->create();
        $book = Book::factory()->create(['is_borrowed' => true, 'client_id' => $client->id]);

        $response = $this->postJson("/api/books/{$book->id}/return");

        $response->assertStatus(200)
                ->assertJson(['success' => 'Book returned successfully']);

        $this->assertDatabaseHas('books', [
            'id' => $book->id,
            'is_borrowed' => false,
            'client_id' => null,
        ]);
    }

    
}