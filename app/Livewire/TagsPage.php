<?php

namespace App\Livewire;

use App\Models\Tag;
use Livewire\Component;

class TagsPage extends Component
{
  public $search = '';

  public function searchTag()
  {
    $this->render();
  }

  public function deleteTag($id)
  {
    Tag::where('id', $id)->delete();
    session()->flash('message', 'The tag was successfully deleted!');
    $this->searchTag();
  }

  public function clearSearch()
  {
    $this->search = '';
    $this->render();
  }

  public function render()
  {
    $tags = Tag::where('name', 'like', '%' . $this->search . '%')
      ->orderBy('created_at', 'desc')
      ->paginate(8);

    return view('livewire.tags-page', [
      'tags' => $tags
    ]);
  }
}
