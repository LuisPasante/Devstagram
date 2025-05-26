<div>
    <div class="items-center flex gap-2">
    <button   wire:click="like"> 
        <svg xmlns="http://www.w3.org/2000/svg" 
        fill="{{ $isLiked ? "red" : "white"}}" 
            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" 
            class="w-6 h-6 text-red-500">
            <path stroke-linecap="round" stroke-linejoin="round" 
            d="M21.752 7.356c0-2.485-2.09-4.506-4.675-4.506
            -1.884 0-3.513 1.2-4.327 2.856
            -.814-1.656-2.443-2.856-4.327-2.856
            -2.585 0-4.675 2.021-4.675 4.506
            0 5.25 9.002 10.119 9.002 10.119s9.002-4.869 9.002-10.119z" />
        </svg>

    </button>
    <p class="font-bold">{{$likes}} </p> 
    <span class="font-normal">Likes</span>
    </div>
  
</div>
 