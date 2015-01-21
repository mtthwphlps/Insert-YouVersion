<?php
/*
******* VERSIONS *******
array(
	"SHORT NAME" => array(
		"Name" => "LONG NAME",
		"Short" => "YOUVERSION SHORT NAME",
		"yvid" => "YOUVERSION ID NUMBER"
	),
);
*/
function Insert_YouVersion_Versions() {
	$insert_youversion_versions = array(
		"ASV" => array(
			"Name" => "American Standard Version",
			"Short" => "ASV",
			"yvid" => "12",
		),
		"NIV" => array( 
			"Name" => "New International Version",
			"Short" => "NIV",
			"yvid" => "111",
		),
	);
	return $insert_youversion_versions;
}

/*
******* BOOKS *******
array(
	"BOOK NAME" => "YOUVERSION SHORT NAME",
);
*/
function Insert_YouVersion_Books() {
	$insert_youversion_books = array(
		"gen" => "Genesis",
		"exo" => "Exodus",
		"lev" => "Leviticus",
		"num" => "Numbers",
		"deu" => "Deuturonomy",
		"jos" => "Joshua",
		"jdg" => "Judges",
		"rut" => "Ruth",
		"1sa" => "1 Samuel",
		"2sa" => "2 Samuel",
		"1ki" => "1 Kings",
		"2ki" => "2 Kings",
		"1ch" => "1 Chronicles",
		"2ch" => "2 Chronicles",
		"ezr" => "Ezra",
		"neh" => "Nehemiah",
		"est" => "Esther",
		"job" => "Job",
		"psa" => "Psalm",
		"pro" => "Proverbs",
		"ecc" => "Ecclesiastes",
		"sng" => "Song of Solomon",
		"isa" => "Isaiah",
		"jer" => "Jeremiah",
		"lam" => "Lamentations",
		"ezk" => "Exekiel",
		"dan" => "Daniel",
		"hos" => "Hosea",
		"jol" => "Joel",
		"amo" => "Amos",
		"oba" => "Obadiah",
		"jon" => "Jonah",
		"mic" => "Micah",
		"nam" => "Nahum",
		"hab" => "Habakkuk",
		"zep" => "Zepheniah",
		"hag" => "Haggai",
		"zec" => "Zechariah",
		"mal" => "Malachi",
		"mat" => "Matthew",
		"mrk" => "Mark",
		"luk" => "Luke",
		"jhn" => "John",
		"act" => "Acts",
		"rom" => "Romans",
		"1co" => "1 Corinthians",
		"2co" => "2 Corinthians",
		"gal" => "Galatians",
		"eph" => "Ephesians",
		"php" => "Philippians",
		"col" => "Colossians",
		"1th" => "1 Thessalonians",
		"2th" => "2 Thessalonians",
		"1ti" => "1 Timothy",
		"2ti" => "2 Timothy",
		"tit" => "Titus",
		"phm" => "Philemon",
		"heb" => "Hebrews",
		"jas" => "James",
		"1pe" => "1 Peter",
		"2pe" => "2 Peter",
		"1jn" => "1 John",
		"2jn" => "2 John",
		"3jn" => "3 John",
		"jud" => "Jude",
		"rev" => "Revelation",
	);
	return $insert_youversion_books;
}
?>