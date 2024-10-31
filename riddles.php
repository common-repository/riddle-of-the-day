<?php
/*
Plugin Name: Riddle Of The Day
Plugin URI: 
Description: Displays one out of 25 random riddles in your sidebar, to get answer click the answer button. Credit for all riddles and answers belong to <a href="http://dan.hersam.com/riddles.html">dan.hersham.com</a>.  
Version: 1.0
Author: Daniel Landram
Author URI: 
License: GPL2


Copyright 2012  Daniel_Landram  (email : landradr@plu.edu)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as 
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.
You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


add_action( 'widgets_init', create_function( '', 'register_widget( "Riddle_Of_The_Day" );' ) );

class Riddle_Of_The_Day extends WP_Widget {
	
	//processes the widget
	function riddle_of_the_day() {
		$widget_ops = array(
			'classname' => 'riddles_class',
			'description' => 'Display a riddle and answer of the day.' );
		$this->WP_Widget( 'Riddle_Of_The_Day', 'Riddles',
			$widget_ops );
	}
	
	//displays widget form in the admin dashboard
	function form($instance) {
		$defaults = array('title' => 'Riddle of the Day',
						  'credit_title' => 'no');
		$instance = wp_parse_args( (array)$instance, $defaults );
		
		?>
		<p>Title: <input class="widefat" name="<?php echo $this->get_field_name( 'title' );?>" type="text"
			value="<?php echo esc_attr( $instance['title'] ); ?>" /></p>
		<p> <select name="<?php echo $this->get_field_name( 'credit_title' ); ?>">
		<?php
			$options = array('yes' => 'yes',
							 'no' => 'no');
							 
			foreach( $options as $value => $caption)
			{
				echo "<option value= \"$value\"".selected($value, $instance['credit_title'], true)."> $caption </option>";
			}
		?>
		</select>
		<?php
	}//end of function form
	
	function widget($args, $instance) {
		extract($args);
		
		echo $before_widget;
		
		
		$title = $instance['title'];
		
		if(!isset($title))
			$title = 'Riddle of the Day';
		
		echo '<b>'.$before_title . $title . $after_title.'</b></br>';
		
		$list_of_riddles = array( 
			"1.It is greater than God and more evil than the devil. The poor have it, the rich need it and if you eat it you'll die. What is it?",
			"2.It walks on four legs in the morning, two legs at noon and three legs in the evening. What is it?",
			"3.I am the beginning of the end, and the end of time and space. I am essential to creation, and I surround every place. What am I?",
			"4.What always runs but never walks, often murmurs, never talks, has a bed but never sleeps, has a mouth but never eats?",
			"5.I never was, am always to be. No one ever saw me, nor ever will. And yet I am the confidence of all, To live and breath on this terrestrial ball. What am I?",
			"6.At night they come without being fetched. By day they are lost without being stolen. What are they?",
			"7.There was a green house. Inside the green house there was a white house. Inside the white house there was a red house. Inside the red house there were lots of babies. What is it?",
			"8.What is in seasons, seconds, centuries and minutes but not in decades, years or days?",
			"9.Think of words ending in -GRY. Angry and hungry are two of them. There are only three words in the English language. What is the third word? The word is something that everyone uses every day. If you have listened carefully, I have already told you what it is.",
			"10.The person who makes it, sells it. The person who buys it never uses it and the person who uses it doesn't know they are. What is it?",
			"11.The more you have of it, the less you see. What is it?",
			"12.What has a head, a tail, is brown, and has no legs?",
			"13.What English word has three consecutive double letters?",
			"14.What's black when you get it, red when you use it, and white when you're all through with it?",
			"15.You throw away the outside and cook the inside. Then you eat the outside and throw away the inside. What did you eat?",
			"16.I am always hungry,
				I must always be fed,
				The finger I touch,
				Will soon turn red",
			"17.Ripped from my mother's womb,
				Beaten and burned,
				I become a blood thirsty killer.
				What am I?",
			"18.I know a word of letters three. Add two, and fewer there will be",
			"19.I give you a group of three. One is sitting down, and will never get up. The second eats as much as is given to him, yet is always hungry. The third goes away and never returns.",
			"20.I have four legs but no tail. Usually I am heard only at night. What am I?",
			"21.Half-way up the hill, I see thee at last, lying beneath me with thy sounds and sights -- A city in the twilight, dim and vast, with smoking roofs, soft bells, and gleaming lights.",
			"22.When young, I am sweet in the sun.
				When middle-aged, I make you gay.
				When old, I am valued more than ever.",
			"23.All about, but cannot be seen,
				Can be captured, cannot be held,
				No throat, but can be heard.",
			"24.If you break me
				I do not stop working,
				If you touch me
				I may be snared,
				If you lose me
				Nothing will matter.",
			"25.Until I am measured
				I am not known,
				Yet how you miss me
				When I have flown."
			);
			
		$random_riddle = rand(0, count($list_of_riddles) -1);
		//selects a random riddle
		echo $list_of_riddles[$random_riddle].'</br>';
					
		$answers = array(
			"1.Nothing. Nothing is greater than God, nothing is more evil than the devil, the poor have nothing, the rich need nothing and if you eat nothing you will die",
			"2.Man or woman. Crawls on all fours as a baby, walks on two legs as an adult and uses two legs and a cane when old.",
			"3.The letter e. End, timE, spacE, Every placE",
			"4.A river.",
			"5.Tomorrow or the future.",
			"6.The stars.",
			"7.A watermelon.",
			"8.The letter n",
			"9.It states, There are only three words in the English language. What is the third word? The third word of that phrase is of course language.",
			"10.A coffin",
			"11.Darkness",
			"12.a penny",
			"13.Bookkeeper. An alternate, tricky, answer could be Woollen where W is a double u ",
			"14.charcoal",
			"15.an ear of corn",
			"16.fire",
			"17.iron ore",
			"18.few",
			"19.Stove, fire, smoke",
			"20.A frog. The frog is an amphibian in the order Anura, meaning tail-less, and usually makes noises at night during its mating season.",
			"21.The past. Longfellow ",
			"22.wine",
			"23.The wind",
			"24.Your heart",
			"25.Time."
			);
			
		//uses javascript alert to make a simple textbox response, the response is the answer corresponding with the right riddle.
		?><input type="submit" value="Answer" onclick='alert("<?php echo $answers[$random_riddle]?>")'></br> <?php 
		
		if ( $instance['credit_title'] == 'yes' )
			echo '<a href="http://www.freshmuse.com">Fresh Muse Wordpress Design Agency</a>';
			
			
		echo $after_widget;
	}//end of function widget
	
}?>