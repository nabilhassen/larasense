@persist('banner')
    <div class="hidden mt-[72px]">
        <div
            class="fixed inset-x-0 top-0 z-[60]"
            id="bb-banner-container"
        ></div>
    </div>
@endpersist

<script
    defer
    data-navigate-once
>
    const targetNode = document.getElementById("bb-banner-container");

    const observer = new MutationObserver((mutationList, observer) => {
        for (const mutation of mutationList) {
            if (mutation.type === "childList") {
                targetNode.parentElement.classList.remove('hidden');
                observer.disconnect();
            }
        }
    });

    observer.observe(targetNode, {
        attributes: true,
        childList: true,
        subtree: true
    });
</script>

<script
    defer
    data-navigate-once
    src="https://media.bitterbrains.com/main.js?from=LARASENSE&type=inline"
></script>
