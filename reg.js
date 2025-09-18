document.addEventListener('DOMContentLoaded', function () {
  const form = document.getElementById('form');
  if (!form) return;
  form.addEventListener('submit', function (e) {
    const pass = document.getElementById('Pass');
    const confirm = document.getElementById('ConfirmPass');
    if (pass && confirm && pass.value !== confirm.value) {
      e.preventDefault();
      alert('Passwords do not match.');
      confirm.focus();
    }
  });
});
