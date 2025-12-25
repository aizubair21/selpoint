<div>
    @props(['status'])
    @if ($status == 'Pending')
    <span class="text-xs p-1 border rounded-md bg-yellow-200 text-yellow-900">Pending</span>
    @elseif ($status == 'Accept')
    <span class="text-xs p-1 border rounded-md bg-green-200 text-green-900">Accept</span>
    @elseif ($status == 'Picked')
    <span class="text-xs p-1 border rounded-md bg-lime-200 text-lime-900">Picked</span>
    @elseif ($status == 'Delivery')
    <span class="text-xs p-1 border rounded-md bg-sky-200 text-sky-900">Delivery</span>
    @elseif ($status == 'Delivered')
    <span class="text-xs p-1 border rounded-md bg-blue-200 text-blue-900">Delivered</span>
    @elseif ($status == 'Confirm')
    <span class="text-xs p-1 border rounded-md bg-indigo-200 text-indigo-900">Confirm</span>
    @elseif ($status == 'Hold')
    <span class="text-xs p-1 border rounded-md bg-gray-200 text-gray-900">Hold</span>
    @elseif ($status == 'Cancel')
    <span class="text-xs p-1 border rounded-md bg-red-200 text-red-900">Cancel</span>
    @elseif ($status == 'Cancelled')
    <span class="text-xs p-1 border rounded-md bg-red-200 text-red-900">Cancelled</span>
    @elseif ($status == 'Reject')
    <span class="text-xs p-1 border rounded-md bg-red-200 text-red-900">Reject</span>
    @else
    <span class="text-xs p-1 border rounded-md bg-gray-200 text-gray-900">Unknown</span>
    @endif
</div>