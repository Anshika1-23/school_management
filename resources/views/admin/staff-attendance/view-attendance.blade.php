@php $i=0; @endphp
@foreach($role as $key=>$value)
@php  $i++; @endphp
<tr>
    <td class="text-bold-500">{{$i}}</td>
    <td>
        <input type="text" hidden class="staff" name="staff_id[]" value="{{$value->id}}">
        {{$value->f_name}}
    </td>
    <td class="text-bold-500">
        <input type="text" hidden class="role" name="role_id[]" value="{{$value->role_name->id}}">
        <input type="date" hidden  name="date[]" value="{{$date}}">
        {{$value->role_name->title}}
    </td>
    @php
  
    if(count($attendance) > 0 && in_array($value->id,$attendance)){
        $att_detail = App\Models\StaffAttendance::where(['staff_id' => $value->id,'attendence_date'=>$date])->first();

        $att = $att_detail->attendence_type;
        $note = $att_detail->description;
    }else{
        if(date('l',strtotime($date)) == 'Sunday'){
            $att = '';
            $note = 'Holiday';   
        }else{
            $att = 'P';
            $note = '';
        }
       
    }

    @endphp
    <td>
        <div class="form-check">
            <div class="custom-control custom-radio">
                <input type="radio" class="form-check-input form-check-success " name="attendance[{{$value->id}}]" @if($att == 'P') checked @endif  value="P" id="radioP{{$value->id}}" >
                <label class="form-check-label" for="radioP{{$value->id}}">Present</label>
            </div>
        </div>
        <div class="form-check">
            <div class="custom-control custom-radio">
                <input type="radio" class="form-check-input form-check-success" name="attendance[{{$value->id}}]" @if($att == 'L') checked @endif value="L" id="radioL{{$value->id}}" >
                <label class="form-check-label" for="radioL{{$value->id}}">Late</label>
            </div>
        </div>
        <div class="form-check">
            <div class="custom-control custom-radio">
                <input type="radio" class="form-check-input form-check-success" name="attendance[{{$value->id}}]" @if($att == 'A') checked @endif value="A" id="radioA{{$value->id}}" >
                <label class="form-check-label" for="radioA{{$value->id}}">Absent</label>
            </div>
        </div>
        <div class="form-check">
            <div class="custom-control custom-radio">
                <input type="radio" class="form-check-input form-check-success" name="attendance[{{$value->id}}]" @if($att == 'H') checked @endif value="H" id="radioH{{$value->id}}" >
                <label class="form-check-label" for="radioH{{$value->id}}">Half Day</label>
            </div>
        </div>
    </td>
    <td>
        <textarea class="form-control des" id="exampleFormControlTextarea1" name="description[]" rows="3">{{$note}}</textarea>
    </td>
</tr>
@endforeach