<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>Шифр Вернама</title>
	<style type="text/css">
	 #maket {
	  width: 490px;
     }
     TD {
      vertical-align: top;
      padding: 20px;
     }
     TD#leftcolumn {
      width: 200px;
      background: #0ff;
      border: 1px solid #000;
     }
     TD#rightcolumn {
	  width: 200px;
      background: #fc3;
      border: 1px solid #000;
     }
     #space {
      width: 100px;
     }
  </style>
</head>
<body>
<table cellspacing="0" id="maket">
<form method="post" >
	<td id="leftcolumn">
	<p>Enter english text for encryption:</p>
	<p><input type="text" name="input0"/></p>
	<p><input type="submit" name="encode" value="зашифровать"/></p>
	</td>
	<td id="space"></td>
	<td id="rightcolumn">
	<p>Enter english text for decryption:</p>
	<p><input type="text" name="input1"/></p>
	<p>Enter key for decryption:</p>
	<p><input type="text" name="input2"/></p>
	<input type="submit" name="decode" value="расшифровать"/>
	</td>
</form>
</tr>
</table>
</body>
</html>

<?php

class Crypto {
	
	private $alphabet_en = array(
	'a' => '00000',
	'b' => '00001', 
	'c' => '00010', 
	'd' => '00011', 
	'e' => '00100',
	'f' => '00101',
	'g' => '00110',
	'h' => '00111',
	'i' => '01000',
	'j' => '01001',
	'k' => '01010',
	'l' => '01011',
	'm' => '01100',
	'n' => '01101',
	'o' => '01110',
	'p' => '01111',
	'q' => '10000',
	'r' => '10001',
	's' => '10010',
	't' => '10011',
	'u' => '10100',
	'v' => '10101',
	'w' => '10110',
	'x' => '10111',
	'y' => '11000',
	'z' => '11001',
	'_' => '11010',
	':' => '11011',
	',' => '11100',
	'?' => '11101',
	'!' => '11110',
	'.' => '11111');
	
	private $original_str;
	private $cipher_key;
	private $encoded_str;
	
	public function set_original_str($input) {
		$this->original_str = $input;
	}
	
	public function get_original_str() {
		return $this->make_array($this->original_str);
	}
	
	public function print_original_str() {
		print '<p>Исходный текст:</p>';
		print $this->original_str;
	}
	
	public function set_encoded_str($input) {
		$this->encoded_str = $input;
	}
	
	public function get_encoded_str() {
		return $this->make_array($this->encoded_str);
	}
	
	public function print_encoded_str() {
		print '<p>Зашифрованный текст:</p>';
		print $this->encoded_str;
	}
	
	public function set_cipher_key($input) {
		$this->cipher_key = $input;
	}
	
	public function get_cipher_key() {
		return $this->make_array($this->cipher_key);
	}
	
	public function print_cipher_key() {
		print '<p>Ключ(символьный):</p>';
		print $this->cipher_key;
	}
	
	public function generate_cipher_key() {
		$length = strlen($this->original_str);
		$key ='';
		for ($i = 0; $i < $length; $i++) {
			$k = substr ('abcdefghigklmnopqrstuvwxyz_:,?!.', rand (0, 31), 1);
			$key .= $k;	
		}
		return $key;
	}
	
	public function make_array($str) {
		$length_str = strlen($str);
		$t = 0;
		for ($j = 0; $j < $length_str; $j++) {
			$letter = substr ($str, $j, 1);
			if (preg_match ('/[a-z_:,?!\.]/i', $letter)) {
				$binary_array[$t] = $this->alphabet_en[$letter];
				$t++;
			}
		}
		return $binary_array;
	}
	
	public function do_xor($array_text, $array_key) {
		$len = sizeof($array_text);
		$encoded ='';
		for ($i = 0; $i < $len; $i++) {
			$bin1 = bindec($array_text[$i]);
			$bin2 = bindec($array_key[$i]);
			$xor_result = strval (decbin ($bin1 ^ $bin2));
			$symbol = str_pad ($xor_result, 5, '0', STR_PAD_LEFT);
			$encoded .= array_search($symbol, $this->alphabet_en);
		}
		return $encoded;
	}
}

if (isset ($_POST['encode'])){
	$b = new Crypto();
	$b->set_original_str($_POST['input0']);
	$new_key = $b->generate_cipher_key();
	$b->set_cipher_key($new_key);
	$array_str = $b->get_original_str();
	$array_key = $b->get_cipher_key();
	$result = $b->do_xor($array_str,$array_key);
	$b->set_encoded_str($result);
	$b->print_original_str();
	$b->print_cipher_key();
	$b->print_encoded_str();
}

if (isset ($_POST['decode'])){
	$a = new Crypto();
	$a->set_encoded_str($_POST['input1']);
	$a->set_cipher_key($_POST['input2']);
	$array_str = $a->get_encoded_str();
	$array_key = $a->get_cipher_key();
	$result = $a->do_xor($array_str,$array_key);
	$a->set_original_str($result);
	$a->print_encoded_str();
	$a->print_cipher_key();
	$a->print_original_str();
}
?>