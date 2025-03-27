<x-app-layout>
    <x-dashboard.page-header>
        Role Edit  
    </x-dashboard.page-header>

    <x-dashboard.container>
        <x-dashboard.section>
            <x-dashboard.section.header>
                <x-slot name="title">
                    <strong class="text-lg">
                        {{Str::upper($role->name) ?? 'Not Found'}}
                    </strong>
                </x-slot>
                <x-slot name="content">
                    Edit your {{$role->name}} role. add or remove permission from all ({{$role->permissions?->count()}}) Permissiions. 
                </x-slot>
            </x-dashboard.section.header>
        </x-dashboard.section>
    </x-dashboard.container>

    <x-dashboard.container>
        <x-dashboard.section>
            <x-dashboard.section.header>
                <x-slot name="title">
                    Permissions
                </x-slot>
                <x-slot name="content">
                    <p>
                        add or remove permission from all ({{$role->permissions?->count()}}) Permissiions. 
                    </p>
                </x-slot>
            </x-dashboard.section.header>

            <x-dashboard.section.inner>
                <div style="display: grid; grid-template-columns:repeat(auto-fit, minmax(250px, 1fr)); gap: 10px;">
                    @foreach ($role->permissions as $perm)
                        
                        {{-- @if (Str::startsWith('role_', ))
                            
                        @endif --}}
                        <div class="flex items-center space-x-2">
                            <x-text-input type='checkbox' id="perm_{{$perm->id}}" :value="$perm->id" />
                            <x-input-label class="text-md p-0 m-0 pl-3" id="perm_{{$perm->id}}"> {{$perm->name ?? "Not Found!"}} </x-input-label>
                        </div>
                    @endforeach
                </div>
            </x-dashboard.section.inner>
        </x-dashboard.section>
    </x-dashboard.container>
</x-app-layout>