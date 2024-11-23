<div class="card">
    <div class="card-body">
    <table class="table mb-0 table-bordered">
        <thead class="thead-dark">
            <tr>
                @if(isset($daysInMonth))
                    @for ($d = 1; $d <= $daysInMonth; $d++)
                        <th>{{ $d }}</th>
                    @endfor
                @endif
            </tr>
        </thead>
        <tbody>
        @php $i=0;
        $std = session()->get('id');
        @endphp
            <tr>
                @if(isset($daysInMonth))
                    @for ($d = 1; $d <= $daysInMonth; $d++)
                        <td>
                            @php
                                $attendance = $studentAtt->where('attendence_date', $year.'-'.sprintf("%02d", $month).'-'.sprintf("%02d", $d))
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
        </tbody>
    </table>
</div>
</div>