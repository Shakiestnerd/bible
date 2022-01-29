<?php
ini_set('session.use_cookies', 0);

include("include.php");
//this function will check user language and return the file name to be included .. 
$langpath = check_lang($lang);
include_once($langpath);
//echo "Current Language: " . $lang;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" type="text/css" href="pom.css" />
	<title><?php echo $title; ?></title>
</head>

<body>
	<div id="wrap">

		<div id="header"><br />

			<h3><a href="index.php"><?php print $title; ?></a></h3>
			<p>
				<strong><?php print $slogan; ?></strong><br />
				<a href="plan.php?lang=en">English</a> | <a href="plan.php?lang=es">Espa&#241;ol</a>
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
			&nbsp;<h2><img src="images/ill_title.jpg" alt="ill title" width="63" height="20" />
				<?php
				echo $bplan;
				print ":&nbsp;" . getdate()['year'];
				?>
			</h2>
			<?php

			$start_month = 1;
			$start_day  = 1;
			$start_year = getdate()['year'];
			$old_month = 'Amber';
			$old_day = 0;


			$sql = "SELECT plan.day, books.full_name, plan.start_book, plan.start_chapter, plan.start_verse";
			$sql = $sql . ", plan.end_book, books_1.full_name, plan.end_chapter, plan.end_verse";
			$sql = $sql . " FROM " . $lang . "_books AS books, plan AS plan, " . $lang . "_books AS books_1 ";
			$sql = $sql . " WHERE books.book_id = plan.start_book AND books_1.book_id = plan.end_book";
			$sql = $sql . " ORDER BY plan.id;";

			$dbname = 'data/bread.sqlite3';
			$database = new SQLite3($dbname);

			$results = $database->query($sql);

			print '<table>';
			print $testaments;
			while ($row = $results->fetchArray()) {
				$day = $row[0];
				$sb = $row[1];
				$sc = $row[3];
				$sv = $row[4];
				$eb = $row[6];
				$ec = $row[7];
				$ev = $row[8];
				$ndate = mktime(0, 0, 0, $start_month, $start_day + $day - 1, $start_year);

				$month = date("F", $ndate);
				if ($month <> $old_month) {
					print '<tr><th colspan=3 align="center">';
					print '<a name="' . $month . '"></a>';
					print $mon[date("n", $ndate)];
					print '</th></tr>';
					$old_month = $month;
				}
				if ($day <> $old_day) {

					print '<tr><td>';
					print '<a href="index.php?day=' . $day . '">';
					print date('j', $ndate);
					print '</a>';
					print '</td>';
				}

				print '<td>';
				print build_ref($sb, $sc, $sv, $eb, $ec, $ev);
				if ($day <> $old_day) {
					print '</td>';
				} else
					print '</td></tr>';

				$old_day = $day;
			}
			print '</table>';
			$database->close();


			function build_ref($sb, $sc, $sv, $eb, $ec, $ev)
			{
				$return_value = $sb . ' ' . $sc;
				if ($sv > 0) {
					$return_value = $return_value . ':' . $sv;
				}
				if ($ec <> $sc or $ev <> $sv) {
					$return_value = $return_value . '-';
				}
				if ($ec <> $sc) {
					$return_value = $return_value . $ec;
				}

				if ($ev > 0) {
					$return_value = $return_value . $ev;
				}
				return $return_value;
			}


			?>
			<p><?php echo "Current Language: " . $lang; ?>&nbsp;</p>
		</div>

		<div id="footer">
			Copyright &copy; 2022 (Shakiestnerd). Design by kty <a href="http://www.studio-plume.org">studio-plume.org</a> for <a href="http://www.oswd.org/">OSWD</a>.</div>

	</div>
</body>

</html>