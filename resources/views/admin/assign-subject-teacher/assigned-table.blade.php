<div class="card">
    <div class="card-header">
        <h5 class="card-title">Assigned Subjects</h5>
    </div>
    <div class="card-body">
        @if($assigned->isNotEmpty())
        <table class="table tabe-bordered">
            <thead>
                <tr>
                    <th>Subject</th>
                    <th>Teacher</th>
                </tr>
            </thead>
            <tbody>
                @foreach($assigned as $row)
                <tr>
                    <td>{{$row->subject_name->title}}</td>
                    <td>{{$row->staff_name->f_name}} {{$row->staff_name->l_name}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
            <h6>No Result Found</h6>
        @endif
    </div>
</div>