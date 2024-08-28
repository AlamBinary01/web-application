<div class="table">
    <div class="table-header">
        <div class="header__item"><a class="filter__link" href="#">Phone Number</a></div>
        <div class="header__item"><a class="filter__link filter__link--number" href="#">Visit Count</a></div>
        <div class="header__item"><a class="filter__link filter__link--number" href="#">Last Visit Date</a></div>
    </div>
    <div class="table-content">
        @foreach ($users as $user)
            <div class="table-row">
                <div class="table-data">{{ $user->phone_number }}</div>
                <div class="table-data">{{ $user->visit_count }}</div>
                <div class="table-data">{{ $user->last_visit_date }}</div>
            </div>
        @endforeach
    </div>
</div>