<div>
    <!-- Simplicity is the ultimate sophistication. - Leonardo da Vinci -->
    @php
        $permissions = DB::table('permissions')->get();
    @endphp
    @foreach ($permissions as $permission)
        <div class="flex">
            @php
                $chk = false;
                if (isset($userPermissions)){
                    if($userPermissions->contains($permission->name)){
                        $chk = true;
                    }
                }
            @endphp
            <x-text-input :checked="$chk" type="checkbox" name="permissions[]" id="perm_{{$permission->id}}" value="{{$permission->name}}" />
            <label class="pl-3 text-md" for="perm_{{$permission->id}}">{{$permission->name}}</label>     
        </div>
    @endforeach
</div>