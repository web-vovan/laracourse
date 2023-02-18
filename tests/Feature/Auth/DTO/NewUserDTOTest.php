<?php

namespace Tests\Feature\Auth\DTO;

use App\Http\Requests\StoreRequest;
use Domain\Auth\DTO\NewUserDTO;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NewUserDTOTest extends TestCase
{
    use RefreshDatabase;

    public function test_instance_created_from_form_request(): void
    {
        $dto = NewUserDTO::fromRequest(new StoreRequest([
            'name' => 'test',
            'email' => self::TEST_USER_EMAIL,
            'password' => self::TEST_USER_PASSWORD,
        ]));

        $this->assertInstanceOf(NewUserDTO::class, $dto);
    }
}
