<x-app-layout>
    <x-dashboard.page-header>
        User Update
    </x-dashboard.page-header>

    <x-dashboard.container>

        {{-- <x-dashboard.section>
            <x-dashboard.section.header>
                <x-slot name="title">
                    profile Infomation
                </x-slot>
                <x-slot name="content">
                   Update users profile information and email address
                </x-slot>
            </x-dashboard.section.header>
        </x-dashboard.section> --}}

        <form action="" method="post">
            @csrf
            <x-dashboard.section>
                <div class="row m-0">
                    <div class="col-lg-6">
                        <x-dashboard.section.inner>
                            <x-input-label>
                                Name
                            </x-input-label>
                            <x-text-input name="name" value="{{$user->name}}" aria-autocomplete="" autofocus class="w-full" />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
            
        
                            <x-input-label>
                                Email
                            </x-input-label>
                            <x-text-input name="email" value="{{$user->email}}" aria-autocomplete="" autofocus class="w-full" />
                            <x-input-error class="mt-2" :messages="$errors->get('email')" />
            
                            <x-primary-button>
                                Save
                            </x-primary-button> 
                        </x-dashboard.section.inner>
                    </div>
                    <div class="col-lg-6">
                        
                    </div>
                </div>
                </x-primary-button>
            </x-dashboard.section>
        </form>
    </x-dashboard.container>

    <x-dashboard.container>
        <x-dashboard.section>
            {{-- @include('profile.partials.update-profile-information-form') --}}
            <x-dashboard.section.header>
                <x-slot name="title">
                    Role and Permissions
                </x-slot>
                <x-slot name="content">
                    Define user role and given permissions for certain tasks
                </x-slot>
            </x-dashboard.section.header>

            <x-dashboard.section.inner>

            </x-dashboard.section.inner>
        </x-dashboard.section>
    </x-dashboard.container>
</x-app-layout>