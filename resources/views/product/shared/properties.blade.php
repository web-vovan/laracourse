<ul class="sm:max-w-[360px] space-y-2 mt-8">
    @foreach($product->json_properties as $key => $value)
        <li class="flex justify-between text-body">
            <strong class="text-white">{{ $key }}:</strong> {{ $value }}
        </li>
    @endforeach
</ul>
