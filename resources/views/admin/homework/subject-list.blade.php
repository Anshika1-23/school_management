<option value="" disabled selected>Select Subject</option>
@foreach($subjects as $subject)
    <option value="{{$subject->id}}">{{$subject->title}}</option>
@endforeach