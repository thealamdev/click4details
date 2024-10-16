<table class="table table-striped">
    <thead>
        <th>#</th>
        <th>Package Name</th>
        <th>Start Day</th>
        <th>Visit Day</th>
        <th>Action</th>
    </thead>

    <tbody>
        @forelse ($packages as $each)
            <tr>
                <td>{{ $each->id }}</td>
                <td>{{ $each->name }}</td>
                <td>{{ $each->starting_day }}</td>
                <td>{{ $each->visit_day }}</td>
                <td>
                    <form
                        action="{{ route('admin.customer-care.followup-package.delete', ['followupMessage' => $each->id]) }}"
                        method="POST">
                        @csrf
                        @method('delete')
                        <button type="button" class="btn deleteBtn" onclick="deleteItem(this)">
                            <script src="https://cdn.lordicon.com/lordicon.js"></script>
                            <lord-icon src="https://cdn.lordicon.com/dykoqszm.json" trigger="hover">
                            </lord-icon>
                        </button>
                    </form>
                </td>
            </tr>
        @empty
            <td colspan="5" class="text-center text-red-600 fw-600">Data not found !!!</td>
        @endforelse

    </tbody>
</table>
