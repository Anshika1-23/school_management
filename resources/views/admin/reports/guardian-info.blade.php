@if($guardian)
<table class="table table-bordered">
<input type="hidden" name="id" >
    <tr>
        <th>Admission No.</th>
        <td>{{$guardian->admission_no}}</td>
    </tr>
    <tr>
        <th>Class</th>
        <td>{{$guardian->class_name->title}}</td>
    </tr>
    <tr>
        <th>Student Name</th>
        <td>{{$guardian->full_name}}</td>
    </tr>
    <tr>
        <th>Father Name</th>
        <td>{{$guardian->parent_name->father_name}}</td>
    </tr>
    <tr>
        <th>Father Occupation</th>
        <td>{{$guardian->parent_name->f_occupation}}</td>
    </tr>
    <tr>
        <th>Mother Name</th>
        <td>{{$guardian->parent_name->mother_name}}</td>
    </tr>
    <tr>
        <th>Mother Occupation</th>
        <td>{{$guardian->parent_name->m_occupation}}</td>
    </tr>
    <tr>
        <th>Guardian Name</th>
        <td>{{$guardian->parent_name->guardian_name}}</td>
    </tr>
    <tr>
        <th>Guardian Occupation</th>
        <td>{{$guardian->parent_name->guardian_occupation}}</td>
    </tr>
    <tr>
        <th>Guardian Phone No.</th>
        <td>{{$guardian->parent_name->guardian_phone}}</td>
    </tr>
    <tr>
        <th>Guardian Relation </th>
        <td>
            @if($guardian->parent_name->guardian_relation == 1)
                <span class="badge bg-light-primary">Father</span>
            @elseif($guardian->parent_name->guardian_relation == 0)
                <span class="badge bg-light-primary">Mother</span>
            @else
                <span class="badge bg-light-primary">Other</span>
            @endif
       </td>
    </tr>
</table>
@endif