<?php
/**
 * Creates pie char, with infinite amount of chords
 * each chord will have random color
 * to use class, function Draw needs set of values.
 * has to be two dimansional array, array[][0] - has to contain value
 * array[][1] has to conain text for value
 * eg on how to use it we have array called $value
 *  $values=array(
 *			array(15, "Monday"),
 *			array(10, "Tuesday"),
 *			array(50, "Wednesday")
 *			);
 *	$pie_chart= new pie_chart();
 *   $pie_chart->Draw($values);
 * That code will create image with values in array
 * values will be transformed in the correct format to be used.
 */	
Class pie_chart
{
	/**
	 * list of vars
	 */
	private $data = array();
	private $proc = array();
	private $color = array();
	private $temp = array();

	public function Draw($value)
	{
		/**
		 * - Setting $this->temp as $value, $value is two dimansional array $value[][0] - has value, $value[][1] - has text
		 * - var $num counts values in $this->temp
		 * - $len is height
		 * - box sets height for bottom text box
		 * - $diagr_width stores width of pie chart
		 * - $im creates image with width of 300 and width of 150 + height of box
		 * - then $bg stores white color for background
		 * - $cy and $cx are setting centre of diagram
		 * - $black - contains black colour
		 */
		$this->temp = $value;
		$len = 300;
		$width = 150;
		$num = count($this->temp);
		$box = $num*20+$num;
		$diagr_width = 30;
		$im = ImageCreate(300, 150+$box);
		$bg = ImageColorAllocate($im, 255, 255, 255);
		$cx = $len/2;
		$cy = $width/2;
		$black = ImageColorAllocate ($im, 0, 0, 0);
		/**
		 * Creating new array with value data
		 * $div is a sum of new array, sum of all values in the $this0>data array
		 */
		for($i=0; $i<$num; $i++)
		{
		 $this->data[$i] = $this->temp[$i][0];
		}
		$div = array_sum($this->data);
		/**
		 * Setting colour and creating box with information data on pie chart
		 * - $this->color is setting colours for each value
		 * - $this->proc contains procentage for given value
		 * - imagefilledrectangle, creating rectangle in information box,
		 *		imagefilledrectangle($im, $x1, $y1, $x2, $y2, $color)
		 * - imageline, creating line next to the bottom right of rectangle which was created above.
		 *		imageline($im, $x1, $y1, $x2, $y2, $color)
		 * - imagestring, displays text with correct data for rectangle with given color
		 *		imagestring($im, $font, $x1, $y1, $string, $color)
		 */
		for($i=0; $i<$num; $i++)
		{
			$this->color[$i] = ImageColorAllocate($im, rand(1, 255), rand(1, 255),
								rand(1, 255));
			$this->proc[$i] = round(($this->data[$i]/$div)*100);
			imagefilledrectangle($im, 10, 160+($i*20), 20, 170+($i*20), $this->color[$i]);
			imageline($im, 20, 170+($i*20), 200, 170+($i*20), $this->color[$i]);
			ImageString($im, 1, 25, 160+($i*20), $this->proc[$i] . "% - " . $this->data[$i] . " from " . $this->temp[$i][1] , $black);
		}
		/**
		 * Creating pie chart.
		 * imagefilledarc($im, $cx, $cy, $width, $height, $start, $end, $color, $style)
		 */
		for($j = ($cy + $diagr_width); $j > $cy; $j--)
		{
				$angle = 0;
				for($i = 0; $i < $num; $i++)
				{
					ImageFilledArc($im, $cx, $j, $len, $width/2, $angle,
									$angle + $this->proc[$i]*3.6, $this->color[$i], IMG_ARC_PIE);
					$angle = $angle + $this->proc[$i]*3.6;
				}
		}
		/**
		 * Creating image and then destroying it from memory
		 */
		ImagePNG($im, "temp/verify.png");
		ImageDestroy($im);
	}
}
?>