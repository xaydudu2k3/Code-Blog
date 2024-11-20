<?php

namespace App\Livewire;

use App\Models\Tag;
use Livewire\Component;

class CreateTag extends Component
{
    public $tag_name = '';
    public function save()
    {
        $this->validate([
            'tag_name' => 'required'
        ]);

        $createTag = new Tag;
        $createTag->name = $this->tag_name;
        $createTag->save();

        $this->tag_name = '';
        session()->flash('message', 'The tag was successfully created!');
        $this->redirect('/admin/tag', navigate: true);
    }
    public function render()
    {
        return view('livewire.create-tag');
    }
}
