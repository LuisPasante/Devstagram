<div>
    @if($posts->count())
        <div class="grid md:grid-cols-3 xl:grid-cols-4 gap-6 mt-10">
            @foreach ($posts as $post)
                 <div>
                    <a href="{{ route('posts.show', ['user' => $post->user->username, 'post' => $post->id]) }}">
                        <img src="{{ asset('uploads/' . $post->imagen) }}" alt="Imagen del post {{ $post->titulo }}">
                    </a>
                </div>
           
            @endforeach

        </div>
      
        <div class="my-10"> -
            {{ $posts->links() }}
        </div>
    @else
        <p class="text-center text-gray-600">No hay publicaciones aún.</p>
    @endif
</div>