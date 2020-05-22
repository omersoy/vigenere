<?php
// verilen metni şifrelemek için fonksiyon
function encrypt($pswd, $text)
{
	// anahtarı(key) küçük harfe çevirme
	$pswd = strtolower($pswd);
	
	// değişkenleri başlatıyoruz...
	$code = "";
	$ki = 0;
	$kl = strlen($pswd);
	$length = strlen($text);
	
	// metindeki her satırın üzerinde yineleme
	for ($i = 0; $i < $length; $i++)
	{
		// harf alfa ise, şifreleyin
		if (ctype_alpha($text[$i]))
		{
			// büyük harf
			if (ctype_upper($text[$i]))
			{
				$text[$i] = chr(((ord($pswd[$ki]) - ord("a") + ord($text[$i]) - ord("A")) % 26) + ord("A"));
			}
			
			// küçük harf
			else
			{
				$text[$i] = chr(((ord($pswd[$ki]) - ord("a") + ord($text[$i]) - ord("a")) % 26) + ord("a"));
			}
			
			// anahtar dizinini güncelliyoruz...
			$ki++;
			if ($ki >= $kl)
			{
				$ki = 0;
			}
		}
	}
	
	// şifreli kodu dönderiyoruz
	return $text;
}
// verilen metnin şifresini çözme foksiyonu(decode)
function decrypt($pswd, $text)
{
	// anahtarı(key) küçük harfe çevirme
	$pswd = strtolower($pswd);
	
	// intialize variables
	$code = "";
	$ki = 0;
	$kl = strlen($pswd);
	$length = strlen($text);
	
	// metindeki her satırın üzerinde yineleme
	for ($i = 0; $i < $length; $i++)
	{
		// eğer harf ise şifresini çöz(decode)
		if (ctype_alpha($text[$i]))
		{
			// büyük harf
			if (ctype_upper($text[$i]))
			{
				$x = (ord($text[$i]) - ord("A")) - (ord($pswd[$ki]) - ord("a"));
				
				if ($x < 0)
				{
					$x += 26;
				}
				
				$x = $x + ord("A");
				
				$text[$i] = chr($x);
			}
			
			// küçük harf
			else
			{
				$x = (ord($text[$i]) - ord("a")) - (ord($pswd[$ki]) - ord("a"));
				
				if ($x < 0)
				{
					$x += 26;
				}
				
				$x = $x + ord("a");
				
				$text[$i] = chr($x);
			}
			
			// anahtar dizinini güncelliyoruz
			$ki++;
			if ($ki >= $kl)
			{
				$ki = 0;
			}
		}
	}
	
	// şifresi çözülen metni döndürdük
	return $text;
}
?>