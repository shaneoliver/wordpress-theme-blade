@extends('layout')

@section('content')
<main>
    <div class="container">
        <div class="row">
            <div class="col-12">
                @if (have_posts())
                    @while (have_posts())
                        @php the_post(); @endphp
                        {{ the_content() }}
                    @endwhile
                @endif
            </div>
        </div>
    </div>
</main>
@endsection