@if($errors->any())
    <div class="mb-5 rounded-2xl bg-rose-500/10 border border-rose-500/30 text-rose-300 p-4 text-sm md:col-span-2">
        <ul class="list-disc pl-5 space-y-1">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif