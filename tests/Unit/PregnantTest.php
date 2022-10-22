<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use Tests\TestCase;

class PregnantTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_can_create_pregnant()
    {
        $formData = [
            "cui" => "123123123123",
            "nombres" => "Paola asdddddd",
            "apellidos" => "Lopez Garcia",
            "direccion" => "Segunda calle 11 avenida zona 3",
            "fecha_de_nacimiento" => "1990-12-12",
            "ultima_regla" => "2022-11-11",
            "peso" => "67",
            "altura" => "3.9",
            "id_user" => "2"
        ];

        $this->json('POST', route('pregnant.store'), $formData)
            ->assertStatus(201);
    }

    public function test_can_get_pregnant()
    {
        $this->get(route('pregnant.index'))
             ->assertStatus(200);
    }
}
