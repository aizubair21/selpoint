<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
    <x-dashboard.page-header>
            {{$rider->user?->name ?? "N/A" }}
        <br> 
        <div class="text-sm mt-3">
            <div class="px-2 inline-flex py-1 rounded shadow-sm border mr-2 ">
                {{$rider->status}} 
            </div>
            {{$rider->area_condition}}, {{$rider->targeted_area ?? '' }}
        </div>
        <div class="text-red">
            {{$rider->rejected_for}}
        </div>
    </x-dashboard.page-header>

    <x-dashboard.container>
        <x-dashboard.section>
            <x-dashboard.section.header>
                <x-slot name="title">
                    Rider Upate - Delevary Man
                </x-slot>
                <x-slot name='content'>
                    <x-nav-link :active="$nav =='user'" href="?nav=user" >User</x-nav-link>
                    <x-nav-link :active="$nav =='document'" href="?nav=document" >Documents</x-nav-link>
                    <x-nav-link :active="$nav =='delevary'" href="?nav=delevary" >Delevary</x-nav-link>
                    <x-hr />
                    <div>
                        <form action="">

                            <div class="flex" x-data="{sd : 'Active'}">

                                <div >
                                    <select id="" x-model="sd" class="rounded-lg py-1" >
                                        <option value="Select Status">-- Select -- </option>
                                        <option @selected($rider->status == 'Active') value="Active">Active</option>
                                        <option @selected($rider->status == 'Pending') value="Pending">Pending</option>
                                        <option @selected($rider->status == 'Disabled') value="Disabled">Disabled</option>
                                        <option @selected($rider->status == 'Suspended') value="Suspended">Suspended</option>
                                    </select>
        
                   
                                    <div class="mt-1" x-show="sd != 'Active'">
                                        <textarea class="rounded-lg" name="" id="" rows="2"></textarea>
                                    </div>
                                    
                                </div>
                                <div>
                                    <x-primary-button class="ml-2">set</x-primary-button>
                                </div>
                            </div>
                        </form>
                    </div>
                </x-slot>
            </x-dashboard.section.header>
        </x-dashboard.section>

        @if ($nav == 'document')
            <x-dashboard.section>
                <x-dashboard.section.header>
                    <x-slot name="title">
                        Submitted Documents
                    </x-slot>
                    <x-slot name="content"></x-slot>
                </x-dashboard.section.header>

                <x-dashboard.section.inner>
                    <x-hr/>
                    <x-input-file label="Rider Phone" name="phone" error="phone">
                        <x-text-input type="text" name="phone" value="{{$rider->phone ?? '' }}" />
                    </x-input-file>
                    <x-hr/>
                    <x-input-file label="Rider Email" name="email" error="email">
                        <x-text-input type="text" name="email" value="{{$rider->email ?? '' }}" />
                    </x-input-file>
                    <x-hr/>
                    <x-input-file label="Rider NID" name="nid" error="nid">
                        <x-text-input type="text" name="nid" value="{{$rider->nid ?? '' }}" />
                    </x-input-file>
                    <x-hr/>
                    <x-input-file label="Rider Photo Front" name="nid_photo_front" error="nid_photo_front">

                        <div class="flex">
                            <x-image src="{{asset('storage/'. $rider->nid_photo_front ?? '')}}" alt="nid_photo_front" />
                            <x-image src="{{asset('storage/'. $rider->nid_photo_back ?? '')}}" alt="nid_photo_back" />
                        </div>
                    </x-input-file>
                </x-dashboard.section.inner>
            </x-dashboard.section>


            <x-dashboard.section>
                <x-dashboard.section.header>
                    <x-slot name="title">
                        Rider Address and Area
                    </x-slot>
                    <x-slot name='content'>
                        See the rider areas about the rider address
                    </x-slot>
                </x-dashboard.section.header>

                <x-dashboard.section.inner>
                    <x-input-file label="Rider Present Address" name="nid" error="nid">
                            <div>
                                {{$rider->current_address ?? '' }}
                            </div>
                    </x-input-file>
                    <x-hr/>
                    <x-input-file label="Rider Permanent Address" name="nid" error="nid">
                            <div>
                                {{$rider->fixed_address ?? '' }}
                            </div>
                    </x-input-file>
                    <x-hr/>
                    <x-input-file label="Rider Targetted Area" name="nid" error="nid">
                            <div>
                                {{$rider->area_condition}}, {{$rider->targeted_area ?? '' }}
                            </div>
                          
                    </x-input-file>
                    <x-hr/>
                </x-dashboard.section.inner>
            </x-dashboard.section>
        @endif
        
    </x-dashboard.container>
    @if ($nav == 'user')
        @livewire('system.users.edit', ['id' => $rider->user?->id], key($rider->user?->id))
    @endif
    
</div>
