<div>
    <script>
        window.onload = function() {
            const timezone = Intl.DateTimeFormat().resolvedOptions().timeZone;

            if (timezone !== '{{ auth()->check() ? auth()->user()->timezone : session()->get('timezone') }}') {
                axios.post('{{ route('timezone.update') }}', {
                    timezone
                });
            }
        }
    </script>
</div>
