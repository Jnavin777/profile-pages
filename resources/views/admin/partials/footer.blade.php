<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                @if(date('Y') == 2022) {{ date('Y') }} @else 2022 - {{ date('Y') }} @endif &copy; Создание и развитие - <a href="">Герман Иван</a>
            </div>
            <div class="col-md-6">
                <div class="text-md-right footer-links d-none d-sm-block">
                    <a href="javascript:void(0);">О сервисе</a>
                    <a href="javascript:void(0);">Техподдержка</a>
                    <a href="javascript:void(0);">Связаться с нами!</a>
                    <a href="javascript:void(0);">Другие проекты</a>
                    <a href="{{ route('dashboard') }}">Пользовательская зона</a>
                </div>
            </div>
        </div>
    </div>
</footer>
