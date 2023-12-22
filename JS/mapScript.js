// mapScript.js
document.querySelectorAll('.location-bubble').forEach(item => {
  item.addEventListener('mouseenter', (e) => {
  
    const infoElement = item.querySelector('.info');
    const info = infoElement ? infoElement.textContent : '';
    const popup = document.getElementById('info-popup');
    if (popup) {
      popup.innerText = info;
      popup.style.display = 'block';
      // Positionner la popup par rapport à l'élément '.location-bubble' et non par rapport à la page
      const rect = item.getBoundingClientRect();
      popup.style.left = rect.left + window.scrollX + 'px';
      popup.style.top = rect.top + window.scrollY + 'px';
    }
  });

  item.addEventListener('mouseleave', () => {
    const popup = document.getElementById('info-popup');
    if (popup) {
      popup.style.display = 'none';
    }
  });
});
