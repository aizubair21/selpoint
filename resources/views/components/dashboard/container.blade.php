<div {{$attributes}} class="my-3 ">
    <div {{$attributes->merge(['class' => 'max-w-6xl mx-auto px-3 sm:px-6 lg:px-8 space-y-6'])}}>
        {{$slot}}
    </div>
</div>