function toggleTheme() {
  document.body.classList.toggle('dark');

  const isDarkModeEnabled = document.body.classList.contains('dark');

  document.cookie = `theme=${isDarkModeEnabled ? 'dark' : 'light'}; expires=Fri, 31 Dec 9999 23:59:59 GMT; path=/`;
}

document.getElementById('theme-toggle').addEventListener('click', toggleTheme);

function checkThemePreference() {
  const themeCookie = document.cookie.split('; ').find(row => row.startsWith('theme='));

  if (themeCookie) {
    const theme = themeCookie.split('=')[1];
    document.body.classList.toggle('dark', theme === 'dark');
  }
}

checkThemePreference();
