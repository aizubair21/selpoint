<x-app-layout>
    <x-dashboard.page-header>
        Users
    </x-dashboard.page-header>

    <x-dashboard.container>
        <x-dashboard.section>
            <x-dashboard.section.header>
                <x-slot name="title">
                    Users List
                </x-slot>
                <x-slot name="content">
                    Manage user form all {{count($users)}} users.
                </x-slot>
            </x-dashboard.section.header>

            <x-dashboard.section.inner>
                <x-dashboard.table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Ref</th>
                            <th>Role</th>
                            <th>Permissions</th>
                            <th>VIP</th>
                            <th>Order</th>
                            <th>Created</th>
                            <th>A/C</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $key => $user)
                            <tr>
                                <td> {{$loop->iteration}} </td>
                                <td> {{$user->name }} </td>
                                <td> {{$user->reference ?? "Not Found" }} </td>
                                <td> {{$user->role?->name ?? "User"}} </td>
                                <td> {{$user->permissions?->count() ?? "Not Found !"}} </td>
                                <td> {{$user->vipPurchase?->package?->name ?? "No"}} </td>
                                <td> {{count($user->order?? []) ?? "0"}} </td>
                                <td>
                                    {{$user->created_at->toFormattedDateString()}}
                                </td>
                                <td>
                                    <div class="flex">
                                        <form action="{{route('system.users.edit', ['email' => $user->email])}}" method="get">
                                            <x-primary-button type="submit">
                                                Edit
                                            </x-primary-button>
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