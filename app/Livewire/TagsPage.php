<?php

namespace App\Livewire;

use App\Models\Tag;
use Livewire\Component;

class TagsPage extends Component
{
  public $tags_data;
  public $search = '';
  public $count;
  public function mount()
  {
    $this->tags_data = Tag::all();
    
    $this->count = $this->tags_data->count();
  }

  public function deleteTag($id)
  {
    Tag::where('id', $id)->delete();
    session()->flash('message', 'The tag was successfully deleted!');
    $this->searchTag();
  }
  public function searchTag()
  {
    // Tìm kiếm các tag theo giá trị search
    $this->tags_data = Tag::where('name', 'like', '%' . $this->search . '%')->get();
    $this->count = $this->tags_data->count();
  }
  public function clearSearch()
  {
    $this->search = '';
    $this->searchTag();
  }
  public function render()
  {
    return view('livewire.tags-page', [
      'tags' => $this->tags_data,
      'count' => "$this->count"
    ]);
  }
}
