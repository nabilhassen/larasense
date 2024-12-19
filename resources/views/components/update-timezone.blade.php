@props(['currentTimezone'])
<div>
    <script>
        window.onload = function() {
            const timezone = Intl.DateTimeFormat().resolvedOptions().timeZone;

            if (timezone !== '{{ $currentTimezone }}') {
                axios.post('{{ route('timezone.update') }}', {
                    timezone
                });
            }
        }
    </script>
</div>
