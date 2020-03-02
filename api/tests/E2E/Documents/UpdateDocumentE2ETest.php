<?php

namespace Tests\E2E;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Docuco\Domain\Documents\Collections\DocumentCollection;
use Docuco\Domain\Documents\Entities\Document;
use Faker;

class UpdateDocumentE2ETest extends TestCase
{
    use DatabaseTransactions;

    public function test_return_error_message_when_user_not_logged()
    {
        $document_id = 1;
        $response = $this->json('PUT', '/api/documents/' . $document_id);

        $response
            ->assertStatus(401)
            ->assertExactJson(['message' => 'Unauthenticated.']);
    }

    // public function test_return_error_message_when_user_update_document_that_not_have()
    // {
    //     $users_group = create_users_group();
    //     $document = create_document($users_group->id);
    //     [$user, $token] = get_user_and_token_after_login($this);

    //     $response = $this->make_put_petition($token, $document->id, (array) $document);
        
    //     $response
    //         ->assertStatus(404)
    //         ->assertExactJson(['message' => 'Document not exist.']);
    // }

    public function test_return_error_message_when_user_update_document_with_diferent_id()
    {
        [$users_group, $document, $user, $token] = get_user_group_document_user_and_token_after_login($this);
        $document_to_update = $this->get_random_document_for_id($document->id);

        $response = $this->make_put_petition($token, $document->id + 1, $document_to_update);
        
        $response
            ->assertStatus(400)
            ->assertExactJson(['message' => 'Document id on object not match with id in url.']);
    }

    // public function test_update_document_when_user_have_this_document()
    // {
    //     [$users_group, $document, $user, $token] = get_user_group_document_user_and_token_after_login($this);
    //     $document_to_update = $this->get_random_document_for_id($document->id);

    //     $response = $this->make_put_petition($token, $document->id, $document_to_update);
        
    //     $response
    //         ->assertStatus(200)
    //         ->assertExactJson(['document' => $document_to_update]);
    // }

    private function make_put_petition($token = '', $document_id = 1, $data_to_update = [])
    {
        $endpoint = '/api/documents/' . $document_id;
        return $this->withHeaders(['Authorization' => 'Bearer ' . $token])
            ->json('PUT', $endpoint, $data_to_update);
    }

    private function get_random_document_for_id(int $document_id)
    {
        $faker = Faker\Factory::create();

        return [
            'id' => $document_id,
            'name' => $faker->word,
            'description' => $faker->text(200),
            'price' => $faker->randomFloat,
            'url' => $faker->imageUrl,
            'date_of_issue' => $faker->date()
        ];
    }
}
