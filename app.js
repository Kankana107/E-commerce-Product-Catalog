document.addEventListener("click", function (event) {
    const removeButton = event.target.closest("[data-confirm]");

    if (removeButton) {
        const confirmed = window.confirm(removeButton.dataset.confirm);

        if (!confirmed) {
            event.preventDefault();
        }
    }
});