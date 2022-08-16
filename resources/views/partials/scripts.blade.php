<!-- Bootstrap Tooltips -->
<script>
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

    const needSignInModal = document.getElementById('needSignInModal')
    if (needSignInModal) {
        needSignInModal.addEventListener('show.bs.modal', event => {
            tooltipList.forEach(tooltip => tooltip.hide());
        })
    }
</script>