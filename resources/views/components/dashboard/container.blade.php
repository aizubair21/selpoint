<div {{$attributes}} class="my-3 ">
    <div {{$attributes->merge(['class' => 'w-full max-w-8xl mx-auto sm:px-6 lg:px-8 space-y-6 '])}}>
        {{$slot}}
    </div>
</div>