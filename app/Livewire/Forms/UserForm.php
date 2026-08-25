<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Validate;
use Livewire\Form;

class UserForm extends Form
{
    public ?User $user = null;

    #[Validate]
    public string $name = '';

    #[Validate]
    public string $email = '';

    public string $password = '';  
    public string $password_confirmation = '';    

    public string $current_password = '';         
    public string $new_password = '';             
    public string $new_password_confirmation = ''; 

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:255'],

            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore($this->user),
            ],

            'password' => [
                $this->user ? 'nullable' : 'required', 
                'string',
                'min:8',
                'confirmed',
            ],

            'current_password' => [
                'required_with:new_password',
                function ($attribute, $value, $fail) {
                    if (filled($this->new_password) && !Hash::check($value, $this->user->password)) {
                        $fail('Password lama tidak cocok.');
                    }
                },
            ],

            'new_password' => [
                'nullable',
                'string',
                'min:8',
                'confirmed',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'     => 'Nama akun harus diisi',
            'name.min'          => 'Nama minimal 3 karakter',
            'email.required'    => 'Email harus diisi',
            'email.email'       => 'Format email tidak valid',
            'email.unique'      => 'Email sudah digunakan',
            'password.required' => 'Password harus diisi',
            'password.min'      => 'Password minimal 8 karakter',
            'password.confirmed' => 'Konfirmasi password tidak sesuai',
            'current_password.required_with'   => 'Password lama harus diisi jika ingin mengubah password',
            'new_password.min'                 => 'Password baru minimal 8 karakter',
            'new_password.confirmed'           => 'Konfirmasi password baru tidak cocok',
        ];
    }

    public function setUser(User $user): void
    {
        $this->user = $user;

        $this->name  = $user->name;
        $this->email = $user->email;
    }

    public function store(): void
    {
        $this->validate();

        User::create([
            'name'     => $this->name,
            'email'    => $this->email,
            'password' => Hash::make($this->password),
        ]);

        $this->reset(); 
    }

    public function update(): void
    {
        $this->validate();

        $data = [
            'name'  => $this->name,
            'email' => $this->email,
        ];

        if (filled($this->new_password)) {
            $data['password'] = Hash::make($this->new_password);
        }

        $this->user->update($data);
    }
}