<ul class="sm:max-w-[360px] space-y-2 mt-8">
    @foreach($product->properties as $property)
        <li class="flex justify-between text-body">
            <strong class="text-white">{{ $property->title }}:</strong> {{ $property->pivot->value }}
        </li>
    @endforeach
</ul>
