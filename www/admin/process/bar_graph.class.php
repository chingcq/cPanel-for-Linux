<?php
/**
 * Creates bar graph, with infinite amount of bars
 * each bar will have random color
 * to use class, function Draw needs set of values.
 * has to be two dimansional array, array[][0] - has to contain value
 * array[][1] has to conain text for value
 * eg on how to use it we have array called $value
 *  $values=array(
 *			array(15, "Monday"),
 *			array(10, "Tuesday"),
 *			array(50, "Wednesday")
 *			);
 *	$bar = new bar_graph();
 *   $bar->Draw($values);
 * That code will create image with values in array
 * values will be transformed in the correct format to be used.
 */	
Class bar_graph
{
	/**
	 * List of vars
	 * To use them vars in function i will need to use $this->var
	 */
	private $data = array();
	private $proc = array();
	private $color = array();
	private $temp = array();

	public function Draw($values)
	{
		/**
		 * - Giving private $temp set of values
		 * - Then counting how many values $temp has
		 * - $len will be used as length of the graph. $num will be used to set graph's height. 
		 *		60 is margin and 24 is size for bars.
		 * - $box is a frame for image in which will have that graph.
		 * - Creating image with values $wid and $len+$box. $len is kept separeted from box because 
		 *		will be used later on for other transformation.
		 * - $bg stores color of the background.
		 * - $black stores a black color.
		 */ 
		$this->temp = $values;
        $num = count($this->temp);
		$len = $num*24+60+$num;
		$box = $num*20+$num;
		$wid = 300;
		$im = imagecreate($wid, $len+$box);
		$bg = imagecolorallocate($im, 255, 255, 255);
		$black = imagecolorallocate($im, 0, 0, 0);
		/**
		 * drawing axis
		 * format for imageline is ($im, $x1, $y1, $x2, $y2, $color), x and y are coords
		 * - 1st - y
		 * - 2nd - x 
		 * - next two lines draw arrow on Y axis 
		 * - next two lines draw arrow on X axis
		 */
		imageline($im, 20, $len-20, 20, 20, $black);
		imageline($im, 20, $len-20, 280, $len-20, $black);
        imageline($im, 20, 20, 15, 25, $black);
        imageline($im, 20, 20, 25, 25, $black);
        imageline($im, 280, $len-20, 275, $len-25, $black);
        imageline($im, 280, $len-20, 275, $len-15, $black);
        /**
         * Draw scale on X axis
		 * format for imageline is ($im, $x1, $y1, $x2, $y2, $color), x and y are coord 
		 * format for imagestring is ($im, $styleoffont, $x1, $y1, $text, $color)
		 * - we create a line on X axis
		 * - create a string with value 0 next to the line which we created
		 * - generate all other strings with values with for(){ }
		 * - imageline creates next line, 41 and 24 are base values, they will be times by $i
		 *		to set correct x1 and x2 value
		 * - imagestring craetes a value next to the line which was created. 38 and 24 are base values
		 *		for x1 and 10 is base value for text which will be outputed
         */
       imageline($im, 20, $len-20, 20, $len-17, $black);
       imagestring($im, 2, 18, $len-15, 0, $black);
        for($i = 0; $i<10; $i++)
        {
        	imageline($im, 41+24*$i, $len-20, 41+24*$i, $len-17, $black);
        	imagestring($im, 2, 38+24*$i, $len-15, 10+10*$i . "%", $black);
        }
        /**
         * Drawing bars
		 * - For() used to move data values from $temp which is two dimansional array to $data which
		 *		single dimesional array. For() will work untill it reaches value of values - 1 
         */
        for($i = 0; $i < $num; $i++)
        {
        	$this->data[$i] = $this->temp[$i][0];
        }
		/**
		 * - Sum up all values in array $data, $realdiv will be used as 100%
		 * - For() to create all the bars with values next to them untill $i = total num of bars - 1
		 */
        $realdiv = array_sum($this->data);
        for($i = 0; $i < $num; $i++)
        {
			/**
			 * - filling array $proc with rounded procentages which will be used to set the width 
			 *		of bars and the procentages for bars
			 * - filling array $color with colors for given bar.
			 *		imagecolorallocate has $im - where it will be used. 
			 *		next three values set the color, 
			 *		rand(1, 255) gets a random value between 1 and 255
			 * - creating colored rectange, imagefilledrectangle($im, $x1, $y1, $x2, $y2, $color)
			 *		$color is takes from array $color which was declared before,
			 * - imagestring created a value which that bar has next to it.
			 *		imagestring($im, $font, $x, $y, $text, $color)
			 *		$text is taken from array $data wich was declared before
			 */
        	$this->proc[$i] = round(($this->data[$i]/$realdiv)*100);;
        	$this->color[$i] = imagecolorallocate($im, rand(1, 255), rand(1, 255),
								rand(1, 255));
			imagefilledrectangle($im, 21, 41+25*$i, 20+(($wid-60)/100)*$this->proc[$i],
								61+25*$i, $this->color[$i]);
			imagestring($im, 2, 25+(($wid-60)/100)*$this->proc[$i], 44+25*$i, $this->data[$i], $black);
			/**
			 * now im creating text box with values under the graph
			 * - imagefilledrectangle creating rectangle. 
			 * - imageline ($im, $x1, $y1, $x2, $y2, $color), creates a line starting from
			 *		bottom right conner of imagefilledrectangle
			 * - imagestring ($im, $font, $x, $y, $text, $color)
			 *		creates a text next to imagefilledrectangle above imageline
			 */
			imagefilledrectangle($im, 20, $len+10+($i*20), 30, $len+20+($i*20),
									$this->color[$i]);
			imageline($im, 20, $len+20+($i*20), 200, $len+20+($i*20), $this->color[$i]);
			imagestring($im, 1, 35, $len+10+($i*20), $this->proc[$i] . "% - " .
						$this->data[$i] . " from " . $this->temp[$i][1] , $black);
        }
		/**
		 * - now im creating final image
		 * - and destroying it from memory
		 */
		imagepng($im, "temp/bar-graph.png");
		imagedestroy($im);
	}
}