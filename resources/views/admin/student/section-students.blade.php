<option value="" disabled selected>Select Student</option>
@foreach($students as $student)
    <option value="{{$student->parent_id}}">{{$student->first_name}} {{$student->last_name}}</option>
@endforeach