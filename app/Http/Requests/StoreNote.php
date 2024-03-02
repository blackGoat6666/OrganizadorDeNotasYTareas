<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNote extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
        ];
    }

    public function persist(): Note
    {
        $user = $this->user(); // Obtener el usuario autenticado
        $note = new Note(); // Crear una nueva instancia de la clase Note
        $note->text = $this->text; // Establecer el texto de la nota
        $note->user_id = $user->id; // Establecer el ID del usuario en la nota
        $note->save(); // Guardar la nota en la base de datos

        return $note; // Devolver la nota guardada
    }
}
