<?php

namespace App\Livewire;

use App\Models\Tag;
use Livewire\Component;

class EditTag extends Component
{
    public Tag $tag;
    public $tag_name;
    public function mount($tag_data)
    {
        $this->tag = $tag_data;
        $this->tag_name = $tag_data->name;
    }

    public function update()
    {
        // update data to database
        $this->validate([
            'tag_name' => 'required',
        ]);
        Tag::where('id', $this->tag->id)->update([
            'name' => $this->tag_name,
        ]);

        session()->flash('message', 'The tag was successfully updated!');
        return $this->redirect('/admin/tag', navigate: true);
    }
    public function render()
    {
        return view('livewire.edit-tag');
    }
}
