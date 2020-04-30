
<link href="{{ asset('css/404.css') }}" rel="stylesheet">
<script src="{{ asset('js/404.js') }}" defer></script>
<div class="box">
    <div class="box__ghost">
        <div class="symbol"></div>
        <div class="symbol"></div>
        <div class="symbol"></div>
        <div class="symbol"></div>
        <div class="symbol"></div>
        <div class="symbol"></div>

        <div class="box__ghost-container">
            <div class="box__ghost-eyes">
                <div class="box__eye-left"></div>
                <div class="box__eye-right"></div>
            </div>
            <div class="box__ghost-bottom">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
        <div class="box__ghost-shadow"></div>
    </div>

    <div class="box__description">
        <div class="box__description-container">
            <div class="box__description-title">Упс!</div>
            <div class="box__description-text">Вы не должны были сюда попасть:(</div>
        </div>

        <a href="{{route('index')}}" class="box__button">Домой</a>

    </div>

</div>
