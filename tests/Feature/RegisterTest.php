<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Jobs\CreateUserMailbox;
use App\Jobs\CreateMusicBotUser;
use Biscolab\ReCaptcha\Facades\ReCaptcha;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    private function validUser(array $overrides = [])
    {
        return array_merge([
            'username' => $this->faker->userName,
            'email' => $this->faker->email,
            'password' => 'password',
            'password_confirmation' => 'password',
        ], $overrides);
    }

    public function testCanRegisterWithValidEmailAndPassword()
    {
        $this->expectsJobs(CreateUserMailbox::class);
        $this->expectsJobs(CreateMusicBotUser::class);
        ReCaptcha::shouldReceive('validate')->andReturn(true);

        $response = $this->post('/register', $this->validUser());
        $response->assertRedirect(route('dashboard'));
        $this->assertAuthenticated();
    }

    /**
     * @dataProvider requiredAttributesProvider
     */
    public function testRequiredAttributes(string $attribute)
    {
        ReCaptcha::shouldReceive('validate')->andReturn(true);
        $response = $this->post('/register', $this->validUser([$attribute => '']));
        $response->assertSessionHasErrors($attribute);
    }

    public function requiredAttributesProvider()
    {
        yield ['username'];
        yield ['email'];
        yield ['password'];
    }

    public function testReCaptchaRequired()
    {
        ReCaptcha::shouldReceive('validate')->andReturn(false);
        $response = $this->post('/register', $this->validUser());
        $response->assertSessionHasErrors(recaptchaFieldName());
    }
}
