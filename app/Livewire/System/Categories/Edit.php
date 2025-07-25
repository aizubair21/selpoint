<?php

namespace App\Livewire\System\Categories;

use App\Models\Category;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Illuminate\Support\Str;

#[Layout('layouts.app')]
class Edit extends Component
{
    public $cid;
    public $category, $categories;

    // #[On('mount')]
    public function mount()
    {
        $this->category = Category::find($this->cid)->load(['parent', 'children', 'products'])->toArray();
        $this->categories = Category::getAll();
        // dd($this->category);
        if (!$this->category) {
            $this->dispatch('error', 'Category not found.');
            return redirect()->route('categories.index');
        }
    }
    public function updateCategory()
    {
        $vlaidate = $this->validate([
            'category.name' => 'required|string|max:255',
            'category.slug' => 'required|string|max:255|unique:categories,slug,' . $this->cid,
            'category.belongs_to' => 'nullable|exists:categories,id',
        ]);

        // Update the category
        Category::where('id', $this->cid)->update([
            'name' => $vlaidate['category']['name'],
            'slug' => Str::slug($vlaidate['category']['name']),
            'belongs_to' => $vlaidate['category']['belongs_to'] ?? null,
        ]);
        $this->dispatch('success', 'Category updated successfully.');
        return redirect()->route('system.categories.index');
    }


    public function updated($propertyName)
    {
        $this->validate([
            'category.name' => 'required|string|max:255|unique:categories,name,' . $this->cid,
            'category.slug' => 'required|string|max:255|unique:categories,slug,' . $this->cid,
            'category.belongs_to' => 'nullable|exists:categories,id',
        ]);

        // create the slug instals the name is changed
        // if ($propertyName == 'category.name') {
        //     $this->category['slug'] = Str::slug(($this->category['name']));
        // }
    }

    public function render()
    {
        return view('livewire.system.categories.edit');
    }
}
