document.querySelectorAll('.number-only').forEach(input => {
input.addEventListener('input', () => {
    input.value = input.value.replace(/\D/g, '');
});
});