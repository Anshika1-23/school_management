<table class="table mb-0 table-bordered">
    <thead class="thead-dark">
        <tr>
            <th>S No.</th>
            <th>Student Name</th>
            @if(isset($daysInMonth))
                @for ($d = 1; $d <= $daysInMonth; $d++)
                    <th>{{ $d }}</th>
                @endfor
            @endif
        </tr>
    </thead>
    <tbody>
    @php $i=0; @endphp
        @foreach($std as $item)
        @php  $i++; @endphp
        <tr>
            <td class="text-bold-500">{{$i}}</td>
            <td>{{$item->first_name}}</td>
            @if(isset($daysInMonth))
                @for ($d = 1; $d <= $daysInMonth; $d++)
                    <td>
                        @php
                            $attendance = $studentAtt->where('student_id', $item->id)
                                          ->where('attendence_date', $month[0].'-'.$month[1].'-'.sprintf("%02d", $d))
                                          ->first();
                            if($attendance) {
                                echo $attendance->attendence_type; // Assuming there's a 'status' field in StudentAttendance
                            } else {
                                echo ""; // Or any default value if attendance record not found
                            }
                        @endphp
                    </td>
                @endfor
            @endif
        </tr>
        @endforeach
    </tbody>
</table>