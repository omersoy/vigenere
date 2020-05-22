<?php
// değişkenleri başlatıyoruz...
$pswd = "";
$code = "";
$error = "";
$valid = true;
$color = "white";
// form gönderildiyse
if ($_SERVER['REQUEST_METHOD'] == "POST")
{
	// şifrele ve şifrelenmişleri çöz
	require_once('vigenere.php');
	
	// değişkenleri ayarla
	$pswd = $_POST['pswd'];
	$code = $_POST['code'];
	
	// şifreninin yani keyin sağlanıp sağlanmadığını kontrol ediyoruz.
	if (empty($_POST['pswd']))
	{
		$error = "Lütfen key giriniz!";
		$valid = false;
		$color = "white";
	}
	
	// metin olup olmadığını kontrol ediyoruz
	else if (empty($_POST['code']))
	{
		$error = "Anahtar kelime girin!";
		$valid = false;
	}
	
	// şifrenin(keyin) alphanumeric olup olmadığını kontrol ediyoruz
	else if (isset($_POST['pswd']))
	{
		if (!ctype_alpha($_POST['pswd']))
		{
			$error = "Şifre sadece alfabetik karakterler içermelidir!";
			$valid = false;
			$color = "white";
		}
	}
	
	// girilen değerler geçerliyse
	if ($valid)
	{
		// eğer encrypt butonuna tıklandıysa
		if (isset($_POST['encrypt']))
		{
			$code = encrypt($pswd, $code);
			$error = "Metin başarıyla şifrelendi!";
			$color = "white";
		}
			
		// eğer decrypt button butonuna tıklandıysa
		if (isset($_POST['decrypt']))
		{
			$code = decrypt($pswd, $code);
			$error = "Kod başarıyla çözüldü!";
			$color = "white";
		}
	}
}
?>

<html>
	<head>
		<title>ISE426 - Vigenere Şifreleme</title>
		<link href="favicon.ico" rel="shortcut icon" type="image/x-icon" />
		<link rel="stylesheet" type="text/css" href="style.css">
		<script type="text/javascript" src="Script.js"></script>
	</head>
	<body>
		<br><br><br>
		<form action="index.php" method="post">
			<table cellpadding="5" align="center" cellpadding="2" border="7">
				<caption><hr><b>ISE426 - Murat Koyuncu</b><hr></caption>
				<tr>
					<td align="center">Anahtar Kelime: <input type="text" name="pswd" id="pass" placeholder="Anahtar kelime giriniz" value="<?php echo htmlspecialchars($pswd); ?>" /></td>
				</tr>
				<tr>
					<td align="center"><textarea id="box" name="code" placeholder="Plaintext(s) giriniz"><?php echo htmlspecialchars($code); ?></textarea></td>
				</tr>
				<tr>
					<td><input type="submit" name="encrypt" class="button" value="ŞİFRELE" onclick="validate(1)" /></td>
				</tr>
				<tr>
					<td><input type="submit" name="decrypt" class="button" value="ŞİFREYİ ÇÖZ" onclick="validate(2)" /></td>
				</tr>
				<tr>
					<td align="center">ISE426 | VIGENERE | Copyright &copy; 2019 | OMER - TAHA</span></td>
				</tr>
				<tr>
					<td><center><div style="color: <?php echo htmlspecialchars($color) ?>"><?php echo htmlspecialchars($error) ?></div></center></td>
				</tr>
			</table>
		</form>
	</body>
</html>