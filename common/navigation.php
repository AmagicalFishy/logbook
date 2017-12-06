<html>
<div id="navigation">
<h1>Lab Logbook</h1>
<div class="table">
    
<ul>
<li><a href='/logbook/index.php?page=home'>Home</a>
<li><a href='/logbook/index.php?page=contacts'>Contacts</a>
<li><a href='/logbook/index.php?page=calendar&month=0'>Logs</a>
    <ul>
    <?php
    # Populates the 'Logs' tab with the appropriate logbook titles and table names
    $connection = new PDO($dbinfo, $username, $password); 
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = $connection->prepare("SELECT title, table_name FROM logbooks");
    $query->execute();
    while ($titles = $query->fetch(PDO::FETCH_ASSOC)) {
        #echo "<li><a href='/logbook/main/daily_log/viewposts.php?log=" . $titles["table_name"] . "'>";
        echo "<li><a href='/logbook/index.php?page=posts&log=" . $titles["table_name"] . "'>";

        echo $titles['title'] . "</a>";
    }
    ?>
    </ul>
<li><a href="#">Links</a>
    <ul>
    <li><a href="http://www.google.com">Google</a>
    </ul>
<li><a href = "/logbook/index.php?page=admin">Admin</a>
</ul>

</div>
</div>
</html>


