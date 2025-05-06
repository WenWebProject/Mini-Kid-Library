<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books_PHP.Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head> 
<body>
    <h2>Unsere Bibliothek</h2>
    <p>Das hier ist unsere öffentliche Bibliothek. Unten haben wir dir eine Übersicht aller unsere Bücher aufgebaut.</p>
    <form action="" method="POST">
         <button name="to_Book">Zu den Büchern</button>
    </form>

    <form action="" method="POST">
        <h3>Neues Buch anlegen</h3>
        <p>Mit dem untenstehenden Formular kannst du ein neues Buch zu unserer Bibliothek hinzufügen.</p>
        <label for="title">Buchtitel:</label><br>
        <input type="text" id="title" name="title" required><br>

        <label for="description">Kurzbeschreibung:</label><br>
        <input type="text" id="description" name="description" placeholder = "Gebe hier kurze Beschreibung 
        des Buches ein (max. 150 Zeichen)" required><br>

        <label for="publishing_year">Jahr:</label><br>
        <input type="number" id="publishing_year" name="publishing_year" required><br>

        <label for="Vorlag">Vorlag:</label><br>
        <select name="Vorlag">
            <option value="grey"> Grey </option>
            <option value="cyan"> Cyan </option>
            <option value="purple"> Purple </option>
        </select>
        <br>
    
        <input  type="checkbox" id="einsehbar" name="einsehbar" value="einsehbar">&nbsp;Die in diesem Formular 
        eingegebene Daten werden verwendet, um ein neues Buch in unserer Datenbank anzulegen. Die Daten sind durch 
        Absenden des Formular für die Öffentlichkeit einsehbar.

        <br>
        <input type= "submit" name="erstellen" value= "Neues Buch erstellen">

    </form>

    <h3>Unsere Bücher</h3>
<div class="card-columns">
    <div class="card"> 
        <div class="card-header">Book Name get from Table </div>
        <div class="card-body">Description get from Table</div>
        <div class="card-footer">
          <button name="bearbeiten">Bearbeiten</button><br>
          <button name="löschen">Löschen</button>
        </div>
    </div> 
    <div class="card"> 
        <div class="card-header">Book Name get from Table </div>
        <div class="card-body">Description get from Table</div>
        <div class="card-footer">
          <button name="bearbeiten">Bearbeiten</button><br>
          <button name="löschen">Löschen</button>
        </div>
    </div> 
    <div class="card"> 
        <div class="card-header">Book Name get from Table </div>
        <div class="card-body">Description get from Table</div>
        <div class="card-footer">
          <button name="bearbeiten">Bearbeiten</button><br>
          <button name="löschen">Löschen</button>
        </div>
    </div> 
</div> 
</body>
</html>