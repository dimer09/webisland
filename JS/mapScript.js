// mapScript.js
document.querySelectorAll('.map-location').forEach(item => {
  item.addEventListener('mouseenter', (e) => {
      const info = e.target.getAttribute('data-info');
      const popup = document.getElementById('info-popup');
      popup.innerText = info;
      popup.style.display = 'block';
      popup.style.left = e.pageX + 'px';
      popup.style.top = e.pageY + 'px';
  });

  item.addEventListener('mouseleave', () => {
      document.getElementById('info-popup').style.display = 'none';
  });
});
