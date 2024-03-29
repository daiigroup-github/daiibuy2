<?php
#===========================================================================
#= Script : phpCode128
#= File   : code128.class.php
#= Version: 0.1
#= Author : Mike Leigh
#= Email  : mike@mikeleigh.com
#= Website: http://www.mikeleigh.com/scripts/phpcode128/
#= Support: http://www.mikeleigh.com/forum
#===========================================================================
#= Copyright (c) 2006 Mike Leigh
#= You are free to use and modify this script as long as this header
#= section stays intact
#=
#= This file is part of phpCode128.
#=
#= phpFile is free software; you can redistribute it and/or modify
#= it under the terms of the GNU General Public License as published by
#= the Free Software Foundation; either version 2 of the License, or
#= (at your option) any later version.
#=
#= phpFile is distributed in the hope that it will be useful,
#= but WITHOUT ANY WARRANTY; without even the implied warranty of
#= MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
#= GNU General Public License for more details.
#=
#= You should have received a copy of the GNU General Public License
#= along with DownloadCounter; if not, write to the Free Software
#= Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
#===========================================================================
//include('image.class.php');

class Code128
{

	var $image = false;
	var $dimensions = array(
		'width'=>false,
		'height'=>false,
		'pixel_width'=>false,
		'text_spacing'=>false,
		'border_width'=>false,
		'border_spacing'=>false
	);
	var $bbox;
	var $current_set = '';
	var $flags = array(
		'ean_style'=>false,
		'show_text'=>false,
		'auto_adjust_font_size'=>false
	);
	var $text = array(
		'value'=>'',
		'data'=>array());
	var $encoding = array(
		'value'=>'',
		'data'=>array(),
		'strings'=>array());
	var $checksum = array(
		'value'=>0,
		'data'=>array());
	var $font = false;
	var $font_size;
	var $font_size_original;
	var $set = array();
	var $value = array();

	function phpCode128($text = '', $height = 150, $font = false, $font_size = false)
	{
		//set the defaults for the barcode
		$this->setDefaults();
		$this->setText($text);

		//some default parameters which can be overridden with the public methods
		$this->setBorderWidth(2);
		$this->setBorderSpacing(10);
		$this->setPixelWidth(1);
		$this->setEanStyle(true);
		$this->setShowText(true);
		$this->setAutoAdjustFontSize(true);
		$this->setTextSpacing(5);

		if(($font <> false) and ( $font_size <> false))
		{
			$this->addFont($font, $font_size);
			$this->font_size_original = $font_size;
		}

		//set the base dimensions and calculate the encoding sequence
		$this->setImageHeight($height - (($this->getBorderWidth() + $this->getBorderSpacing()) * 2));
		$this->setImageWidth($this->calculateImageWidth());
	}

	function getAutoAdjustFontSize()
	{
		//gets the boolean value of auto_adjust_font_size
		return $this->flags['auto_adjust_font_size'];
	}

	function setAutoAdjustFontSize($flag)
	{
		//sets the boolean value of auto_adjust_font_size
		$this->flags['auto_adjust_font_size'] = $flag;
		if(($this->font <> false) and ( $this->font_size <> false) and ( $this->getAutoAdjustFontSize() <> true))
		{
			$this->font_size = $this->font_size_original;
			$this->bbox = $this->imagettfbboxextended($this->getFontSize(), $this->getFont(), $this->getText());
		}
	}

	function getEanStyle()
	{
		//gets the boolean value of ean_style
		return $this->flags['ean_style'];
	}

	function setEanStyle($flag)
	{
		//sets the boolean value of ean_style
		$this->flags['ean_style'] = $flag;
	}

	function getShowText()
	{
		//gets the boolean value of show_text
		return $this->flags['show_text'];
	}

	function setShowText($flag)
	{
		//sets the boolean value of show_text
		$this->flags['show_text'] = $flag;
	}

	function getBorderSpacing()
	{
		//gets the spacing of the border between the border and the barcode
		return $this->dimensions['border_spacing'];
	}

	function setBorderSpacing($pixels)
	{
		//sets the spacing of the border between the border and the barcode
		$this->dimensions['border_spacing'] = $pixels;

		//this changes the image width so it needs to be calculated again
		$this->setImageWidth($this->calculateImageWidth());
	}

	function getBorderWidth()
	{
		//gets the width of the border
		return $this->dimensions['border_width'];
	}

	function setBorderWidth($pixels)
	{
		//sets the width of the border
		$this->dimensions['border_width'] = $pixels;

		//this changes the image width so it needs to be calculated again
		$this->setImageWidth($this->calculateImageWidth());
	}

	function getTextSpacing()
	{
		//gets the size of the barcode pixel
		return $this->dimensions['text_sapcing'];
	}

	function setTextSpacing($pixels)
	{
		//sets the size of the barcode pixel
		$this->dimensions['text_sapcing'] = $pixels;
	}

	function getPixelWidth()
	{
		//gets the size of the barcode pixel
		return $this->dimensions['pixel_width'];
	}

	function setPixelWidth($pixels)
	{
		//sets the size of the barcode pixel
		$this->dimensions['pixel_width'] = $pixels;

		//this changes the image width so it needs to be calculated again
		$this->setImageWidth($this->calculateImageWidth());
	}

	function getImageWidth()
	{
		//gets the width of the image
		return $this->dimensions['width'];
	}

	function setImageWidth($pixels)
	{
		//sets the width of the image and recreates the canvas
		$this->dimensions['width'] = $pixels;
		$this->image = new image($this->getImageWidth(), $this->getImageHeight());
		if($this->font <> false)
		{
			$this->setFont($this->getFont());
			if($this->getAutoAdjustFontSize())
			{
				if($this->getEANStyle())
				{
					$width = ($this->getImageWidth() - (($this->getBorderWidth() + $this->getBorderSpacing()) * 2) - (($this->getPixelWidth() * 11) * 2) - ($this->getPixelWidth() * 2) - ($this->getTextSpacing() * 2));
				}
				else
				{
					$width = ($this->getImageWidth() - (($this->getBorderWidth() + $this->getBorderSpacing() + $this->getTextSpacing()) * 2));
				}
				$this->setFontSize($this->calculateTextSize($width));
			}
			else
			{
				$this->bbox = $this->imagettfbboxextended($this->getFontSize(), $this->getFont(), $this->getText());
			}
		}
	}

	function getImageHeight()
	{
		//gets the height of the image
		return $this->dimensions['height'];
	}

	function setImageHeight($pixels)
	{
		//sets the height of the image
		$this->dimensions['height'] = $pixels;
	}

	function getFont()
	{
		//gets the font
		return $this->font;
	}

	function setFont($font)
	{
		//sets the font
		$this->font = $font;
		$this->image->addFont($font);
	}

	function getFontSize()
	{
		//gets the font size
		return $this->font_size;
	}

	function setFontSize($font_size)
	{
		//sets the font size
		$this->font_size = $font_size;
	}

	function addFont($font, $size)
	{
		//adds the font and the size
		$this->setFont($font);
		$this->setFontSize($size);
	}

	function getBarcode()
	{
		//gets the image
		$this->drawImage();
		$this->image->drawImage();
	}

	function saveBarcode($filename)
	{
		//saves the image to the given filename
		$this->drawImage();
		$this->image->saveImage($filename);
	}

	function getText()
	{
		//gets the text
		return $this->text['value'];
	}

	function setText($text)
	{
		//sets the barcode text
		$this->text['value'] = $text;
		$this->generateDataForEncoding();
	}

	function calculateImageWidth()
	{
		//calculates the image width based on the (pixel width * encoded text) + border width + border spacing
		return ((strlen($this->encoding['value']) * $this->getPixelWidth()) + (($this->getBorderWidth() + $this->getBorderSpacing()) * 2));
	}

	function drawImage()
	{
		$this->setImageWidth($this->calculateImageWidth());

		//draws the border on the image canvas
		if($this->getBorderWidth() >= 1)
		{
			$this->drawBorder();
		}

		//draws the barcode on the image canvas
		$this->drawBarcode();

		//draws the text on the image canvas
		if($this->getShowText() <> false)
		{
			$this->drawText();
		}
	}

	function drawBorder()
	{
		//draws a border around the image
		$image = &$this->image;
		for($i = 0; $i <= $this->getBorderWidth() - 1; $i++)
		{
			$image->drawRectangle($i, $i, $this->getImageWidth() - 1 - $i, $this->getImageHeight() - 1 - $i, 1, '00000000');
		}
	}

	function drawBarcode()
	{
		//draws the barcode on the image
		$string = $this->encoding['value'];
		$image = &$this->image;
		$white = 'ffffff00';
		$black = '00000000';

		//set the position to start drawing the bars from
		$x = ($this->getBorderWidth() + $this->getBorderSpacing());
		for($i = 0; $i <= strlen($string) - 1; $i++)
		{
			$colour = $white;
			if($string{$i} == 1)
			{
				$colour = $black;
			}
			for($j = 0; $j <= $this->getPixelWidth() - 1; $j++)
			{
				if($this->getShowText())
				{
					//need to work out the dimensions of the font being used if auto or grab them if not auto
					if($this->getEANStyle())
					{
						if(($i >= 0) and ( $i <= 10) or ( $i >= (strlen($string) - 13)) and ( $i <= (strlen($string) - 1)))
						{
							//this is to draw the start and end characters differently if using ean style
							$y1 = ($this->getBorderWidth() + $this->getBorderSpacing());
							$y2 = ($image->getHeight() - ($this->getBorderWidth() + $this->getBorderSpacing())) - ($this->bbox['height'] / 2);
						}
						else
						{
							$y1 = ($this->getBorderWidth() + $this->getBorderSpacing());
							$y2 = ($image->getHeight() - ($this->getBorderWidth() + $this->getBorderSpacing() + $this->getTextSpacing())) - $this->bbox['height'];
						}
					}
					else
					{
						$y1 = ($this->getBorderWidth() + $this->getBorderSpacing());
						$y2 = ($image->getHeight() - ($this->getBorderWidth() + $this->getBorderSpacing() + $this->getTextSpacing()) - ($this->bbox['height']));
					}
				}
				else
				{
					if($this->getEANStyle())
					{
						if(($i >= 0) and ( $i <= 10) or ( $i >= (strlen($string) - 13)) and ( $i <= (strlen($string) - 1)))
						{
							//this is to draw the start and end characters differently if using ean style
							$y1 = ($this->getBorderWidth() + $this->getBorderSpacing());
							$y2 = ($image->getHeight() - ($this->getBorderWidth() + $this->getBorderSpacing()));
						}
						else
						{
							$y1 = ($this->getBorderWidth() + $this->getBorderSpacing());
							$y2 = ($image->getHeight() - ($this->getBorderWidth() + $this->getBorderSpacing())) - (($image->getHeight() - ($this->getBorderWidth() + $this->getBorderSpacing())) * 0.25);
						}
					}
					else
					{
						$y1 = ($this->getBorderWidth() + $this->getBorderSpacing());
						$y2 = ($image->getHeight() - ($this->getBorderWidth() + $this->getBorderSpacing()));
					}
				}
				$image->drawLine($x, $y1, $x, $y2, 1, $colour);
				$x++;
			}
		}
	}

	function drawText()
	{
		//draws the text on the image
		$image = &$this->image;
		$black = '00000000';
		$image->drawText(((($this->getImageWidth() - $this->bbox['width']) / 2) - abs($this->bbox['x'])), $this->getImageHeight() - abs($this->bbox[1]) - $this->getBorderWidth() - $this->getBorderSpacing(), 0, $this->getFont(), $this->getFontSize(), $black, $this->getText());
	}

	function imagettfbboxextended($size, $font, $text)
	{
		$bbox = imagettfbbox($size, 0, $font, $text);
		if($bbox[0] >= -1)
		{
			$bbox['x'] = abs($bbox[0] + 1) * -1;
		}
		else
		{
			$bbox['x'] = abs($bbox[0] + 2);
		}
		$bbox['width'] = abs($bbox[2] - $bbox[0]);
		if($bbox[0] < -1)
		{
			$bbox['width'] = abs($bbox[2]) + abs($bbox[0]) - 1;
		}
		$bbox['y'] = abs($bbox[5] + 1);
		$bbox['height'] = abs($bbox[7]) - abs($bbox[1]);
		if($bbox[3] > 0)
		{
			$bbox['height'] = abs($bbox[7] - $bbox[1]) - 1;
		}
		return $bbox;
	}

	function calculateTextSize($width)
	{
		//loop up from point size 1 until the font exceeds the width and then return the size to use
		$i = 1;
		$continue = true;
		while($continue == true)
		{
			$bbox = $this->imagettfbboxextended($i, $this->getFont(), $this->getText());
			if($bbox['width'] < $width)
			{
				$i++;
			}
			else
			{
				$i--;
				$bbox = $this->imagettfbboxextended($i, $this->getFont(), $this->getText());
				$continue = false;
			}
		}
		$this->bbox = $bbox;
		return $i;
	}

	function setStartSet($set)
	{
		//sets the starting set
		$this->current_set = $set;
		switch($set)
		{
			case 'A':
				$this->addChecksum('103');
				$this->addEncode('103');
				break;
			case 'B':
				$this->addChecksum('104');
				$this->addEncode('104');
				break;
			case 'C':
				$this->addChecksum('105');
				$this->addEncode('105');
				break;
		}
	}

	function changeSet($set)
	{
		//changes the set being used
		$this->current_set = $set;
		switch($this->current_set)
		{
			case 'A':
				$this->addChecksum('101');
				$this->addEncode('101');
				break;
			case 'B':
				$this->addChecksum('100');
				$this->addEncode('100');
				break;
			case 'C':
				$this->addChecksum('99');
				$this->addEncode('99');
				break;
		}
	}

	function generateDataForEncoding()
	{
		//generates the data to be encoded
		$text = &$this->getText();
		$data = &$this->text['data'];
		for($i = 0; $i <= strlen($text) - 1; $i++)
		{
			if($i == (strlen($text) - 1))
			{
				//last character
				$value = $text{$i};
				if($text{$i} == ' ')
				{
					$value = 'CR';
//					$value = 'SP';
				}
				$data[] = $value;
			}
			else
			{
				if((is_numeric($text{$i})) && (is_numeric($text{($i + 1)})))
				{
					//looks for double digit values
					$data[] = $text{$i} . $text{($i + 1)};
					$i++;
				}
				else
				{
					$value = $text{$i};
					if($text{$i} == ' ')
					{
						$value = 'CR';
//						$value = 'SP';
					}
					$data[] = $value;
				}
			}
		}
		//generates the barcode data for each of the characters
		$this->setStartSet($this->getCharacterSet($data[0]));
		for($i = 0; $i <= count($data) - 1; $i++)
		{
			$set = $this->getCharacterSet($data[$i]);
			if($set <> $this->current_set)
			{
				$this->changeSet($set);
			}
			$value = $this->getCharcterValue($set, $data[$i]);
			$this->addChecksum($value);
			$this->addEncode($value);
		}
		$checksum = &$this->checksum['value'];
		$this->addEncode($checksum % 103);
		$this->addEncode(106);
	}

	function getCharcterValue($set, $character)
	{
		//gets the value of the character for the given set
		return $this->set[$set][$character];
	}

	function getCharacterSet($character)
	{
		//gets the set that the given character is contained in.  Checks current set before searching the alternate sets
		$set = &$this->set;
		$current_set = &$this->current_set;
		$sets = array(
			'A',
			'B',
			'C');
		if($current_set <> '')
		{
			if(array_key_exists($character, $set[$current_set]))
			{
				return $current_set;
			}
			$index = array_search($current_set, $sets);
			unset($sets[$index]);
			sort($sets);
		}
		for($i = 0; $i <= count($sets) - 1; $i++)
		{
			if(array_key_exists($character, $set[$sets[$i]]))
			{
				return $sets[$i];
			}
		}
	}

	function addEncode($value)
	{
		//add the encoded value
		$encoding = &$this->encoding;
		$encoding['data'][] = $value;
		$encoding['value'] .= $this->getValue($value);
		$encoding['strings'][] = $this->getValue($value);
	}

	function addChecksum($value)
	{
		//adds the checksum
		$checksum = &$this->checksum;
		if(count($checksum['data']) == 0)
		{
			$checksum['data'][] = $value;
		}
		else
		{
			$checksum['data'][] = ($value * (count($checksum['data'])));
		}
		$checksum['value'] = array_sum($checksum['data']);
	}

	function getValue($value)
	{
		//gets the value string for a given value
		return $this->value[$value];
	}

	function setDefaults()
	{
		//sets the default sets and values
		$set = &$this->set;
		$value = &$this->value;

		$set['A']['SP'] = '0';
		$set['A']['!'] = '1';
		$set['A']['"'] = '2';
		$set['A']['#'] = '3';
		$set['A']['$'] = '4';
		$set['A']['%'] = '5';
		$set['A']['&'] = '6';
		$set['A']["'"] = '7';
		$set['A']['('] = '8';
		$set['A'][')'] = '9';
		$set['A']['*'] = '10';
		$set['A']['+'] = '11';
		$set['A'][','] = '12';
		$set['A']['-'] = '13';
		$set['A']['.'] = '14';
		$set['A']['/'] = '15';
		$set['A']['0'] = '16';
		$set['A']['1'] = '17';
		$set['A']['2'] = '18';
		$set['A']['3'] = '19';
		$set['A']['4'] = '20';
		$set['A']['5'] = '21';
		$set['A']['6'] = '22';
		$set['A']['7'] = '23';
		$set['A']['8'] = '24';
		$set['A']['9'] = '25';
		$set['A'][':'] = '26';
		$set['A'][';'] = '27';
		$set['A']['<'] = '28';
		$set['A']['='] = '29';
		$set['A']['>'] = '30';
		$set['A']['?'] = '31';
		$set['A']['@'] = '32';
		$set['A']['A'] = '33';
		$set['A']['B'] = '34';
		$set['A']['C'] = '35';
		$set['A']['D'] = '36';
		$set['A']['E'] = '37';
		$set['A']['F'] = '38';
		$set['A']['G'] = '39';
		$set['A']['H'] = '40';
		$set['A']['I'] = '41';
		$set['A']['J'] = '42';
		$set['A']['K'] = '43';
		$set['A']['L'] = '44';
		$set['A']['M'] = '45';
		$set['A']['N'] = '46';
		$set['A']['O'] = '47';
		$set['A']['P'] = '48';
		$set['A']['Q'] = '49';
		$set['A']['R'] = '50';
		$set['A']['S'] = '51';
		$set['A']['T'] = '52';
		$set['A']['U'] = '53';
		$set['A']['V'] = '54';
		$set['A']['W'] = '55';
		$set['A']['X'] = '56';
		$set['A']['Y'] = '57';
		$set['A']['Z'] = '58';
		$set['A']['['] = '59';
		$set['A']["\\"] = '60';
		$set['A'][']'] = '61';
		$set['A']['^'] = '62';
		$set['A']['_'] = '63';
		$set['A']['NUL'] = '64';
		$set['A']['SOH'] = '65';
		$set['A']['STX'] = '66';
		$set['A']['ETX'] = '67';
		$set['A']['EOT'] = '68';
		$set['A']['ENQ'] = '69';
		$set['A']['ACK'] = '70';
		$set['A']['BEL'] = '71';
		$set['A']['BS'] = '72';
		$set['A']['HT'] = '73';
		$set['A']['LF'] = '74';
		$set['A']['VT'] = '75';
		$set['A']['FF'] = '76';
		$set['A']['CR'] = '77';
		$set['A']['SO'] = '78';
		$set['A']['SI'] = '79';
		$set['A']['DLE'] = '80';
		$set['A']['DC1'] = '81';
		$set['A']['DC2'] = '82';
		$set['A']['DC3'] = '83';
		$set['A']['DC4'] = '84';
		$set['A']['NAK'] = '85';
		$set['A']['SYN'] = '86';
		$set['A']['ETB'] = '87';
		$set['A']['CAN'] = '88';
		$set['A']['EM'] = '89';
		$set['A']['SUB'] = '90';
		$set['A']['ESC'] = '91';
		$set['A']['FS'] = '92';
		$set['A']['GS'] = '93';
		$set['A']['RS'] = '94';
		$set['A']['US'] = '95';
		$set['A']['FNC3'] = '96';
		$set['A']['FNC2'] = '97';
		$set['A']['SHIFT'] = '98';
		$set['A']['CodeC'] = '99';
		$set['A']['CodeB'] = '100';
		$set['A']['FNC4'] = '101';
		$set['A']['FNC1'] = '102';
		$set['A']['STARTA'] = '103';
		$set['A']['STARTB'] = '104';
		$set['A']['STARTC'] = '105';
		$set['A']['STOP'] = '106';

		$set['B']['SP'] = '0';
		$set['B']['!'] = '1';
		$set['B']['"'] = '2';
		$set['B']['#'] = '3';
		$set['B']['$'] = '4';
		$set['B']['%'] = '5';
		$set['B']['&'] = '6';
		$set['B']["'"] = '7';
		$set['B']['('] = '8';
		$set['B'][')'] = '9';
		$set['B']['*'] = '10';
		$set['B']['+'] = '11';
		$set['B'][','] = '12';
		$set['B']['-'] = '13';
		$set['B']['.'] = '14';
		$set['B']['/'] = '15';
		$set['B']['0'] = '16';
		$set['B']['1'] = '17';
		$set['B']['2'] = '18';
		$set['B']['3'] = '19';
		$set['B']['4'] = '20';
		$set['B']['5'] = '21';
		$set['B']['6'] = '22';
		$set['B']['7'] = '23';
		$set['B']['8'] = '24';
		$set['B']['9'] = '25';
		$set['B'][':'] = '26';
		$set['B'][';'] = '27';
		$set['B']['<'] = '28';
		$set['B']['='] = '29';
		$set['B']['>'] = '30';
		$set['B']['?'] = '31';
		$set['B']['@'] = '32';
		$set['B']['A'] = '33';
		$set['B']['B'] = '34';
		$set['B']['C'] = '35';
		$set['B']['D'] = '36';
		$set['B']['E'] = '37';
		$set['B']['F'] = '38';
		$set['B']['G'] = '39';
		$set['B']['H'] = '40';
		$set['B']['I'] = '41';
		$set['B']['J'] = '42';
		$set['B']['K'] = '43';
		$set['B']['L'] = '44';
		$set['B']['M'] = '45';
		$set['B']['N'] = '46';
		$set['B']['O'] = '47';
		$set['B']['P'] = '48';
		$set['B']['Q'] = '49';
		$set['B']['R'] = '50';
		$set['B']['S'] = '51';
		$set['B']['T'] = '52';
		$set['B']['U'] = '53';
		$set['B']['V'] = '54';
		$set['B']['W'] = '55';
		$set['B']['X'] = '56';
		$set['B']['Y'] = '57';
		$set['B']['Z'] = '58';
		$set['B']['['] = '59';
		$set['B']["\\"] = '60';
		$set['B'][']'] = '61';
		$set['B']['^'] = '62';
		$set['B']['_'] = '63';
		$set['B']['`'] = '64';
		$set['B']['a'] = '65';
		$set['B']['b'] = '66';
		$set['B']['c'] = '67';
		$set['B']['d'] = '68';
		$set['B']['e'] = '69';
		$set['B']['f'] = '70';
		$set['B']['g'] = '71';
		$set['B']['h'] = '72';
		$set['B']['i'] = '73';
		$set['B']['j'] = '74';
		$set['B']['k'] = '75';
		$set['B']['l'] = '76';
		$set['B']['m'] = '77';
		$set['B']['n'] = '78';
		$set['B']['o'] = '79';
		$set['B']['p'] = '80';
		$set['B']['q'] = '81';
		$set['B']['r'] = '82';
		$set['B']['s'] = '83';
		$set['B']['t'] = '84';
		$set['B']['u'] = '85';
		$set['B']['v'] = '86';
		$set['B']['w'] = '87';
		$set['B']['x'] = '88';
		$set['B']['y'] = '89';
		$set['B']['z'] = '90';
		$set['B']['{'] = '91';
		$set['B']['|'] = '92';
		$set['B']['}'] = '93';
		$set['B']['~'] = '94';
		$set['B']['DEL'] = '95';
		$set['B']['FNC3'] = '96';
		$set['B']['FNC2'] = '97';
		$set['B']['SHIFT'] = '98';
		$set['B']['CodeC'] = '99';
		$set['B']['FNC4'] = '100';
		$set['B']['CodeA'] = '101';
		$set['B']['FNC1'] = '102';
		$set['B']['STARTA'] = '103';
		$set['B']['STARTB'] = '104';
		$set['B']['STARTC'] = '105';
		$set['B']['STOP'] = '106';

		$set['C']['00'] = '0';
		$set['C']['01'] = '1';
		$set['C']['02'] = '2';
		$set['C']['03'] = '3';
		$set['C']['04'] = '4';
		$set['C']['05'] = '5';
		$set['C']['06'] = '6';
		$set['C']['07'] = '7';
		$set['C']['08'] = '8';
		$set['C']['09'] = '9';
		$set['C']['10'] = '10';
		$set['C']['11'] = '11';
		$set['C']['12'] = '12';
		$set['C']['13'] = '13';
		$set['C']['14'] = '14';
		$set['C']['15'] = '15';
		$set['C']['16'] = '16';
		$set['C']['17'] = '17';
		$set['C']['18'] = '18';
		$set['C']['19'] = '19';
		$set['C']['20'] = '20';
		$set['C']['21'] = '21';
		$set['C']['22'] = '22';
		$set['C']['23'] = '23';
		$set['C']['24'] = '24';
		$set['C']['25'] = '25';
		$set['C']['26'] = '26';
		$set['C']['27'] = '27';
		$set['C']['28'] = '28';
		$set['C']['29'] = '29';
		$set['C']['30'] = '30';
		$set['C']['31'] = '31';
		$set['C']['32'] = '32';
		$set['C']['33'] = '33';
		$set['C']['34'] = '34';
		$set['C']['35'] = '35';
		$set['C']['36'] = '36';
		$set['C']['37'] = '37';
		$set['C']['38'] = '38';
		$set['C']['39'] = '39';
		$set['C']['40'] = '40';
		$set['C']['41'] = '41';
		$set['C']['42'] = '42';
		$set['C']['43'] = '43';
		$set['C']['44'] = '44';
		$set['C']['45'] = '45';
		$set['C']['46'] = '46';
		$set['C']['47'] = '47';
		$set['C']['48'] = '48';
		$set['C']['49'] = '49';
		$set['C']['50'] = '50';
		$set['C']['51'] = '51';
		$set['C']['52'] = '52';
		$set['C']['53'] = '53';
		$set['C']['54'] = '54';
		$set['C']['55'] = '55';
		$set['C']['56'] = '56';
		$set['C']['57'] = '57';
		$set['C']['58'] = '58';
		$set['C']['59'] = '59';
		$set['C']['60'] = '60';
		$set['C']['61'] = '61';
		$set['C']['62'] = '62';
		$set['C']['63'] = '63';
		$set['C']['64'] = '64';
		$set['C']['65'] = '65';
		$set['C']['66'] = '66';
		$set['C']['67'] = '67';
		$set['C']['68'] = '68';
		$set['C']['69'] = '69';
		$set['C']['70'] = '70';
		$set['C']['71'] = '71';
		$set['C']['72'] = '72';
		$set['C']['73'] = '73';
		$set['C']['74'] = '74';
		$set['C']['75'] = '75';
		$set['C']['76'] = '76';
		$set['C']['77'] = '77';
		$set['C']['78'] = '78';
		$set['C']['79'] = '79';
		$set['C']['80'] = '80';
		$set['C']['81'] = '81';
		$set['C']['82'] = '82';
		$set['C']['83'] = '83';
		$set['C']['84'] = '84';
		$set['C']['85'] = '85';
		$set['C']['86'] = '86';
		$set['C']['87'] = '87';
		$set['C']['88'] = '88';
		$set['C']['89'] = '89';
		$set['C']['90'] = '90';
		$set['C']['91'] = '91';
		$set['C']['92'] = '92';
		$set['C']['93'] = '93';
		$set['C']['94'] = '94';
		$set['C']['95'] = '95';
		$set['C']['96'] = '96';
		$set['C']['97'] = '97';
		$set['C']['98'] = '98';
		$set['C']['99'] = '99';
		$set['C']['CodeB'] = '100';
		$set['C']['CodeA'] = '101';
		$set['C']['FNC1'] = '102';
		$set['C']['STARTA'] = '103';
		$set['C']['STARTB'] = '104';
		$set['C']['STARTC'] = '105';
		$set['C']['STOP'] = '106';

		$value['0'] = '11011001100';
		$value['1'] = '11001101100';
		$value['2'] = '11001100110';
		$value['3'] = '10010011000';
		$value['4'] = '10010001100';
		$value['5'] = '10001001100';
		$value['6'] = '10011001000';
		$value['7'] = '10011000100';
		$value['8'] = '10001100100';
		$value['9'] = '11001001000';
		$value['10'] = '11001000100';
		$value['11'] = '11000100100';
		$value['12'] = '10110011100';
		$value['13'] = '10011011100';
		$value['14'] = '10011001110';
		$value['15'] = '10111001100';
		$value['16'] = '10011101100';
		$value['17'] = '10011100110';
		$value['18'] = '11001110010';
		$value['19'] = '11001011100';
		$value['20'] = '11001001110';
		$value['21'] = '11011100100';
		$value['22'] = '11001110100';
		$value['23'] = '11101101110';
		$value['24'] = '11101001100';
		$value['25'] = '11100101100';
		$value['26'] = '11100100110';
		$value['27'] = '11101100100';
		$value['28'] = '11100110100';
		$value['29'] = '11100110010';
		$value['30'] = '11011011000';
		$value['31'] = '11011000110';
		$value['32'] = '11000110110';
		$value['33'] = '10100011000';
		$value['34'] = '10001011000';
		$value['35'] = '10001000110';
		$value['36'] = '10110001000';
		$value['37'] = '10001101000';
		$value['38'] = '10001100010';
		$value['39'] = '11010001000';
		$value['40'] = '11000101000';
		$value['41'] = '11000100010';
		$value['42'] = '10110111000';
		$value['43'] = '10110001110';
		$value['44'] = '10001101110';
		$value['45'] = '10111011000';
		$value['46'] = '10111000110';
		$value['47'] = '10001110110';
		$value['48'] = '11101110110';
		$value['49'] = '11010001110';
		$value['50'] = '11000101110';
		$value['51'] = '11011101000';
		$value['52'] = '11011100010';
		$value['53'] = '11011101110';
		$value['54'] = '11101011000';
		$value['55'] = '11101000110';
		$value['56'] = '11100010110';
		$value['57'] = '11101101000';
		$value['58'] = '11101100010';
		$value['59'] = '11100011010';
		$value['60'] = '11101111010';
		$value['61'] = '11001000010';
		$value['62'] = '11110001010';
		$value['63'] = '10100110000';
		$value['64'] = '10100001100';
		$value['65'] = '10010110000';
		$value['66'] = '10010000110';
		$value['67'] = '10000101100';
		$value['68'] = '10000100110';
		$value['69'] = '10110010000';
		$value['70'] = '10110000100';
		$value['71'] = '10011010000';
		$value['72'] = '10011000010';
		$value['73'] = '10000110100';
		$value['74'] = '10000110010';
		$value['75'] = '11000010010';
		$value['76'] = '11001010000';
		$value['77'] = '11110111010';
		$value['78'] = '11000010100';
		$value['79'] = '10001111010';
		$value['80'] = '10100111100';
		$value['81'] = '10010111100';
		$value['82'] = '10010011110';
		$value['83'] = '10111100100';
		$value['84'] = '10011110100';
		$value['85'] = '10011110010';
		$value['86'] = '11110100100';
		$value['87'] = '11110010100';
		$value['88'] = '11110010010';
		$value['89'] = '11011011110';
		$value['90'] = '11011110110';
		$value['91'] = '11110110110';
		$value['92'] = '10101111000';
		$value['93'] = '10100011110';
		$value['94'] = '10001011110';
		$value['95'] = '10111101000';
		$value['96'] = '10111100010';
		$value['97'] = '11110101000';
		$value['98'] = '11110100010';
		$value['99'] = '10111011110';
		$value['100'] = '10111101110';
		$value['101'] = '11101011110';
		$value['102'] = '11110101110';
		$value['103'] = '11010000100';
		$value['104'] = '11010010000';
		$value['105'] = '11010011100';
		$value['106'] = '1100011101011';
	}

}

?>