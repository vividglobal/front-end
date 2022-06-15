<div class="list--violation--type">
    <img src="{{ asset('assets/image/type.svg') }}" alt="">
    <p>Violation type</p>
    <img src="{{ asset('assets/image/Under-than.svg') }}" alt="">
    <div class="select--violation--type" id="toggle">
        <div class="select__one--violation--type">
            <p data-id=0>- Select violation type -</p>
            <img src="http://localhost:8099/assets/image/tickV.svg" alt="">
        </div>
        @foreach ($violationTypes as $violationType)
            <div class="select__one--violation--type">
                <p data-id={{$violationType->_id}}>{{$violationType->name}}</p>
                <img src="http://localhost:8099/assets/image/tickV.svg" alt="">
            </div>
        @endforeach
    </div>
</div>
