<?php // includes/theme.php ?>
<script>
  // Runs immediately before page renders — prevents theme flash
  (function () {
    const theme = localStorage.getItem('theme');
    if (theme === 'dark') {
      document.documentElement.classList.add('dark');
    }
  })();
</script>