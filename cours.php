<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="CSS/cours.css">
<title>Tableau de bord des cours</title>
</head>
<body>
  <div id="video-container">
          <video autoplay muted loop id="myVideo">
              <source src="Videos/video1.mp4" type="video/mp4">
          </video>
          <div class="video-overlay"></div>
          <div class="flex-container">
    <header class="main-header">
                    <div class="title">WEB ISLAND KINSHASA O2027</div>
                    <nav class="main-nav">
                        <ul>
                            <li><a href="inde.php">Home</a></li>
                            <li><a href="map.php">Map</a></li>
                            <li><a href="forum.php">forum</a></li>
                            <li><a href="courses.php">Courses</a></li>
                            <li><a href="contact.html">Contact</a></li>
                        </ul>
                    </nav>
                </header>

<!-- Barre de navigation pour les onglets -->
<div class="tabs">
  <button class="tablink" onclick="openTab(event, 'runningCourses')">Current Courses</button>
  <button class="tablink" onclick="openTab(event, 'chosenCourses')">Courses Available</button>
</div>

<!-- Contenu pour les cours en cours -->
<div id="runningCourses" class="tabcontent" style="display:block;">
  <div class="course" id="course2">
    <img src="RESSOURCES/Images/COURS/image1.png" alt="UX & Web Design">
    <h3>Web Skills : Beginner</h3>
    <p>Auteur: Dann Petty</p>
    <p>Note: ⭐⭐⭐⭐</p>
   
  </div>
  <div class="course" id="course1">
    <img src="RESSOURCES/Images/COURS/image2.png" alt="Illustrator CC 2019">
    <h3>HTML for Beginner</h3>
    <p>Auteur: Dann Petty</p>
    <p>Note: ⭐⭐⭐⭐</p>
  </div>
</div>

<!-- Contenu pour les cours choisis par l'utilisateur -->
<div id="chosenCourses" class="tabcontent" style="display:none;">
  <div class="course" id="course3">
    <img src="RESSOURCES/Images/COURS/image3.png" alt="Learn Angular 5">
    <h3>Web  for absolute Beginner level 1...</h3>
    <p>Auteur: Reed Krakoff</p>
    <p>Note: ⭐⭐⭐⭐</p>
  </div>
  <div class="course" id="course4">
    <img src="RESSOURCES/Images/COURS/image4.png" alt="Learn Bootstrap">
    <h3>HTML for absolute Beginner level 1...</h3>
    <p>Auteur: Walter Scott</p>
    <p>Note: ⭐⭐⭐</p>
  </div>
  <div class="course" id="course5">
    <img src="RESSOURCES/Images/COURS/image5.png" alt="Master Powerpoint">
    <h3>CSS for absolute Beginner level 1....</h3>
    <p>Auteur: Cristian Doru Barin</p>
    <p>Note: ⭐⭐⭐⭐⭐</p>
  </div>
  <div class="course">
    <img src="RESSOURCES/Images/COURS/image1.png" alt="Motion Graphics">
    <h3>HTML CSS for absolute Beginner level 2...</h3>
    <p>Auteur: Reed Krakoff</p>
    <p>Note: ⭐⭐⭐⭐</p>

  </div>
  <div class="course">
    <img src="RESSOURCES/Images/COURS/image2.png" alt="Learn Bootstrap">
    <h3>jS...</h3>
    <p>Auteur: Walter Scott</p>
    <p>Note: ⭐⭐⭐</p>
  
  </div>
  <div class="course">
    <img src="RESSOURCES/Images/COURS/image3.png" alt="Master Powerpoint">
    <h3>Powerpoint 2016 2019 - Master Powerpoint...</h3>
    <p>Auteur: Cristian Doru Barin</p>
    <p>Note: ⭐⭐⭐⭐⭐</p>
  </div>
  <div class="course">
    <img src="RESSOURCES/Images/COURS/image4.png" alt="Motion Graphics">
    <h3>Motion Graphics & Data Visualization</h3>
    <p>Auteur: Reed Krakoff</p>
    <p>Note: ⭐⭐⭐⭐</p>

  </div>
  <div class="course">
    <img src="RESSOURCES/Images/COURS/image5.png" alt="Learn Bootstrap">
    <h3>Boostrap</h3>
    <p>Auteur: Walter Scott</p>
    <p>Note: ⭐⭐⭐</p>

  </div>
  <div class="course">
    <img src="RESSOURCES/Images/COURS/image1.png" alt="Master Powerpoint">
    <h3>PHP for Beginner...</h3>
    <p>Auteur: Cristian Doru Barin</p>
    <p>Note: ⭐⭐⭐⭐⭐</p>
  
  </div>
  <div class="course">
    <img src="RESSOURCES/Images/ville.png" alt="Motion Graphics">
    <h3>Motion Graphics & Data Visualization</h3>
    <p>Auteur: Reed Krakoff</p>
    <p>Note: ⭐⭐⭐⭐</p>
  
  </div>

</div>
<!-- Modale de Confirmation -->
<div id="confirmationModal" class="modal">
  <div class="modal-content">
    <span class="close-button">&times;</span>
    <h2>Confirmer l'action</h2>
    <p>Voulez-vous supprimer ce cours ?</p>
    <button id="confirmYes">Oui</button>
    <button id="confirmNo">Non</button>
  </div>
</div>

<script>
function openTab(evt, tabName) {
  var i, tabcontent;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  document.getElementById(tabName).style.display = "block";
}
</script>
<script src="JS/cours.js"></script>
</body>
</html>
</div>
