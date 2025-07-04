<div>
    <x-dashboard.container>
        <x-dashboard.section>
            <x-dashboard.section.header>
                <x-slot name="title">
                    Comissions
                </x-slot>
                <x-slot name="content">
                    Your Products comissions list.
                </x-slot>
            </x-dashboard.section.header>
            <x-dashboard.section.inner>
                <x-nav-link href="?nav=earn" :active="$nav=='earn'">Earn Comissions</x-nav-link>
                <x-nav-link href="?nav=system" :active="$nav=='system'">System Comissions</x-nav-link>
            </x-dashboard.section.inner>
        </x-dashboard.section>

        {{$data->links()}}
        @if ($nav == 'earn')
            <x-dashboard.table :data>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Amount</th>
                        <th>Product</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $earn)
                        <tr>
                            <td> {{$earn->id}} </td>
                            <td> {{$earn->amount ?? 0}}  </td>
                            <td> {{$earn->product?->name ?? 0}}  </td>
                            <td> {{$earn->updated_at?->toFormattedDateString() ?? 0}}  </td>
                        </tr>
                    @endforeach
                </tbody>
            </x-dashboard.table>
        @else 
            <x-dashboard.table :data>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Amount</th>
                        <th>Product</th>
                        <th>Order</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $take)
                        <tr>
                            <td>{{ $take->id }}</td>
                            <td>{{ $take->take_comission }}</td>
                            <td>{{ $take->product?->name ?? "N/A" }}</td>
                            <td>{{ $take->order_id ?? "N/A" }}</td>
                            <td> {{ $take->updated_at?->toFormattedDateString()}} </td>
                        </tr>
                    @endforeach
                </tbody>
            </x-dashboard.table>
        @endif
    </x-dashboard.container>
</div>
