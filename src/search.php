<?php
  session_start();
  $_SESSION['searchText']=$_POST['searchText'];

  $conn = pg_connect("host=localhost port=5432 dbname=Scholarnet 
  user=postgres password=biar") 
  or die('Could not connect: ' . pg_last_error());
  // Check connection
  if (!$conn) {
    die("Connection failed: " . pg_last_error());
  }

  // Prepare the query
  $searchText = '%' . $_POST['searchText'] . '%';
  $query = "SELECT * FROM compito WHERE testo or titolo ILIKE $1 AND ";

  // Prepare the statement
  $stmt = pg_prepare($conn, "search_query", $query);
  $result = pg_execute($conn, "search_query", array($searchText));

  // Fetch the results
  $searchResults = pg_fetch_all($result);

  // Store the results in a session variable
  $_SESSION['searchResults'] = $searchResults;

  pg_free_result($result);
  pg_close($conn);

  // Redirect back to the previous page
  echo "<script>window.history.back()</script>"
?>


<?php
  $searchResults = $_SESSION['searchResults'];
?>


<h2 class="mb-4">Risultati della ricerca</h2>
<?php foreach ($searchResults as $annuncio): ?>
  <div class="card text-black bg-light mb-3 d-inline-block">
    <div class="card-body">
      <span style="font-size: 20px;">
        <i class="fa-solid fa-book" style="font-size: 20px;"></i>
        Compito
      </span>
      <header class="card-header bg-light text-black">
        <p class="card-subtitle small" style="text-align: right;">Data di pubblicazione: <?php echo $annuncio['data_pubblicazione']; ?></p>
      </header>

      <div class="card-body">
        <p class="card-text"><?php echo $annuncio['testo']; ?></p>
        <?php if (!empty($annuncio['allegati'])): ?>
          <p class="card-text ml-3">Allegati: <?php echo $annuncio['allegati']; ?></p>
        <?php endif; ?>
      </div>
    </div>
    <footer class="card-footer">
      <a href="#" class="card-link text-black">Commenti (3)</a>
    </footer>
  </div>
<?php endforeach; ?>
	 