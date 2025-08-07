<div x-init="$wire.getDeta" >
    <div class=" rounded w-full bg-white text-center" x-loading.disabled>
        <div class="border border-green-900 rounded md:flex justify-between items-start p-2">
            <div class="px-3 py-1 lg:p-3 bold text-center flex justify-between items-center md:block">
                <div class="fs-5 fw-bold text-start w-full">
                    <a href="" class="flex items-center"> 
                        <i class="fas fa-store fs-6 p-2"></i>
                        Store
                    </a>
                </div>
                {{-- <x-primary-button x-on:click="$dispatch('open-modal', 'add-store-coin')">
                    <i class="fa fa-plus"></i>
                </x-primary-button> --}}
            </div>
            <div class="px-3 text-center py-1 lg:p-3  text-lg fw-bold text-green-900" >
                {{-- {{$store->coin}} --}}
                <div class="font-bold px-2 border rounded">
                    {{$store}}
                </div>

                <div class=" py-2">
                    
                    <div class="flex justify-center items-center text-xs">
                        <div class="text-start text-red-900" style="color:red">
                            {{-- {{$withdraw? $withdraw->sum('amount') : '0'}} --}}
                            {{$give}}
                            <i class="fas fa-long-arrow-alt-up"></i>
                        </div>
                        <div class="px-3">
                            |
                        </div>
                        <div class="text-green-900" style="color:green">
                            <i class="fas fa-long-arrow-alt-down"></i>
                            {{$take}}
                            {{-- {{$deposit ? $deposit->sum('amount') : "0"}} --}}
                        </div>
                    </div>

                </div>  
            </div>

            <div class="px-3 py-1 lg:p-3 text-end">
                    
                <div class="flex items-center text-xs">
                    <div class="text-start text-red-900" style="color:red">
                        {{-- {{$withdraw? $withdraw->count() : '0'}} --}}
                        <i class="fas fa-long-arrow-alt-up"></i>
                    </div>
                    <div class="px-3">
                        |
                    </div>
                    <div class="text-green-900" style="color:green">
                        <i class="fas fa-long-arrow-alt-down"></i>
                        {{-- {{$deposit ? $deposit->count() : "0"}} --}}
                    </div>
                </div>
            </div>  

        </div>

    </div>


    <x-modal name="add-store-coin">
        <x-dashboard.section>
            <x-dashboard.section.header>
                <x-slot name="title">
                    Add Ammount
                </x-slot>
                <x-slot name="content">
                    add ammount to your system store to balance the store point. 
                </x-slot>
            </x-dashboard.section.header>
            <x-dashboard.section.inner>
                <div>
                    <x-input-label value="Ammount" />
                    <x-text-input wire:model.live="ammount" type="number" min="1"  class="w-full" placeholder="Enter Amount ....." />
                </div>
                <br>
                <x-primary-button wire:show="ammount" wire:transaction type="button" wire:click="addAmmountToStore">Store</x-primary-button>
            </x-dashboard.section.inner>
        </x-dashboard.section>
    </x-modal>
</div>
