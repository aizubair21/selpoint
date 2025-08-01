<div>
    @props(['status'])
    @if ($status == 'Pending')
        <span class="bg-gray-300 rounded-lg px-2 py-1">Pending</span>
    @endif

    @if ($status == 'Picked')
        <span class="bg-sky-300 rounded-lg px-2 py-1 text-white">Picked</span>
    @endif

    @if ($status == 'Delivery')
        <span class="bg-sky-300 rounded-lg px-2 py-1 text-white">Delivery</span>
    @endif
    
    @if ($status == 'Delivered')
        <span class="bg-indigo-300 rounded-lg px-2 py-1 text-white">Delivered</span>
    @endif
    
    @if ($status == 'Finished')
        <span class="bg-green-900 rounded-lg px-2 py-1 text-white">Finished</span>
    @endif

    @if ($status == "Accept")
        <span class="bg-indigo-900 rounded-lg px-2 py-1 text-white">Accept</span>
    @endif

    @if ($status == "Cancel")
        <span class="bg-red-300 rounded-lg px-2 py-1 ">Reject</span
    @endif
    @if ($status == "Hold")
        <span class="bg-red-300 rounded-lg px-2 py-1 ">Hold</span
    @endif
    @if ($status == "Cancelled")
        <span class="bg-gray-300 text-white rounded-lg px-2 py-1 ">Buyer Cancelled</span
    @endif
</div>