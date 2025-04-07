<div>
    <!-- Simplicity is the ultimate sophistication. - Leonardo da Vinci -->

    @php
        // $permissions = DB::table('permissions')->get();
    @endphp
        <div style="display: grid; grid-template-columns:repeat(auto-fit, minmax(250px, 1fr)); gap: 10px;">
            <div>
                <x-input-label>
                    Role
                </x-input-label>
                @foreach ($permissions as $permission)
                    @php
                        $chk = false;
                        if (isset($userPermissions)){
                            if($userPermissions->contains($permission->name)){
                                $chk = true;
                            }
                        }
                    @endphp
                        
                    @if (Str::startsWith($permission->name, 'role_'))
                        {{-- {{$permission->name}} --}}
                        
                        
                        <div>
                            <x-text-input class="m-0" :checked="$chk" type="checkbox" name="permissions[]" id="perm_{{$permission->id}}" value="{{$permission->name}}" />
                            <label class="pl-3 text-sm" for="perm_{{$permission->id}}">{{$permission->name}}</label>     
                        </div>
                    @endif
                @endforeach
            </div>
            
            {{-- permission  --}}
            <div>
                <x-input-label>
                    Permission
                </x-input-label>
                @foreach ($permissions as $permission)
                    @php
                        $chk = false;
                        if (isset($userPermissions)){
                            if($userPermissions->contains($permission->name)){
                                $chk = true;
                            }
                        }
                    @endphp
                        
                    @if (Str::startsWith($permission->name, 'permission'))
                        {{-- {{$permission->name}} --}}
                        
                        
                        <div>
                            <x-text-input class="m-0" :checked="$chk" type="checkbox" name="permissions[]" id="perm_{{$permission->id}}" value="{{$permission->name}}" />
                            <label class="pl-3 text-sm" for="perm_{{$permission->id}}">{{$permission->name}}</label>     
                        </div>
                    @endif
                @endforeach
            </div>

            {{-- access  --}}
            <div>
                <x-input-label>
                    Access
                </x-input-label>
                @foreach ($permissions as $permission)
                    @php
                        $chk = false;
                        if (isset($userPermissions)){
                            if($userPermissions->contains($permission->name)){
                                $chk = true;
                            }
                        }
                    @endphp
                        
                    @if (Str::startsWith($permission->name, 'access'))
                        {{-- {{$permission->name}} --}}
                        
                        
                        <div>
                            <x-text-input class="m-0" :checked="$chk" type="checkbox" name="permissions[]" id="perm_{{$permission->id}}" value="{{$permission->name}}" />
                            <label class="pl-3 text-sm" for="perm_{{$permission->id}}">{{$permission->name}}</label>     
                        </div>
                    @endif
                @endforeach
            </div>

            {{-- sync  --}}
            <div>
                <x-input-label>
                    Sync
                </x-input-label>
                @foreach ($permissions as $permission)
                    @php
                        $chk = false;
                        if (isset($userPermissions)){
                            if($userPermissions->contains($permission->name)){
                                $chk = true;
                            }
                        }
                    @endphp
                        
                    @if (Str::startsWith($permission->name, 'sync'))
                        {{-- {{$permission->name}} --}}
                        
                        
                        <div>
                            <x-text-input class="m-0" :checked="$chk" type="checkbox" name="permissions[]" id="perm_{{$permission->id}}" value="{{$permission->name}}" />
                            <label class="pl-3 text-sm" for="perm_{{$permission->id}}">{{$permission->name}}</label>     
                        </div>
                    @endif
                @endforeach
            </div>


            {{-- admin  --}}
            <div>
                <x-input-label>
                    Admin
                </x-input-label>
                @foreach ($permissions as $permission)
                    @php
                        $chk = false;
                        if (isset($userPermissions)){
                            if($userPermissions->contains($permission->name)){
                                $chk = true;
                            }
                        }
                    @endphp
                        
                    @if (Str::startsWith($permission->name, 'admin'))
                        {{-- {{$permission->name}} --}}
                        
                        
                        <div>
                            <x-text-input class="m-0" :checked="$chk" type="checkbox" name="permissions[]" id="perm_{{$permission->id}}" value="{{$permission->name}}" />
                            <label class="pl-3 text-sm" for="perm_{{$permission->id}}">{{$permission->name}}</label>     
                        </div>
                    @endif
                @endforeach
            </div>

            {{-- vendors  --}}
            <div>
                <x-input-label>
                    Vendors
                </x-input-label>
                @foreach ($permissions as $permission)
                    @php
                        $chk = false;
                        if (isset($userPermissions)){
                            if($userPermissions->contains($permission->name)){
                                $chk = true;
                            }
                        }
                    @endphp
                        
                    @if (Str::startsWith($permission->name, 'vendors'))
                        {{-- {{$permission->name}} --}}
                        
                        
                        <div>
                            <x-text-input class="m-0" :checked="$chk" type="checkbox" name="permissions[]" id="perm_{{$permission->id}}" value="{{$permission->name}}" />
                            <label class="pl-3 text-sm" for="perm_{{$permission->id}}">{{$permission->name}}</label>     
                        </div>
                    @endif
                @endforeach
            </div>

            {{-- resellers  --}}
            <div>
                <x-input-label>
                    Resellers
                </x-input-label>
                @foreach ($permissions as $permission)
                    @php
                        $chk = false;
                        if (isset($userPermissions)){
                            if($userPermissions->contains($permission->name)){
                                $chk = true;
                            }
                        }
                    @endphp
                        
                    @if (Str::startsWith($permission->name, 'reseller'))
                        {{-- {{$permission->name}} --}}
                        
                        
                        <div>
                            <x-text-input class="m-0" :checked="$chk" type="checkbox" name="permissions[]" id="perm_{{$permission->id}}" value="{{$permission->name}}" />
                            <label class="pl-3 text-sm" for="perm_{{$permission->id}}">{{$permission->name}}</label>     
                        </div>
                    @endif
                @endforeach
            </div>

            {{-- riders  --}}
            <div>
                <x-input-label>
                    Riders
                </x-input-label>
                @foreach ($permissions as $permission)
                    @php
                        $chk = false;
                        if (isset($userPermissions)){
                            if($userPermissions->contains($permission->name)){
                                $chk = true;
                            }
                        }
                    @endphp
                        
                    @if (Str::startsWith($permission->name, 'riders'))
                        {{-- {{$permission->name}} --}}
                        
                        
                        <div>
                            <x-text-input class="m-0" :checked="$chk" type="checkbox" name="permissions[]" id="perm_{{$permission->id}}" value="{{$permission->name}}" />
                            <label class="pl-3 text-sm" for="perm_{{$permission->id}}">{{$permission->name}}</label>     
                        </div>
                    @endif
                @endforeach
            </div>

            {{-- users  --}}
            <div>
                <x-input-label>
                    Users
                </x-input-label>
                @foreach ($permissions as $permission)
                    @php
                        $chk = false;
                        if (isset($userPermissions)){
                            if($userPermissions->contains($permission->name)){
                                $chk = true;
                            }
                        }
                    @endphp
                        
                    @if (Str::startsWith($permission->name, 'users'))
                        {{-- {{$permission->name}} --}}
                        
                        
                        <div>
                            <x-text-input class="m-0" :checked="$chk" type="checkbox" name="permissions[]" id="perm_{{$permission->id}}" value="{{$permission->name}}" />
                            <label class="pl-3 text-sm" for="perm_{{$permission->id}}">{{$permission->name}}</label>     
                        </div>
                    @endif
                @endforeach
            </div>

            {{-- product  --}}
            <div>
                <x-input-label>
                    Product
                </x-input-label>
                @foreach ($permissions as $permission)
                    @php
                        $chk = false;
                        if (isset($userPermissions)){
                            if($userPermissions->contains($permission->name)){
                                $chk = true;
                            }
                        }
                    @endphp
                        
                    @if (Str::startsWith($permission->name, 'product'))
                        {{-- {{$permission->name}} --}}
                        
                        
                        <div>
                            <x-text-input class="m-0" :checked="$chk" type="checkbox" name="permissions[]" id="perm_{{$permission->id}}" value="{{$permission->name}}" />
                            <label class="pl-3 text-sm" for="perm_{{$permission->id}}">{{$permission->name}}</label>     
                        </div>
                    @endif
                @endforeach
            </div>

            {{-- category  --}}
            <div>
                <x-input-label>
                    Category
                </x-input-label>
                @foreach ($permissions as $permission)
                    @php
                        $chk = false;
                        if (isset($userPermissions)){
                            if($userPermissions->contains($permission->name)){
                                $chk = true;
                            }
                        }
                    @endphp
                        
                    @if (Str::startsWith($permission->name, 'category'))
                        {{-- {{$permission->name}} --}}
                        
                        
                        <div>
                            <x-text-input class="m-0" :checked="$chk" type="checkbox" name="permissions[]" id="perm_{{$permission->id}}" value="{{$permission->name}}" />
                            <label class="pl-3 text-sm" for="perm_{{$permission->id}}">{{$permission->name}}</label>     
                        </div>
                    @endif
                @endforeach
            </div>

        </div>
</div>