<footer class="footer">
    <div class="container @auth-fluid @endauth">
        <nav>
            <p class="copyright text-center">
                ©
                <script>
                    document.write(new Date().getFullYear())
                </script>
                <a href="{{ route('upload.index') }}">{{ __('Mathematics Challenge Platform') }}</a> 
            </p>
        </nav>
    </div>
</footer>