<table class="table w-100 text-white">
    <thead>
        <th>#</th>
        <th>Class</th>
        <th>Month</th>
        <th>Fees</th>
        <th>Amount</th>
        <th>Action</th>
    </thead>
    <tbody>
        @forelse ($assigned_fees as $key => $item)
            <tr>
                <td>{{++$key}}</td>
                <td>{{ $item->class_name }}</td>
                <td>{{$item->month_name}}</td>
                <td>{{$item->title}}</td>
                <td>{{$item->fees}}</td>
                <td>
                    <button class="btn-sm btn-danger" onclick="deleteAssignedFees('{{$item->student_fees_id}}', '{{$item->month_id}}')"> <i class="fa fa-trash"></i> </button>    
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center">
                    <img src="{{asset('images/no_data_found.svg')}}" alt="" width="100">
                    <h6>No record found</h6>
                </td>
            </tr>
        @endforelse
    </tbody>
</table>