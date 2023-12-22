document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById("confirmationModal");
    const confirmYes = document.getElementById("confirmYes");
    const confirmNo = document.getElementById("confirmNo");
    const span = document.getElementsByClassName("close-button")[0];
    let selectedCourse = null; // Variable pour garder une trace du cours sélectionné
  
    // écouteurs d'événements à tous les éléments de cours
    document.querySelectorAll('.course').forEach(course => {
      course.addEventListener('click', function() {
        let courseId = this.id; // ID du cours
        let parentTab = this.closest('.tabcontent').id; // Onglet parent
  
        if (parentTab === 'chosenCourses') {
          ajouterAuCoursEnCours(courseId, this);
        } else if (parentTab === 'runningCourses') {
          selectedCourse = this; // Mémoriser le cours sélectionné
          modal.style.display = "block"; // Afficher la modale
        }
      });
    });
  
    // Lorsque l'utilisateur clique sur "Oui"
    confirmYes.addEventListener("click", function() {
      supprimerDuCoursEnCours(selectedCourse.id, selectedCourse);
      modal.style.display = "none"; // Cacher la modale
    });
  
    // Lorsque l'utilisateur clique sur "Non"
    confirmNo.addEventListener("click", function() {
      consulterCours(selectedCourse.id);
      modal.style.display = "none"; // Cacher la modale
    });
  
    // Fermer la modale avec le bouton (x)
    span.onclick = function() {
      modal.style.display = "none";
    }
  
    // Fermer la modale en cliquant en dehors
    window.onclick = function(event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }
  });
  
  function ajouterAuCoursEnCours(courseId, courseElement) {
 
    const destination = document.getElementById('runningCourses');
    destination.appendChild(courseElement);
  }
  
  function supprimerDuCoursEnCours(courseId, courseElement) {
   
    courseElement.remove();
  }
  
  function consulterCours(courseId) {
  
    alert("Consultation du cours : " + courseId);
    
  }
  document.querySelectorAll('.course').forEach(course => {
    course.addEventListener('mousedown', function() {
      this.style.transform = 'scale(0.95)'; // Réduit la taille lors du clic
    });
  
    course.addEventListener('mouseup', function() {
      this.style.transform = 'scale(1.05)'; // Reviens à la taille du survol
    });
  
    course.addEventListener('mouseleave', function() {
      this.style.transform = 'scale(1)'; // Reviens à la taille normale si la souris sort de l'élément
    });
  });
    