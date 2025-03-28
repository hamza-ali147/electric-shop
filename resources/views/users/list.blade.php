{{-- <x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Users') }}
            </h2>
            @can('create users')
                <a href="{{ route('users.create') }}" class="bg-slate-700 text-sm rounded-md px-3 py-3 text-white">Create</a>
            @endcan

        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-message></x-message>
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr class="border-b">
                        <th class="px-6 py-3 text-left" width="60">#</th>
                        <th class="px-6 py-3 text-left">Name</th>
                        <th class="px-6 py-3 text-left">Email</th>
                        <th class="px-6 py-3 text-left">Role</th>
                        <th class="px-6 py-3 text-left" width="180">Created</th>
                        <th class="px-6 py-3 text-center" width="180">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @if ($users->isNotEmpty())
                        @foreach ($users as $user)
                            <tr class="border-b">
                                <td class="px-6 py-3 text-left">{{ $user->id }}</td>
                                <td class="px-6 py-3 text-left">{{ $user->name }}</td>
                                <td class="px-6 py-3 text-left">{{ $user->email }}
                                </td>
                                <td class="px-6 py-3 text-left">{{ $user->roles->pluck('name')->implode(', ') }}
                                </td>
                                <td class="px-6 py-3 text-left">
                                    {{ \Carbon\Carbon::parse($user->created_at)->format('d, M, Y') }}
                                </td>
                                <td class="px-6 py-3 text-left">
                                    @can('edit users')
                                        <a href="{{ route('users.edit', $user->id) }}"
                                            class="bg-slate-700 text-sm rounded-md px-3 py-3 text-white hover:bg-slate-600">Edit</a>
                                    @endcan
                                    @can('delete users')
                                    <a href="javascript:void(0);" onclick="deleteUsers({{ $user->id }})"
                                        class="bg-red-700 text-sm rounded-md px-3 py-3 text-white hover:bg-red-600">Delete</a>
                                        @endcan
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
            <div class="my-3">
                {{ $users->links() }}
            </div>
        </div>
    </div>

    <x-slot name="script">
        <script type="text/javascript">
            function deleteUsers(id) {
                if (confirm("Are you sure you want to delete?")) {
                    $.ajax({
                        url: '{{ route('users.destroy', '') }}/' + id, 
                        type: 'DELETE', 
                        data: {
                            _token: '{{ csrf_token() }}' 
                        },
                        success: function(response) {
                            if (response.status === true) {
                                window.location.href =
                                    '{{ route('users.index') }}';
                            } else {
                                alert('Error deleting role');
                            }
                        },
                        error: function(xhr) {
                            console.log(xhr.responseText);
                            alert('Error processing the request.');
                        }
                    });
                }
            }
        </script>
    </x-slot>
</x-app-layout> --}}

<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Users') }}
            </h2>
            {{-- @can('create users') --}}
                <a href="{{ route('users.create') }}" class="bg-slate-700 text-sm rounded-md px-3 py-3 text-white">Create</a>
            {{-- @endcan --}}
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-message></x-message>
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr class="border-b">
                        <th class="px-6 py-3 text-left" width="60">#</th>
                        <th class="px-6 py-3 text-left">Name</th>
                        <th class="px-6 py-3 text-left">Email</th>
                        <th class="px-6 py-3 text-left">Role</th>
                        <th class="px-6 py-3 text-left" width="180">Created</th>
                        <th class="px-6 py-3 text-center" width="180">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @if ($users->isNotEmpty())
                        @foreach ($users as $user)
                            <tr class="border-b">
                                <td class="px-6 py-3 text-left">{{ $user->id }}</td>
                                <td class="px-6 py-3 text-left">{{ $user->name }}</td>
                                <td class="px-6 py-3 text-left">{{ $user->email }}</td>
                                <td class="px-6 py-3 text-left">{{ $user->roles->pluck('name')->implode(', ') }}</td>
                                <td class="px-6 py-3 text-left">
                                    {{ \Carbon\Carbon::parse($user->created_at)->format('d, M, Y') }}
                                </td>
                                <td class="px-6 py-3 text-left">
                                    {{-- @can('edit users') --}}
                                        <a href="{{ route('users.edit', $user->id) }}" class="bg-slate-700 text-sm rounded-md px-3 py-3 text-white hover:bg-slate-600">Edit</a>
                                    {{-- @endcan --}}
                                    {{-- @can('delete users') --}}
                                    <a href="javascript:void(0);" onclick="deleteUsers({{ $user->id }})" class="bg-red-700 text-sm rounded-md px-3 py-3 text-white hover:bg-red-600">Delete</a>
                                    {{-- @endcan --}}
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
            <div class="my-3">
                {{ $users->links() }}
            </div>
        </div>
    </div>

    <x-slot name="script">
        <script type="text/javascript">
            function deleteUsers(id) {
                if (confirm("Are you sure you want to delete?")) {
                    $.ajax({
                        url: '{{ route('users.destroy', '') }}/' + id, // Pass ID to the route
                        type: 'POST', // Laravel uses POST with _method for DELETE
                        data: {
                            _token: '{{ csrf_token() }}', // CSRF token
                            _method: 'DELETE' // Spoof DELETE method
                        },
                        success: function(response) {
                            if (response.status === true) {
                                alert('User deleted successfully.');
                                window.location.href = '{{ route('users.index') }}'; // Redirect to index
                            } else {
                                alert(response.message || 'Error deleting user.');
                            }
                        },
                        error: function(xhr) {
                            console.error(xhr.responseText);
                            alert('Error processing the request.');
                        }
                    });
                }
            }
        </script>
    </x-slot>
</x-app-layout>
