<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Post
        </h2>
    </x-slot>
    

    <div>
        <div class="max-w-4xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form method="post" action="{{ route('posts.update', $post->id) }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="title" class="block font-medium text-sm text-gray-700">Title</label>
                            <input type="text" name="title" id="title" type="text"
                                class="form-input rounded-md shadow-sm mt-1 block w-full" placeholder="Title"
                                value="{{ $post->title }}" />
                            @error('title')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="body" class="block font-medium text-sm text-gray-700">Body</label>

                            <textarea name="body" id="body" cols="30" rows="10"
                                class="form-input shadow-sm block w-full rounded-md mt-1" placeholder="Body">{{ $post->body }}</textarea>
                            @error('body')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="category" class="block font-medium text-sm text-gray-700">Select
                                Category</label>
                            <select name="category_id" class="block w-full rounded-md mt-1 shadow-sm">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->title }}</option>
                                @endforeach
                            </select>

                        </div>




                        <div class="px-4 py-5 bg-white sm:p-6">
                            <input type="file"
                                class="block w-full rounded-md mt-1 shadow-sm border border-solid border-gray-600 p-1"
                                name="photo" value="{{ $post->photo }}">
                            @error('photo')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror

                            @if ($post->photo)
                                <div class="px-4 py-5 sm:p-6">
                                    <img src="/{{ $post->photo }}" style="width:20%" />
                                </div>
                            @endif
                        </div>

                        <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">
                            <button
                                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                Update
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
