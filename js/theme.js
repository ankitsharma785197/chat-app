function toggleTheme() {
  document.body.classList.toggle('dark-mode');
  const icon = document.getElementById('theme-icon');
  const isDark = document.body.classList.contains('dark-mode');
  icon.className = isDark ? 'ri-moon-line' : 'ri-sun-line';
  localStorage.setItem('theme', isDark ? 'dark' : 'light');
}

window.addEventListener('DOMContentLoaded', () => {
  const isDark = localStorage.getItem('theme') === 'dark';
  const icon = document.getElementById('theme-icon');
  if (isDark) {
    document.body.classList.add('dark-mode');
    icon.className = 'ri-moon-line';
  } else {
    icon.className = 'ri-sun-line';
  }
});
