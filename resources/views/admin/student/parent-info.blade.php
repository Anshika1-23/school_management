<div class="border p-2 d-flex justify-content-between">
    <ul class="list-unstyled d-flex">
        @if(isset($parent))
            <li class="border-end me-3 pe-3">Father Name : <b>{{$parent->father_name}}</b></li>
            <li class="border-end me-3 pe-3">Mother Name : <b>{{$parent->mother_name}}</b></li>
            <li class="border-end me-3 pe-3">Guardian Name : <b>{{$parent->guardian_name}}</b></li>

        @endif
        @if(isset($staff))
            <li class="border-end me-3 pe-3">Name : <b>{{$staff->f_name}} {{$staff->l_name}}</b></li>
            <li class="border-end me-3 pe-3">Designation : <b>{{$staff->designation_name->title}}</b></li>
        @endif
    </ul>
    <button type="button" class="btn btn-danger btn-sm align-self-lg-start remove-sibling-parent">x</button>
</div>
