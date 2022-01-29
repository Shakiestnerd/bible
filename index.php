<?php
//session_name ('name');
ini_set('session.use_cookies', 0);

?>
<?php include("include.php"); ?>
<?PHP
//this function will check user language and return the file name to be included .. 
$langpath = check_lang($lang);
include_once($langpath);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" type="text/css" href="pom.css" />
	<title><?php print $title; ?></title>

</head>

<body>
	<div id="wrap">

		<div id="header"><br />

			<h3><a href="index.php"><?php print $title; ?></a></h3>
			<p><strong><?php print $slogan; ?></strong><br />
				<a href="index.php?lang=en">English</a> | <a href="index.php?lang=es">Espa&#241;ol</a>
			</p>
			<p>
				<?php
				print date('M j, Y');
				?>
			</p>
		</div>

		<img src="images/header.jpg" width="790" height="228" alt="" />

		<div id="avmenu">
			<h2 class="hide">Menu:</h2>
			<ul>
				<li><a href="index.php"><?php print $welcome; ?></a></li>
				<li><a href="plan.php#
<?php
print date('F');
?> 
"><?php print $plan; ?>
					</a></li>
				<li><a href="about.php"><?php print $about; ?></a></li>
			</ul>

		</div>

		<div id="content">

			<?php
			// $today contains the number of the current date.
			if (isset($_GET['day'])) {
				$today = $_GET['day'];
			} else {
				$today = date('z') + 1;
			}


			// echo 'Today is day #' . $today;
			$english = 'en';
			$spanish = 'es';

			// set the language to $english for now.
			// $lang = $english;
			$bible = $lang . '_bible';
			$books = $lang . '_books';

			// database connection
			$dbname = 'data/bread.sqlite3';

			$database = new SQLite3($dbname);

			$sql = 'SELECT * FROM plan WHERE day = ' . $today . ' ORDER BY id;';
			$results = $database->query($sql);

			// OUTER LOOP for old and new testament parts of plan
			while ($plan = $results->fetchArray()) {

				$sb = $plan[1];
				$sc = $plan[2];
				$sv = $plan[3];
				$eb = $plan[4];
				$ec = $plan[5];
				$ev = $plan[6];

				// echo $sb, $sc, $sv, $eb, $ec, $ev, "<br />";
				$sql = 'SELECT * FROM ' . $bible . ' e LEFT OUTER JOIN ' . $books . ' b ON e.book_id=b.book_id WHERE ';
				$sql = $sql . build_fetch($sb, $sc, $sv, $eb, $ec, $ev);
				// print $sql . '<br />';

				$record_set = $database->query($sql);

				$old_chapter = 0;
				$book_flag = True;
				// INNER LOOP for the chapters and verses
				while ($row = $record_set->fetchArray()) {
					if ($book_flag) {
						print '&nbsp;<h2><img src="images/ill_title.jpg" alt="ill title" width="63" height="20" />' . $row[7] . '</h2>';
						$book_flag = false;
					}
					$current_chapter = $row[2];
					if ($current_chapter <> $old_chapter) {
						print "<br /><h3>" . $chap . " " . $current_chapter . '</h3>';
						$old_chapter = $current_chapter;
					}
					print $row[3];
					$verse = str_replace('[', '<i>', $row[4]);
					$verse = str_replace(']', '</i>', $verse);
					echo '&nbsp;' . $verse . '<br />';
				}
			}
			$database->close();


			function build_fetch($sb, $sc, $sv, $eb, $ec, $ev)
			{
				$return_value = 'e.book_id = ' . $sb;

				if ($sc == $ec) {
					if ($sv == 0) {
						$return_value = $return_value . ' AND e.chapter_id = ' . $sc;
					} else {
						$return_value = $return_value . ' AND e.chapter_id = ' . $sc . ' AND ' . '(e.verse_id >= ' . $sv . ' AND ' . 'e.verse_id <= ' . $ev . ')';
					}
				} else {
					if ($sv == 0) {
						$return_value = $return_value . ' AND (chapter_id >= ' . $sc . ' AND chapter_id <= ' . $ec . ')';
					}
				}

				$return_value = $return_value . ';';
				return $return_value;
			}


			?>

			<p>&nbsp;</p>

		</div>

		<div id="footer">
			Copyright &copy; 2022 (Shakiestnerd). Design by kty <a href="http://www.studio-plume.org">studio-plume.org</a> for <a href="http://www.oswd.org/">OSWD</a>.</div>

	</div>
</body>

</html>