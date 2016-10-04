<!--
Vul hieronder het grid in wat je wilt gebruiken. Een handige tool om deze eenvoudig en snel te configuren voor meerdere verschillende devices is:
http://www.shoelace.io/ of http://jaykanakiya.com/ of http://www.layoutit.com/build

Je kan zelf bepalen of je een container om je template wilt of niet
De content van een container bepaald de naam van je template. Voorbeeld hieronder is dat dus: 'Standaard template'
Je kan per rij aangeven wat hiervan de titel is. Bijvoorbeeld: 'Slider row', of 'Tekst en nieuwsblok' Deze heeft op dit moment geen functie.
De interne kolommen zijn de zogenaamde pagina secties. Hierin kan je content blokken stoppen in de pagina module. De tekst in de kolom bepaald de sectie naam.
In het voorbeeld hieronder zie je ook hoe je een default sectie kan defineren en hoe je ervoor kan zorgen dat er 'autoblokken' worden aangelegd.
-->
<div class="container" lcms-grid="12">Standaard
    <div class="row">rij
        <div class="col-md-12" default="true">Content</div>
    </div>
</div>
