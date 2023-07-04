@extends('layouts.base')

@section('content')
<div class="container">
    <h5 class="center">Available Appointments</h5>
    <div class="row center">
        @foreach($appointments as $appointment)
            <div class="col 1">
                <h5 class="center">{{$appointment['date']}}</h5>
                <h5 class="center"><b>{{$appointment['day_name']}}</b></h5>
                @if(!$appointment['off'])
                    @foreach($appointment['appointment_hours'] as $time)
                        @if (!in_array($time, $appointment['reserved_hours']))
                            <form action="{{route('reserve')}}" method="post">
                                @csrf
                                <input type="hidden" name="date" value=" {{$appointment['full_date']}}">
                                <input type="hidden" name="time" value="{{$time}}">
                                <button class="waves-effect waves-light btn info darken-2" type="submit">
                                    {{$time}} - {{ \Carbon\Carbon::parse($time)->addHour()->format('H:i') }}
                                </button>
                                <br>
                                <br>
                            </form>
                        @else
                            <button class="waves-effect waves-light btn info darken-2" disabled>
                                {{$time}} - {{ \Carbon\Carbon::parse($time)->addHour()->format('H:i') }}
                            </button>
                            <br>
                            <br>
                        @endif
                    @endforeach
                @endif
            </div>
        @endforeach
    </div>
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
