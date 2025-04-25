<div>
    {{-- Stop trying to control. --}}
    <x-dashboard.page-header>
        Product Edit
    </x-dashboard.page-header>


    <x-dashboard.container>
        <x-dashboard.section>

            <x-dashboard.section.header>
                <x-slot name="title">
                    {{$products['title'] ?? "N/A"}}
                </x-slot>

                <x-slot name="content">
                    <div>
                        {{$products['status'] ? "Active" : "Drafted"}} | {{$products['created_at']->diffForHumans()}}
                    </div>

                    <div class="text-sm">
                        category : <strong> {{$products['category']?->name ?? "N/A"}} </strong>
                    </div>
                </x-slot>
            </x-dashboard.section.header>

            <x-dashboard.section.inner>
                <form wire:submit.prevent="save">
                    <x-text-input wire:model.live="data.name" />
                    <x-primary-button>save</x-primary-button>
                </form>
            </x-dashboard.section.inner>
        </x-dashboard.section>
    </x-dashboard.container>
</div>
