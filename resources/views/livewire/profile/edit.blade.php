<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
     <div class="">
        <div class="w-auto mx-auto px-2 space-y-6">
            <div class="sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    {{-- @include('profile.partials.update-profile-information-form') --}}
                    @livewire('profile.update-profile-information-form')
                </div>
            </div>

            <div class="sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    {{-- @include('profile.partials.update-password-form') --}}
                    @livewire('profile.update-password-form')
                </div>
            </div>

            <div class="sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    {{-- @include('profile.partials.delete-user-form') --}}
                    @livewire('profile.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</div>
