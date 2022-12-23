<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-gray-300 overflow-hidden shadow-sm sm:rounded-lg  mt-7">
                <div class="p-6 bg-gray-900 h-[80vh] overflow-y-scroll  flex flex-col  example gap-8 w-full">
                    @foreach ($chats as $chat)
                        @if ($chat->sender($chat->tosend_id))
                            <div class="flex self-start">
                                <img src="{{ $chat->getAvatar($chat->tosend_id) }}" class="w-7 h-7 rounded-full mr-2"
                                    alt="">
                                <div id="toast-top-left"
                                    class="flex self-start  items-center p-4 space-x-4 w-full max-w-xs text-white bg-gray-600 rounded-lg divide-x divide-gray-200 shadow "
                                    role="alert">
                                    <div class="text-sm font-normal flex flex-col w-full">
                                        <p>{{ $chat->message }}</p>
                                        <p class="text-right w-full text-gray-400 text-xs">
                                            {{ $chat->created_at->diffForHumans() }}</p>
                                    </div>

                                </div>
                            </div>
                        @else
                            <div class="flex self-end">
                                <div id="toast-top-left"
                                    class="flex self-start  items-center p-4 space-x-4 w-full max-w-xs text-white bg-purple-600 rounded-lg divide-x divide-gray-200 shadow "
                                    role="alert">

                                    <div class="text-sm font-normal flex flex-col w-full">
                                        <p>{{ $chat->message }}</p>
                                        <p class="text-right w-full text-gray-400 text-xs">
                                            {{ $chat->created_at->diffForHumans() }}</p>
                                    </div>


                                </div>
                                <img src="{{ $chat->getAvatar($chat->tosend_id) }}" class="w-7 h-7 rounded-full ml-2"
                                    alt="">
                            </div>
                        @endif
                    @endforeach
                </div>
                <div class="p-6 bg-gray-900 ">
                    <form action="{{ route('chats.send', $user->id) }}" class="flex w-full items-center gap-4"
                        method="POST">
                        @csrf
                        <div class="w-full">

                            <input type="text" id="message"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="Send a message" name="message" required>
                        </div>
                        <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Send</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
