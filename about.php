<?php
session_name('name');
ini_set('session.use_cookies', 0);

?>
<?php include("include.php"); ?>
<?PHP
//this function will check user language and return the file name to be included .. 
$langpath = check_lang($lang);
include_once($langpath);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
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
			&nbsp;<h2><img src="images/ill_title.jpg" alt="ill title" width="63" height="20" /><?php print $about; ?></h2>
			<p>This web site is dedicated to promoting the reading of the Holy Bible. It is a two track plan that gives a scripture from
				the old testament and the new testament for each day of the year. This helps add some variety in your reading. Yes, it can be painful wading through
				the book of Numbers. So, the two track plan mixes things up a little bit.</p>

			<p><img src="images/ill1.jpg" height="100" width="125" class="left" alt="ill_1" />
				There are many reasons to read the Bible. It is a book of undeniable historical and archeological value whether you agree with
				the accounts found there or not. People have found comfort in the words of Christ while going through personal battles. It has
				provided a moral compass to many throughout history. It has withstood intense scrutiny from believers and unbelievers alike. It
				also gives hope of salvation. So, for whatever reason you may have for reading the Bible, I believe your life will
				be enriched by having done so.</p>
			<p>
				Our prayer is that through reading the Bible, you will gain greater insight into living your life and have the weapons you need to
				face the challenges of each day. God bless you as you read his word.
			</p>

			<p>&nbsp;</p>

			<h3><img src="images/ill_title.jpg" alt="ill title" width="63" height="20" />Presentation</h3>
			<p>This site is simple. It's purpose is to make it easy to read the Bible during a one year period. Clicking the "Welcome" link
				on the menu, will take you to the scriptures for that day. Once there, you may want to bookmark the page so you
				can quickly return to read that day's reading. <br />
				Choose the plan link from the menu in order to see the entire year's reading plan. This will help if you
				missed a day and want to catch up with your reading.

				<img src="images/ill2.jpg" class="right" height="100" width="125" alt="ill_2" />
			</p>

			<p>English scriptures are from the King James version of the Bible.</p>

			<p>&nbsp;</p>
		</div>

		<div id="footer">
			Copyright &copy; 2022 (Shakiestnerd). Design by kty <a href="http://www.studio-plume.org">studio-plume.org</a> for <a href="http://www.oswd.org/">OSWD</a>.</div>

	</div>
</body>

</html>