<x-app-layout>
    <x-dashboard.page-header>
        Roles
    </x-dashboard.page-header>

    <x-dashboard.container>
        <x-dashboard.section>
            <x-dashboard.section.header>
                <x-slot name="title">
                    Role List
                </x-slot>
                <x-slot name="content">
                    system have all {{count($role)}} role.
                </x-slot>
            </x-dashboard.section.header>

            <x-dashboard.section.inner>
                <x-dashboard.table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Role</th>
                            <th>Users</th>
                            <th>Permissions</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($role as $rol)
                            <tr>
                                <td> {{$loop->iteration}} </td>
                                <td> {{$rol->name ?? ""}} </td>
                                <td> {{$rol->users?->count() ?? "No Users"}} </td>
                                <td> {{$rol->permissions?->count() ?? "No Permissions"}} </td>
                                <td>
                                    <div class="flex">
                                        <form action="{{route('system.role.edit')}}" method="post">
                                            @csrf
                                            <input type="hidden" name="role" value="{{$rol->id}}">
                                            <x-primary-button>
                                                Edit
                                            </x-primary-button>
                                        </form>

                                        <form action="{{route('system.role.edit')}}" method="post">
                                            @csrf
                                            <input type="hidden" name="role" value="{{$rol->id}}">
                                            <x-danger-button>
                                                Delete
                                            </x-danger-button>
                                        </form>
                                       
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </x-dashboard.table>
            </x-dashboard.section.inner>
        </x-dashboard.section>
    </x-dashboard.container>
</x-app-layout>
