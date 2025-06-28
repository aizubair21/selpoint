<div {{$attributes}} class="my-3 ">
    <div {{$attributes->merge(['class' => 'w-full mx-auto px-2 sm:px-6 lg:px-8 space-y-6'])}}>
        {{$slot}}
    </div>
</div>