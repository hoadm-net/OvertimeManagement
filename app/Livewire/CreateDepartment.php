<?php

namespace App\Livewire;

use App\Models\Department;
use LivewireUI\Modal\ModalComponent;

class CreateDepartment extends ModalComponent
{
    public $name;
    public $description;

    protected $rules = [
        'name' => 'required|unique:departments,name',
        'description' => 'nullable',
    ];

    public function submit()
    {
        $this->validate();

        Department::create([
            'name' => $this->name,
            'description' => $this->description,
        ]);

        return $this->redirect('/department');
    }

    public function render()
    {
        return view('livewire.create-department');
    }

    public static function modalMaxWidth(): string
    {
        return '2xl';
    }
}
