<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Permissions') }}
            </h2>
            {{-- @can('create permissions') --}}
                <a href="{{ route('permissions.create') }}"
                    class="bg-slate-700 text-sm rounded-md px-3 py-3 text-white">Create</a>
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
                        <th class="px-6 py-3 text-left" width="180">Created</th>
                        <th class="px-6 py-3 text-center" width="180">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @if ($permissions->isNotEmpty())
                        @foreach ($permissions as $permission)
                            <tr class="border-b">
                                <td class="px-6 py-3 text-left">{{ $permission->id }}</td>
                                <td class="px-6 py-3 text-left">{{ $permission->name }}</td>
                                <td class="px-6 py-3 text-left">
                                    {{ \Carbon\Carbon::parse($permission->created_at)->format('d, M, Y') }}
                                </td>
                                <td class="px-6 py-3 text-left">
                                    {{-- @can('edit permissions') --}}
                                        <a href="{{ route('permissions.edit', $permission->id) }}"
                                            class="bg-slate-700 text-sm rounded-md px-3 py-3 text-white hover:bg-slate-600">Edit</a>
                                    {{-- @endcan --}}
                                    {{-- @can('delete permissions') --}}
                                        <a href="javascript:void(0);" onclick="deletePermission({{ $permission->id }})"
                                            class="bg-red-700 text-sm rounded-md px-3 py-3 text-white hover:bg-red-600">Delete</a>
                                    {{-- @endcan --}}

                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
            <div class="my-3">
                {{ $permissions->links() }}
            </div>
        </div>
    </div>

    <x-slot name="script">
        <script type="text/javascript">
            function deletePermission(id) {
                if (confirm("Are you sure you want to delete?")) {
                    $.ajax({
                        url: '{{ route('permissions.destroy', '') }}/' + id, // Pass id to the route
                        type: 'DELETE', // Use DELETE method
                        data: {
                            _token: '{{ csrf_token() }}' // CSRF token for security
                        },
                        success: function(response) {
                            if (response.status === true) {
                                window.location.href =
                                    '{{ route('permissions.index') }}'; // Redirect after success
                            } else {
                                alert('Error deleting permission');
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
</x-app-layout>
