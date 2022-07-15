<div class="card">
    @if (!empty($title))
    <header class="card-header">
        <p class="card-header-title">
            
            {!! $title !!}
            <div>
                <p><b>Email:</b> admin@admin.com</p>
                <p><b>Password:</b> adminadmin</p>
            </div>
            
        </p>
    </header>
    @endif

    <div class="card-content">
        {!! $slot !!}
    </div>

    @if(!empty($footer))
    <footer class="card-footer">
        {!! $footer !!}
    </footer>
    @endif
</div>