@extends('layouts.base')

@section('content')
<div class="container">
    <h4 class="center">Business Hours</h4>
    <div class="row center">
        <form action="{{route('appointments_update')}}" method="post">
            @csrf
            @foreach($appointmentHours as $appointmentHour)
                <div class="col s3">
                    <h5>{{$appointmentHour->day}}</h5>
                </div>
                <input type="hidden" name="data[{{$appointmentHour->day}}][day]" value="{{$appointmentHour->day}}">
                <div class="input-field col s3">
                    <input type="text" class="timepicker" value="{{$appointmentHour->from}}" name="data[{{$appointmentHour->day}}][from]" placeholder="From">
                </div>
                <div class="input-field col s2">
                    <input type="text" class="timepicker" value="{{$appointmentHour->to}}" name="data[{{$appointmentHour->day}}][to]" placeholder="To">
                </div>
                <div class="input-field col s1">
                    <input type="number" name="data[{{$appointmentHour->day}}][step]" value="{{$appointmentHour->step}}" placeholder="Step">
                </div>
                <div class="input-field col s3">
                    <p>
                        <label>
                            <input value="true" name="data[{{$appointmentHour->day}}][off]" class="filled-in" type="checkbox" @checked($appointmentHour->off) />
                            <span>OFF</span>
                        </label>
                    </p>
                </div>
            @endforeach

            <div class="col s12">
                <button class="waves-effect waves-light btn info darken-2" type="submit">
                    save
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var elems = document.querySelectorAll('.timepicker');
        var instances = M.Timepicker.init(elems, {
            twelveHour:false
        });
    });
</script>
@endsection
