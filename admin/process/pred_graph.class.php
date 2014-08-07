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
 *	$pred = new pred_graph();
 *   $pred->Draw($values);
 * That code will create image with values in array
 * values will be transformed in the correct format to be used.
 * as well next seven bars will be "predicted"
 */	
Class pred_graph
{
	private $data = array();
	private $pred = array();
	private $realpred = array();
	private $color = array();
	private $temp = array();

	public function Draw($values)
	{
		/**
		 * - saving $values to $this->temp
		 * - $num contains number of cells in array
		 * - $len sets the height of graph
		 * - $box sets the height of box under the graph
		 * - $wid is width of the whole picture
		 * - $im is creating image with given dimensions
		 * - $bg is setting background color for given image
		 * - $black is color, black color
		 */
		$this->temp = $values;
        $num = count($this->temp);
		$len = ($num+7)*25+60+$num;
		$box = ($num+7)*20+($num+7);
		$wid = 300;
		$im = imagecreate($wid, $len+$box);
		$bg = imagecolorallocate($im, 255, 255, 255);
		$black = imagecolorallocate($im, 0, 0, 0);


		/**
		 * drawing axis
		 * 1st - y
		 * 2nd - x
		 * next two lines draw arrow on Y axis
		 * next two lines draw arrow on X axis
		 */
		imageline($im, 20, $len-20, 20, 20, $black);
		imageline($im, 20, $len-20, 280, $len-20, $black);
        imageline($im, 20, 20, 15, 25, $black);
        imageline($im, 20, 20, 25, 25, $black);
        imageline($im, 280, $len-20, 275, $len-25, $black);
        imageline($im, 280, $len-20, 275, $len-15, $black);
        /**
         * Draw scale on X axis
         */
        imageline($im, 20, $len-20, 20, $len-17, $black);
        ImageString($im, 2, 18, $len-15, 0, $black);
        for($i = 0; $i<10; $i++)
        {
        	imageline($im, 41+24*$i, $len-20, 41+24*$i, $len-17, $black);
        	ImageString($im, 2, 38+24*$i, $len-15, 10+10*$i . "%", $black);
        }
        /**
         * Setting colors for bars
		 * - $this-color[] will contain color for each bar
		 *		imagecolorallocate($im, $red, $green, $blue)
		 *	colors will be random from 1 to 255
         */
        
        for($i = 0; $i < ($num+7); $i++)
        {
	       	$this->color[$i] = ImageColorAllocate($im, rand(1, 255), rand(1, 255),
								rand(1, 255));
		}
        /**
		 * creating new array with data
		 * - $this->data will contain all values from $this->temp
		 * - $realdiv sums up all values in array $this->data.
		 * - next for() sums up number of Y's to be used in formula 
		 */
		for($i = 0; $i < $num; $i++)
        {
        	$this->data[$i] = $this->temp[$i][0];
        }
		$realdiv = array_sum($this->data);
		for($i = 1; $i < ($num+1); $i++){
		 	@$y = $y+$i;
		} 
		/**
		 *	next thing untill $div = max $this->data does next
		 *		b = Sxy/Sxx
		 *		y = bx - a <- x or y are unknown
		 *		a = Y' - X'
		 */	 
		$x_dash = $realdiv/($num+7);
		$y_dash = $y/($num+7);
		$b = ($realdiv - $x_dash)*($y - $y_dash)/(($realdiv - $x_dash)*($realdiv - $x_dash));
		$bdash_x = $b*$x_dash;
		$bx = $b*$realdiv;
		$a = $y_dash-$bdash_x; 
		/**
		 * Adding next data to array $this->data[]
		 */
		for($i= $num; $i < ($num+7); $i++)
		{
			$this->data[$i] = round(($i-$a)/$b);
		}
		/**
		 * Finding max value of $this->data to use to find out procentages
		 * $realdiv will provide slightly different procentage
		 * $pred_value used to display prediction number
		 */
		$div = max($this->data);
		$realdiv = array_sum($this->data);
		$pred_value = 1;
		for($i = 0; $i<($num+7); $i++)
		{
			/**
			 * We create two arrays with different sets of procentages 
			 * $this->pred and $this->realpred.
			 * - first image filledrectangle will create bar
			 *		imagefilledrectangle ($im, $x1, $y1, $x2, $y2, $color)
			 * - first imagestring will write value next to the bar which we just created
			 *		imagestring($im, $font, $x, $y, $string, $color)
			 * - second imagefilledrectangle will create small rectangle in the information box
			 * - imageline will create a line on the right bottom of the rectange which we 
			 * 		just created
			 *		imageline($im, $x1, $y1, $x2, $y2, $color)
			 */
			$this->pred[$i] = round(($this->data[$i]/$realdiv)*100);
			$this->realpred[$i] = round(($this->data[$i]/$div)*100);
   			imagefilledrectangle($im, 21, 41+25*$i, 20+(($wid-60)/100)*$this->realpred[$i],
					61+25*$i, $this->color[$i]);
			imagestring($im, 2, 25+(($wid-60)/100)*$this->realpred[$i],
						44+25*$i, $this->data[$i], $black);

			imagefilledrectangle($im, 20, $len+10+($i*20), 30, $len+20+($i*20),
						$this->color[$i]);
			imageline($im, 20, $len+20+($i*20), 200, $len+20+($i*20), $this->color[$i]);
		}
		/** 
		 * next for() will create text in the information box next to rectangle which we
		 * created above
		 * imagestring($im, $font, $x, $y, $string, $color)
		 */
		for($i= 0; $i < $num; $i++)
		{
			ImageString($im, 1, 35, $len+10+($i*20), $this->pred[$i] . "% - " .
						$this->data[$i] . " from " . $this->temp[$i][1] , $black);
		}
		for($i= $num; $i < ($num+7); $i++)
		{			
			ImageString($im, 1, 35, $len+10+($i*20), $this->pred[$i] . "% - " . $this->data[$i] . " Prediction " . $pred_value, $black);
			$pred_value++;	
		}
		/**
		 * Save image
		 * Destroy image from memory
		 */
		ImagePNG($im, "temp/pred-bar-graph.png");
		ImageDestroy($im);
	}
}