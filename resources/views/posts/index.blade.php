<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Posts
        </h2>
    </x-slot>

    <div>
        <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="block mb-8">
                <a href="{{ route('posts.create') }}"
                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Add Post</a>
            </div>
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            @if (count($posts) > 0)
                                <table class="min-w-full divide-y divide-gray-200 w-full">
                                    <thead>
                                        <tr>
                                            <th scope="col" width="50"
                                                class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                #
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Title</th>
                                            <th scope="col" width="200" class="px-6 py-3 bg-gray-50"></th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach ($posts as $post)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    {{ $loop->iteration }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    {{ $post->title }}
                                                </td>
                                                <td class="px-2 py-2 whitespace-nowrap text-sm font-medium">
                                                    <a href="{{ route('posts.show', $post->id) }}"
                                                        class="bg-blue-500 hover:bg-blue-700 px-3 rounded mb-2 mr-2 text-white">View</a>

                                                    <a href="{{ route('posts.edit', $post->id) }}"
                                                        class="bg-indigo-600 hover:bg-indigo-900 px-4 rounded text-white font-bold mb-2 mr-2">Edit</a>

                                                    <form class="inline-block"
                                                        action="{{ route('posts.destroy', $post->id) }}" method="POST"
                                                        onsubmit="return confirm('Are you sure?');">
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <input type="hidden" name="_token"
                                                            value="{{ csrf_token() }}">
                                                        <input type="submit"
                                                            class="bg-red-600 hover:bg-red-900 text-white font-bold mb-2 mr-2 px-3 rounded"
                                                            value="Delete">
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p class="px-6 py-3 bg-gray-50 text-left text-gray-500 tracking-wider">No posts at the
                                    moment. </p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
