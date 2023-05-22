
<div {{ $attributes->class(['card m-auto'])->merge(['style'=>'width: 18rem;']) }}>
    @if(isset($image))

    {{$image}}
    @endif

    <div class="card-body">
        @if(isset($title))
            <h5 {{$title->attributes->class(['p-4 card-title'])  }}>
                {{$title}}
            </h5>
        @endif
        <p {{ $body->attributes->class(['font-italic text-capitalize']) }}>
            {{$body}}
        </p>

        @isset($button)

        {{$button}}
        @endisset
    </div>
    </div>

