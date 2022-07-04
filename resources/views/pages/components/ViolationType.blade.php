<div class="list--violation--type">
    <img src="{{asset('assets/image/type.svg')}}" alt="">
    <p></p>
    <img src="{{asset('assets/image/Under-than.svg')}}" alt="">
    <div class="select--violation--type violation_pc" id="toggle">
        <div class="select__one--violation--type"  id=0>
            <p data-id=0>{{ __('- Select violation type -') }}</p>
            <img src="{{asset('assets/image/tickV.svg')}}" alt="">
        </div>
        @foreach ($violationTypes as $violationType)
            <div class="select__one--violation--type" id={{$violationType->_id}}>
                <p  data-id={{$violationType->_id}}>{{$violationType->name}}</p>
                <img src="{{asset('assets/image/tickV.svg')}}" alt="">
            </div>
        @endforeach
    </div>
</div>
