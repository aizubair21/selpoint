<div>
    {{-- The whole world belongs to you. --}}
    <form wire:submit.prevent="save">
        <x-dashboard.container>
            <x-dashboard.section>
                <x-dashboard.section.header>
                    <x-slot name="title">
                        Category
                    </x-slot>
                    <x-slot name="content">
                        Get a new category.
                    </x-slot>
                </x-dashboard.section.header>

                <x-dashboard.section.inner>
                    <x-input-field name="name" class="md:flex" labelWidth="250px" wire:model.live="name" error="name" label="Your Category Name" />
                    <x-hr/>
                    <x-input-file label="Parent" error="image" >
                        <select wire:model.live="parent_id" class="rounded border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                            <option value="">Select Parent Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                
                                @foreach ($category->children as $child)
                                    <option value="{{ $child->id }}"> -- {{ $child->name }}</option>

                                        @foreach ($child->children as $item)
                                            <option disabled value="{{ $item->id }}"> ---- {{ $item->name }}</option>
                                        @endforeach
                                @endforeach
                            @endforeach
                        </select>
                    </x-input-file>
                    <x-hr/>
                    <x-input-file label="Category Image" error="image" >
                        <input type="file" class="rounded border" wire:model.live="image" id="">
                    </x-input-file>
                    <x-primary-button>
                        save
                    </x-primary-button>
                </x-dashboard.section.inner>
            </x-dashboard.section>
        </x-dashboard.container>
    </form>
</div>
